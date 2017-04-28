import os, frontmatter, mistune, mdcustom

renderer = mdcustom.WikiLinkRenderer()
inline = mdcustom.WikiLinkInlineLexer(renderer)
inline.enable_wiki_link()
markdown = mistune.Markdown(renderer, inline=inline)

class Post(object):
	#dir = "./resources/files/posts/"

	@staticmethod
	def get_posts(limit=100):
		dir = './resources/files/posts/'
		postlist = os.listdir(dir)[:limit]
		posts = []
		for post in postlist:
			loader = frontmatter.load(dir + post)
			content = loader.content
			metadata = loader.metadata
			if 'title' not in metadata:
				metadata['title'] = 'Just a title'
			post = {"meta": metadata, "content": content}
			posts.append(post)
		return posts

	def get_post(slug):
		dir = './resources/files/posts/'
		postlist = os.listdir(dir)
		for post in postlist:
			loader = frontmatter.load(dir + post)
			content = markdown(loader.content)
			metadata = loader.metadata
			if 'slug' not in metadata:
				metadata['slug'] = None
			elif str(metadata['slug']).lower() == slug.lower():
				post = {"meta": metadata, "content": content}
				break
		return post

	@staticmethod
	def get_home(limit=50):
		dir = './resources/files/posts/'
		postlist = os.listdir(dir)[:limit]
		posts = []
		for post in postlist:
			loader = frontmatter.load(dir + post)
			content = loader.content
			metadata = loader.metadata
			if 'featured' not in metadata:
				metadata['featured'] = None
			if metadata['featured'] == True:
				post = {"meta": metadata, "content": content}
				posts.append(post)
		return posts