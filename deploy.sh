#!/bin/bash

set -o errexit -o nounset

cd build

git init
git remote add origin "https://github.com/kvfi/kvfi.git"
git checkout -B gh-pages
echo "ouafi.net" > CNAME

git add .
git commit -m "rebuild pages"

git push -f origin gh-pages

rm -rf build/.git
rm -rf build/*