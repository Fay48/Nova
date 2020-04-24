<?php
#Coded by Muhamad Faiz Azhar
#Github : https://github.com/Fay48
if(isset($argv[1]) AND isset($argv[2])){
	$file = explode("\n", file_get_contents($argv[1]));
	echo "##### String is Domain #####\n\n";
	echo "Total Domain : ".count($file)."\n\n";
	sleep(3);
	foreach ($file as $key => $value) {
		$validator = filter_var($value, FILTER_VALIDATE_DOMAIN);
		if ($validator) {
			$simpan = @fopen($argv[2], 'a');
			fwrite($simpan, $value."\n");
			fclose($simpan);
			echo "\033[92m".$value." - Valid!\n";
		}else {
			echo "\033[91m".$value." Invalid!\n";
		}
	}
}else {
	echo "usage : php validomain.php file.txt output.txt\n";
}
?>
