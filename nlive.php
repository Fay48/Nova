<?php
// usage : nlive.php list.txt output.txt

function site($url){
  $ch   = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 2);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0");
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
  $output = curl_exec($ch);
  $httpcode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); 
  return [
    "head" => $httpcode,
    "body" => $output,
    "redirect" => $redirectedUrl
  ];
}

$file = explode("\n", file_get_contents($argv[1]));
echo "Domain total : ".substr_count(file_get_contents($argv[1]),"\n")."\n\n";
foreach ($file as $key => $value) {
  $site = site($value);
  if ($site['head'] !== 0) {
    print_r("\033[92m".$site['redirect']."\n");
    $simpan = @fopen($argv[2], 'a');
    fwrite($simpan, $site['redirect']."\n");
    fclose($simpan);
  }else {
    print_r("\033[91m".$value."\n");
  }
}

?>
