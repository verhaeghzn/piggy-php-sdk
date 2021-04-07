#!/bin/bash

version=$(git describe --abbrev=0 --tags | sed 's/* //'  );
argument="$@"
old_version=""

if [ $# -eq 0 ]
  then
    echo $version
    exit 0;
fi

# Build array from version string.
a=( ${version//./ } )
if [ "major" = $argument ]
then
  ((a[0]++))
  a[1]=0
  a[2]=0
  git push --delete origin $old_version
fi

if [ "minor" = $argument ]
then
  old_version=$version
  ((a[1]++))
  a[2]=0
  git push --delete origin $old_version
fi

if [ "patch" = $argument ]
then
  old_version=$version
  ((a[2]++))
fi
new_version="${a[0]}.${a[1]}.${a[2]}"

git tag $new_version;
git push origin $new_version;