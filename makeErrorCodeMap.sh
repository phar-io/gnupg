#!/bin/bash

curl -s https://raw.githubusercontent.com/gpg/libgpg-error/master/src/err-codes.h.in |
  grep 'GPG_ERR' |
  cut -f 1,3- |
  tr -s "\t" |
  tr '\t' ':' |
  sed -r 's/(\d*)\:(.*)/\1 => "\2",/g' |
  grep -v '^ =>' |
  sort -g > string_def.txt
