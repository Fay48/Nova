#!/bin/bash
# Monitor your host/device
# Need cronjob to auto observation
teleg() {
	message="[$(date)] - $1 is DOWN!"
	api=$(curl -s "https://api.telegram.org/PUT-YOUR-APIKEY/sendMessage?chat_id=PUT-YOUR-CHATID" --data-urlencode "text=$message")
}
while IFS= read -r ip; do #open file and store to variable ip

	ping -c 5 $ip &> /dev/null
	if [ $? -ne 0 ]; then
		echo -e "[$(date)] - $ip is DOWN!\n"
		teleg $ip
	else
		echo -e "[$(date)] - $ip is UP!\n"
	fi

done < /home/user/devel/list.txt #list host
