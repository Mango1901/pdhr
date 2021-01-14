#!/bin/bash
arguments=$1
if [ -z "${arguments}" ];then
    echo "Please input your arguments ...."
    exit \1
else
php artisan "${arguments}"
fi 
