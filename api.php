<?php

// membuat fungsi req
function http_request($url){

	$ch = curl_init();
//set url
	curl_setopt($ch, CURLOPT_URL, $url);
//aktifkan fungsi
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

 	//setting agar bisa di jalankan
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

 	//tampung hasil ke dalam var

	$output = curl_exec($ch);

 	// tutup curl

	curl_close($ch);

 	// mengembalikan curl 

	return $output;
}

 // panggil fungsi httprequest

$data = http_request("https://api.kawalcorona.com/indonesia/provinsi/");

//ubah format json

$data =json_decode($data,TRUE);
 //echo"<pre>";
//print_r($data);
 //echo"</pre>";

 //tampung jumlah data

$jumlah = count($data);
$nomor = 1;
for($i = 0; $i < $jumlah; $i++){
	$hasil= $data[$i]['attributes'];
	?>
	<tr>
		<td><?=$nomor++?></td>
		<td><?=$hasil['Provinsi']?></td>
		<td><?=$hasil['Kasus_Posi']?></td>
		<td><?=$hasil['Kasus_Semb']?></td>
		<td><?=$hasil['Kasus_Meni']?></td>

	</tr>
	<?php
}

?>