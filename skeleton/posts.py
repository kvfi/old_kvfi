import os
import markdown2


class Post(object):
    RESSOURCE_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), '../content'))

    @classmethod
    def read(cls, slug):
        try:
            with open(cls.RESSOURCE_DIR + '/' + slug, encoding='utf8') as content_file:
                content = markdown2.markdown(content_file.read(), extras=['metadata', 'header-ids', 'footnotes', 'tables'])
            return {'meta': content.metadata, 'content': content}


    @classmethod
    def read_meta(cls, slug):
        c = Post.read(slug)
        m = c['metadata']
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
        postlist = os.listdir(cls.RESSOURCE_DIR)[:limit]
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
        for post in os.listdir(cls.RESSOURCE_DIR):
            c = Post.read(post)
            meta = c['meta']
            if 'featured' not in meta:
                meta['featured'] = None
            elif meta['featured'] == 'popular' and meta['online']:
                p = Post.read(post)
                popular.append(p)
            elif meta['featured'] == 'notable' and meta['online']:
                p = Post.read(post)
                notable.append(p)
        return {'popular': popular, 'notable': notable}
