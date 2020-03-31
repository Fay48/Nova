<?php
error_reporting(0);
if(isset($argv[1]) AND isset($argv[2])){
	echo "###################################\n";
	echo "Nova Mass Reverse IP\n";
	echo "Thanks to : Codelatte & IndoXploit\n";
	echo "###################################\n\n";
	sleep(1);
	echo "List Domain :\n";
	echo file_get_contents($argv[1])."\n\n";
	echo "Result :\n";
	$file = explode("\n", file_get_contents($argv[1]));
	foreach ($file as $key => $value) {
		$options  = array('http' => array('user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36'));
		$context  = stream_context_create($options);
		$api = json_decode(file_get_contents('https://api.indoxploit.or.id/ip/'.gethostbyname($value), false, $context));
		// print_r($api);
		$kecuali = array('www.','cpanel.','webdisk.','webmail.','mail.','cpcontacts.','cpcalendars.','autodiscover.');
			foreach ($api->data->resolutions as $key) {
				$replaced .= str_replace($kecuali,'',$key->hostname)."\n";
			}
	}
	$str = array_unique(explode("\n", $replaced));
	$imp = implode("\n", $str);
	print_r($imp);
	$simpan = @fopen($argv[2], 'a');
	fwrite($simpan, $imp);
	fclose($simpan);
}else {
	echo "Nova Mass Reverse IP\n\n";
	echo "usage : novarevip.php [list domain] [saved file]\n";
}
?>
