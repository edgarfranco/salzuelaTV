<?php
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

	$ctx = stream_context_create(array(
        'http' => array(
			'timeout'=>5,
            'method'=>'GET',
			'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
			)
		)
	);

	// http://tvpremiumhd.club/lista-gratuita/154409/tv/v/1124.ts
	$fecha = date_create();
	$url = "http://tvpremiumhd.club/hd/tv.m3u?r=" . date_timestamp_get($fecha);
//echo date_timestamp_get($fecha);
	$lista = file_get_contents($url, null, $ctx);

	$ini = "lista-gratuita/";
	$lenini = strlen($ini);
	$fin = "/tv/";
	
	$posini = strpos($lista, $ini);
	$posfin = strpos($lista, $fin);
	
	
	//$domain = str_replace("calidad=05", "calidad=01", $domain);
	//$domain = str_replace("calidad=04", "calidad=01", $domain);

	
//	echo substr($lista,($posini + $lenini),6) ;
	$token2 = substr($lista,($posfin - 6),6) ;
	print_r(json_encode($token2));	
	
	//echo $token2 ;
?>
