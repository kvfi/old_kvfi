import frontmatter, markdown
from markdown.extensions.wikilinks import WikiLinkExtension
from skeleton import posts
from flask import Flask, render_template
from flask_frozen import Freezer


app = Flask(__name__, template_folder="templates")
app.config.update(dict(PREFERRED_URL_SCHEME='https'))

freezer = Freezer(app)

resources_dir = "resources/files/"


@app.template_filter('strftime')
def datetimeformat(value):
    day = int(value.strftime('%d'))
    if 4 <= day <= 20 or 24 <= day <= 30:
        suffix = "th"
    else:
        suffix = ["st", "nd", "rd"][day % 10 - 1]
    return value.strftime('%B %d<sup>' + suffix + '</sup> %Y')


@app.template_filter('implode')
def implode_list(x, sep):
    return sep.join(x)


@app.route("/", endpoint='home')
def home():
    headmeta = {'title': 'Ouafi.net', 'description': ''}
    intro_txt = markdown.markdown(
        frontmatter.load(resources_dir + 'misc/intro.md').content,
        extensions=['markdown.extensions.extra',
                    WikiLinkExtension(base_url='https://en.wikipedia.org/wiki/', end_url='')])
    return render_template('home.html', headMeta=headmeta, intro_txt=intro_txt, posts=posts.Post.get_home())


@app.route("/<postype>/<slug>.html", endpoint='post')
def entry(postype, slug):
    post = posts.Post.get_post(postype, slug)
    head_meta = {'title': post['meta']['title'], 'description': post['meta']['subtitle']}
    return render_template('post.html', headMeta=head_meta, post=post)


@app.route("/<slug>.html", endpoint='page')
def page(slug):
    post = posts.Post.get_page(slug)
    head_meta = {'title': post['meta']['title'], 'description': post['meta']['subtitle']}
    return render_template('post.html', headMeta=head_meta, post=post)


@app.route("/fr", endpoint='home_fr')
def home_fr():
    headmeta = {'title': 'Ouafi.net', 'description': ''}
    intro_txt = markdown.markdown(
        frontmatter.load(resources_dir + 'misc/intro.md').content,
        extensions=['markdown.extensions.extra',
                    WikiLinkExtension(base_url='https://en.wikipedia.org/wiki/', end_url='')])
    return render_template('home.html', headMeta=headmeta, intro_txt=intro_txt, posts=posts.Post.get_home())


@app.errorhandler(404)
def page_not_found(e):
    head_meta = {'title': 'Page not found, sorry.', 'description': 'Page not found.'}
    return render_template('404.html', headMeta=head_meta), 404

if __name__ == "__main__":
    app.run(debug=True)
    freezer.freeze()
