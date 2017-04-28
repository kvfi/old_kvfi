import copy
import re
from mistune import Renderer, InlineGrammar, InlineLexer

class WikiLinkRenderer(Renderer):
    def wiki_link(self, alt, link):
        return '<a href="https://en.wikipedia.org/wiki/%s">%s</a>' % (link, alt)

class WikiLinkInlineLexer(InlineLexer):
    def enable_wiki_link(self):
        # add wiki_link rules
        self.rules.wiki_link = re.compile(
            r'\[\['
            r'([\s\S]+?\|[\s\S]+?)'
            r'\]\](?!\])'
        )

        # Add wiki_link parser to default rules
        # you can insert it some place you like
        # but place matters, maybe 3 is not good
        self.default_rules.insert(3, 'wiki_link')

    def output_wiki_link(self, m):
        text = m.group(1)
        alt, link = text.split('|')
        # you can create an custom render
        # you can also return the html if you like
        return self.renderer.wiki_link(alt, link)
        