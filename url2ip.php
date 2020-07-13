<?php
// URL to IP
error_reporting(0);
$i = 1;
if (isset($argv[1])) {
	$file = explode("\n", file_get_contents($argv[1]));
	foreach ($file as $key => $value) {
		echo "\033[94m[".$i." / ".count($file)."] ";
    	$i++;
		$uri = parse_url($value);
		$ip = gethostbyname($uri['host']);
		print_r("\033[0m".$value." => \033[92m".$ip."\n");
		if($ip){
			$simpan = @fopen($argv[2], 'a');
    		fwrite($simpan, $ip."\n");
    		fclose($simpan);
		}
	}
}else {
	echo "################################\n";
	echo "Nova Mass Check IP by URL\n";
	echo "Thanks to : Codelatte\n";
	echo "################################\n\n";
	echo "usage : php url2ip.php list.txt output.txt\n";
}
?>
