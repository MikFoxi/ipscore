<?php
$ip = '123.123.123.123'; // for test
//$ip = isset($_SERVER['REMOTE_ADDR']) ? strip_tags($_SERVER['REMOTE_ADDR']) : die('IP'); // Most often the real IP is here
//$ip = isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? strip_tags($_SERVER['HTTP_CF_CONNECTING_IP']) : die('IP'); // Real IP if using CloudFlare
$apikey = ''; // Your API Key

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ipscore.biz/api/'.$apikey.'/'.$ip.'/score.json');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 600);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
curl_setopt($ch, CURLOPT_USERAGENT, 'ipscoreclient'); // Do NOT change user-agent
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_TRY);
$outch = curl_exec($ch);
curl_close($ch);
$outch = json_decode($outch, true);
?>

<?php if (isset($outch['score']) AND $outch['score'] == 1) { ?>
<p style="color:green;">Content for human. Good IP address.</p>
<?php } ?>

<?php if (isset($outch['score']) AND $outch['score'] == 0) { ?>
<p style="color:blue;">Content for Bad Bot. Bad IP address.</p>
<?php } ?>

<?php if (isset($outch['error'])) { ?>
<p style="color:red;">Error Message: <?php echo $outch['error']; ?></p>
<?php } ?>
