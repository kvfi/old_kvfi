import logging
import os
import sys
from datetime import datetime

import markdown2
from flask import abort, Flask, request, render_template, make_response, session
from flask_sslify import SSLify

from skeleton import posts
from skeleton.database import db_session, init_db
from skeleton.models import Entry
from skeleton.models import EntryPolicy

logging.basicConfig(filename='logs/debug.log', level=logging.DEBUG)

app = Flask(__name__, template_folder="templates")
app.config.update(dict(PREFERRED_URL_SCHEME='https'))
app.secret_key = 'tsKxaJzUeC62bY6aFYegJT9VV76sau9G3s2vrscm4FUekvPj3PHUckVHxeTPnp' \
                 'r2cxEx9UDxCSFj8exJVKWLLts35BE2aUbHWJ2QzNfHHPAxD8ahgtrzqRBLQEbUXEPHHrKarLK3vWndS8Hf' \
                 'Qd7fFGTeVABNRa9rbseP7H2NzVwyfa638Ac25evtXV95WSeveBYvZQhF3Axzw4zkLLeBBYbNMzYvwQ' \
                 'X5jKFSxqkR5VevpSrPKqXN5gjzEKR5vZ5vLC88VKBqZeCgknQb9ZP2fSTp7jhsFBtzvtgD' \
                 'NqYwwtnFWyCM98s9Res2YN62hpeuTpEGy3QLJgdydmMetuNJa7uK53dTLFdn' \
                 'fhpAsyD5GJBc32k4z9w7pQEEVe8Xh5TkG4SL3x8mT7uyh5tCR3BpxhY6seQJ6qKYqJJHRcXNjGszTL' \
                 'YemUkmgTU5nePFPsFB4nSMMtwDNNApWHNX6TAgbu46Dm5f66hf6VWKGFuLyTzP9YzaMGNn3EKxnc88hJ4MSx' \
                 'VLv2CMR3dMkmKKtmPTeznEtBQRyazCjYUjsDKJFgArcBRdvMFXDbjrH4aKCunhcrLd4Ssy7fZLLWZ' \
                 '73phc7utMq5kVJC6JT3TdP4yzwFUWqzZzm6vpewVk3mcnc8nhQcpsAt6btjd362vhFfca9wzs9LG' \
                 'R8deC4FrrRWJwqVxpDrjY5jsp8T7LpMUQ2tzujBFJX62vXYbGj6jRvzgHkr43H2YbzKjS6VBx' \
                 'NzMShBKxQxsYX8RbatNLXUHAqgUfqfGhnLhWkmNus2kk7fPH6gx3ShfCDneuXQ4bjGTzJjb3' \
                 '6mSKbwHj2MaktvPuVH78a79AvXyvf7zk8XdpfHyGZXa2j4mNudDvyUJAxPZbMTAM9EqUAedA' \
                 'h3fRSZfGDqeMenquMsLGQJ9Z4nS3GCrgTQ4Z7RpnG7HASB7UkgqQjCejXML9nJhwqrLtADpPm' \
                 'BgJbpaRq8H76M5MYMZ6U6CEgCAmdtBXHKVBcNnYQN2QQ6RVPJ8B8gLfFHBUntQGB2NSRe6A4cTszUz' \
                 'KgFuyuhnpFR4QxNHpqtxQLWK9AYmeZMrjxSAwpuS6VSHTUANzhHTBMUaDLmDYwqsTek4NY46uDjWy7' \
                 'KUSWNVWX4Rpbnb6UrGznHfRHZJ5Eevs6s8m9K2ZUMADf4xAuFUjCYj3FgRer6yvZyZ3v4rwpJJzbLGG' \
                 'a6Q5cqE3G3r4vPm2mePVmNT5d8JeJkCSkDUdWmUyXcttmNmrgBm4LLfqyBbW3EfwJSwEy9YN6XZsuW' \
                 'Q5PMG4bxv4SzHBCntcwbdz3dnmpYMFqzDfMkv27yJFHKXuESZkDdndHaCgnfCNDnyr5HtmVu2cVfbNp74f' \
                 'mJkAkvf9CA745n4XuVwfeqkdd8Fnek6vzZyanZCmy8YjxgJpwtLuEXKRmz7GrzUhvhdGUcvwwrm5YWPXGbS' \
                 'tg326wYrNwZCV2qtWuXz5wuDXvpbcpDqpuWYTVHFkShZSVz36ZUQ8N8mnwzdKE8wSFXguF9GckRZtaQevhz' \
                 'NCcVsXmSdfyuArEeRBqx6JHc6Qv2WUkP9zbnTKP2BpWt9uwf2U2UPeKnMKWn2XqH7AbR9LJvCzLEJQ32vsw' \
                 'btNkD3h5FkqgvwbLPvhzzvSZJnbLRGPWWdEvWarRgYYK2sv98fnqq58aVFJnGKksRHgFM8kJ5NzeyPuD9uCW' \
                 'Dvsmhp2tvErrvsBdcTA9LhP8sjkrGZENpMaHtvFjSypxcPaA63CQ8cNCEThTYSfgJPLSm9sJDFV5YURMLFJH' \
                 'NDdmWGEmrgDWKK3Vdgj3bkumQa9Ssf657aKChyrBX6npF98PCrUVzjNpQjsgrb6tR4NkGYxuzfudCEzRgGC4' \
                 'RG5ssfUewE7PhrRR2jfmBDtXda7FfJGeYa48sntmwTh9KBWAVhaBYe8Suj9EZfLyfHfxkV85Up5REgTg6sh' \
                 'aMVsghQgcXc6pYtkutbWkArvb8WUJtuFENBAcq3ZWzkMDBYX33fufZYrp8th4xE9b4s' \
                 'eYUFP9L5ZNkbv7TBFHa4fuarHQm4Q7HZbvxUtwa3tCGEx'

init_db()


sslify = SSLify(app, subdomains=True)

resources_dir = os.path.abspath(os.path.join(os.path.dirname(__file__), 'resources/files'))


@app.teardown_appcontext
def shutdown_session(error=None):
    try:
        db_session.remove()
    except Exception as error:
        logging.info('An error has occured: ' + repr(error))


@app.before_request
def set_domain_session():
    resp = make_response()
    resp.set_cookie('locale', value='en_GB')


@app.template_filter('strftime')
def datetimeformat(value):
    date = datetime.strptime(value, "%Y-%m-%d")
    day = date.day
    if 4 <= day <= 20 or 24 <= day <= 30:
        suffix = "th"
    else:
        suffix = ["st", "nd", "rd"][day % 10 - 1]
    return date.strftime('%B %e<sup>' + suffix + '</sup> %Y')


@app.template_filter('implode')
def implode_list(x, sep):
    return sep.join(x)


@app.route("/", endpoint='home')
def home():
    headmeta = {'title': 'Ouafi.net', 'description': ''}
    post = posts.Post.get_home()
    with open(resources_dir + '/' + 'misc/intro.md', 'r') as content_file:
        intro_txt = markdown2.markdown(content_file.read(), extras=["metadata", "header-ids", "footnotes"])
    return render_template('home.html', headMeta=headmeta, intro_txt=intro_txt, posts=post)


@app.route("/<slug>", endpoint='post')
def entry(slug):
    post = posts.Post.get_post(slug)
    if post and post['meta']:
        meta = post['meta']
        head_meta = {'title': meta['title'], 'description': meta['subtitle']}
        item = Entry.query.filter(Entry.path == meta['slug']).first()
        resp = make_response(render_template('post.html', headMeta=head_meta, post=post))
        if item and item.privacy_id:
            item_policy = EntryPolicy.query.filter(EntryPolicy.id == item.privacy_id).first()
            if item and request.args.get("c") == item_policy.code:
                return resp
            else:
                abort(404)
        else:
            return resp
        abort(404)
    else:
        abort(404)


@app.route("/french.html", endpoint='home_fr')
def home_fr():
    headmeta = {'title': 'Ouafi.net', 'description': ''}
    post = posts.Post.get_home()
    with open(resources_dir + 'misc/intro_fr.md', 'r', encoding='utf8') as content_file:
        intro_txt = markdown2.markdown(content_file.read(), extras=["metadata", "header-ids", "footnotes"])
    return render_template('home.html', headMeta=headmeta, intro_txt=intro_txt, posts=post)


@app.errorhandler(404)
def page_not_found(e):
    head_meta = {'title': 'Page not found, sorry.', 'description': 'Page not found.'}
    return render_template('404.html', headMeta=head_meta, error=e), 404


if __name__ == "__main__":
    if len(sys.argv) > 1 and sys.argv[1] == "build":
        exit(0)
    elif len(sys.argv) > 1 and sys.argv[1] == "debug":
        app.run(debug=True)
    else:
        app.run()
