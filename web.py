import copy, frontmatter, mistune, mdcustom, os, sys
from skeleton import posts
from flask import Flask, render_template
from flask_frozen import Freezer


app = Flask(__name__, template_folder="templates")
renderer = mdcustom.WikiLinkRenderer()
inline = mdcustom.WikiLinkInlineLexer(renderer)
inline.enable_wiki_link()

markdown = mistune.Markdown(renderer, inline=inline)

freezer = Freezer(app)

resources_dir = "resources/files/"

@app.template_filter('strftime')
def datetimeformat(value, format=''):
	day = int(value.strftime('%d'))
	if 4 <= day <= 20 or 24 <= day <= 30:
		suffix = "th"
	else:
		suffix = ["st", "nd", "rd"][day % 10 - 1]
	return value.strftime('%B %d<sup>' + suffix + '</sup> %Y')

@app.template_filter('implode')
def implodeList(list, sep):
	return sep.join(list)

@app.route("/", endpoint='home')
def home():
	headMeta = {'title': 'Ouafi.net', 'description': ''}
	intro_txt = markdown(frontmatter.load(resources_dir + 'misc/intro.md').content)
	return render_template('home.html', headMeta=headMeta, intro_txt=intro_txt, posts=posts.Post.get_home())

@app.route("/<slug>.html", endpoint='post')
def post(slug):
	post = posts.Post.get_post(slug)
	headMeta = {'title': post.meta['title'], 'description': post.meta['title']}
	return render_template('post.html', headMeta=headMeta, post=posts.Post.get_post(slug))

if __name__ == "__main__":
	#app.run()
	freezer.freeze()
