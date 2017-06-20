from os import listdir

import markdown2


class Post(object):
    RESSOURCE_DIR = './content/'

    @classmethod
    def read(cls, slug):
        with open(cls.RESSOURCE_DIR + slug, encoding='utf8') as content_file:
            content = markdown2.markdown(content_file.read(), extras=["metadata", "header-ids", "footnotes"])
        return {'meta': content.metadata, 'content': content}

    @classmethod
    def read_meta(cls, slug):
        c = Post.read(slug)
        m = c.metadata
        return m

    '''@classmethod
    def get_posts(cls, limit=100):
        postlist = listdir(cls.RESSOURCE_DIR)[:limit]
        posts = []
        for post in postlist:
            loader = cls.RESSOURCE_DIR + post)
            content = loader.content
            metadata = loader.metadata
            if 'title' not in metadata:
                metadata['title'] = 'Just a title'
            post = {"meta": metadata, "content": content}
            posts.append(post)
        return posts'''

    @classmethod
    def get_posts(cls, limit=100):
        postlist = listdir(cls.RESSOURCE_DIR)[:limit]
        posts = []
        for post in postlist:
            posts.append(post)
        return posts

    @classmethod
    def get_post(cls, slug):
        return Post.read(slug + ".md")

    @classmethod
    def get_home(cls):
        popular = []
        notable = []
        for post in listdir(cls.RESSOURCE_DIR):
            c = Post.read(post)
            if 'featured' not in c['meta']:
                c['meta']['featured'] = None
            elif c['meta']['featured'] == 'popular':
                p = Post.read(post)
                popular.append(p)
            elif c['meta']['featured'] == 'notable':
                p = Post.read(post)
                notable.append(p)
        return {'popular': popular, 'notable': notable}
