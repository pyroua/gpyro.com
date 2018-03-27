#!/bin/bash

git checkout dev
git status

echo 'git add '
read files

if [[ "$files" = "" ]] #сравнение строк, обратите внимание на пробелы и скобки
then
git add .
else
git add "$files"
fi #конец сравнения

echo 'git commit -m'
read message

if [[ "$message" != "" ]]
then
git commit -m "$message"
fi

echo 'git push'
git push

echo 'need merge to master?'
read merge

if [[ "$merge" = "y" ]]
then
git checkout master
git merge dev
git push
git checkout dev
fi

