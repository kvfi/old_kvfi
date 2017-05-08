import os, frontmatter, markdown, mdcustom
from skeleton import tools

class Post(object):
	RESSOURCE_DIR = './resources/files/posts/'

	@classmethod
	def get_posts(cls, limit=100):
		postlist = os.listdir(cls.RESSOURCE_DIR)[:limit]
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

	@classmethod
	def get_post(cls, type, slug):
		loader = frontmatter.load(cls.RESSOURCE_DIR + slug + ".md")
		post = {"meta": loader.metadata, "content": markdown.markdown(loader.content, ['markdown.extensions.extra'])}
		return post

	@classmethod	
	def get_home(cls, limit=50):
		posts = []
		i = 0
		for post in os.listdir(cls.RESSOURCE_DIR):
			loader = frontmatter.load(cls.RESSOURCE_DIR + post)
			metadata = loader.metadata
			if 'featured' not in metadata:
				metadata['featured'] = None
			elif metadata['featured'] == True:
				post = {"meta": metadata, "content": markdown.markdown(loader.content, ['markdown.extensions.extra'])}
				posts.append(post)
				i += 1
			if i >= limit:
				break
		return posts