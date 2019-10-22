<?php

/* Showcase: bigstream display sensor working and not work  */
$st = file ("station.info"); /* saving list station to array */
$config  = file_get_contents ("config.json");
$token  = file_get_contents ("access_token");

$o = json_decode ($config,true);;
$i = 0;
while ( $i < count ( $st ) )  {
	/* generate main bigstream url */
	$url = trim($o['accessurl']).'ino.'. trim(strtolower($st[$i]))."." . strtolower($o['sensorname'])."." 
	. date ('Y') . "/data?filetype=" . trim($o['filetype']) . "&token=" . trim($token);

	/* Start access bigstream stored */
	$fp = fopen ("./output/" . trim(strtolower ($st[$i])) . "." . trim(strtolower ( $o['sensorname'] )) , 'w');
	if ( $bs_data = @file_get_contents($url) ) {
		$bs_output = json_decode($bs_data, true);
		/* Record output to buffer file */	
		echo $st[$i] ;
		if ( isset ( $bs_output['data'][5] ) )
			fwrite ( $fp, $bs_output['station_id'] . ":" . $bs_output['data'][5]['value'] ) ;
		else
			fwrite ( $fp, "Error(1)" ) ;
	} else {
		/* Record output to buffer file */
		fwrite ( $fp, "Error(2)" ) ;
	}
	fclose ( $fp );
	$i++;
}
?>
