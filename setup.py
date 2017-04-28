#!/usr/bin/env python

from distutils.core import setup

setup(name='kvfi',
	version='1.0',
	description='Marginalized lexicon of obssesive science',
	author='kvfi',
	author_email='ouafi@ouafi.net',
	url='https://ouafi.net',
	packages=['kvfi'],
	install_requires=['flask', 'frontmatter', 'mistune', 'flask_frozen'],
)