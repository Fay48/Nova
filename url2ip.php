<?php
// URL to IP
if (isset($argv[1])) {
	$file = explode("\n", file_get_contents($argv[1]));
	foreach ($file as $key => $value) {
		$uri = parse_url($value);
		print_r($value." => \033[92m".gethostbyname($uri['host'])."\n");
	}
}else {
	echo "################################\n";
	echo "Nova Mass Check IP by URL\n";
	echo "Thanks to : Codelatte\n";
	echo "################################\n\n";
	echo "usage : php url2ip.php list.txt\n";
}
?>
