#!/bin/bash
# Cutting lines of huge file

echo -e "\e[96mLines Cutter\e[97m\n"
read -p "File : " filenya
if [ ! -f $filenya ]; then
	echo "[-] File $list Not Exist!"
	exit 1
fi
read -p "From line : " dari
if [ -z $dari ]; then
	echo "From line is null!"
	exit 1
fi
read -p "Until line : " sampai
if [ -z $sampai ]; then
	echo "Until line is null!"
	exit 1
fi
read -p "Output file : " output
if [ -z $output ]; then
	output='output.txt';
fi

awk "NR >= ${dari} && NR <= ${sampai}" $filenya >> $output
if [ -f $output ]; then
	echo -e "\nSaved as : \e[92m${output}"
fi
