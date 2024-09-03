#!/bin/bash

# Created by Amogh Dalal
# A script to scrape websites and insert products into a MySQL database
# 4/20/24

file_one=$1
file_two=$2
num=1

if [ ! -f "tagsoup-1.2.1.jar" ]; then
    curl -O "https://repo1.maven.org/maven2/org/ccil/cowan/tagsoup/tagsoup/1.2.1/tagsoup-1.2.1.jar"
fi

while :
do

	while read -r line; do
		
		curl $line > "vendorOne_${num}"
		java -jar tagsoup-1.2.1.jar --files "vendorOne_${num}"
		rm "vendorOne_${num}"
		((num++))

	done < $file_one
	
	num=1

	while read -r line; do
		
		curl $line > "vendorTwo_${num}"
		java -jar tagsoup-1.2.1.jar --files "vendorTwo_${num}"
		rm "vendorTwo_${num}"
		((num++))

	done < $file_two	

	python parser.py	
	
	rm vendorOne_{1..20}.xhtml
	rm vendorTwo_{1..20}.xhtml

	sleep 21600

done
