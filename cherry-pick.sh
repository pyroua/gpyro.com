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

echo 'need cherry-pick to master?'
read chp

if [[ "$chp" = "y" ]]
then
git checkout master
echo 'commit number'
read chpn
git cherry-pick '$chpn'
git push
git checkout dev
fi

