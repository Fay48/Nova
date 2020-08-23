#!/bin/bash
# usage :
# chmod +x url2ip.sh
# ./url2ip.sh domain.txt output.txt numberthread
get_domain_name() {
    echo "$1" | awk -F/ '{print $3}' | sed 's/:.*//'
}

URLS=$(cat $1)
domain(){
	for TEST_URL in ${URLS}; do
  	  get_domain_name ${TEST_URL}
	done
}
getip(){
	ipnya=$(dig +short a $1 | tail -n1)
	echo $ipnya >> $2
	echo $ipnya
}
threadnya=$3
hitung=1
IFS=$'\r\n' GLOBIGNORE='*' command eval  'target=($(domain))'
for (( i = 0; i <"${#target[@]}"; i++ )); do
	targeto="${target[$i]}"
	ff=$(expr $hitung % $threadnya)
	if [[ $ff == 0 && $hitung > 0 ]]; then
		sleep 2
	fi
	getip $targeto $2 $hitung &
	hitung=$[$hitung+1]
done
wait
