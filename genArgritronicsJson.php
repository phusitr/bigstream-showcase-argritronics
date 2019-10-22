<?php
$st = file ("station.info"); // argritronics station 
$i = 0;
$s = ",";
$fp = fopen ("./data/argritronics.json", "w"); // json output file 	
fwrite ($fp, "[\n"); // start json syntax 
while ( $i < count ( $st ) ) {
	if ( $i == count ( $st ) - 1 ) $s = null;
	/* get data content from argritronics sensor file */
	$arrTemp = file_get_contents("./output/" . trim( strtolower($st[$i] )) . ".temperature");
	$arrHum = file_get_contents("./output/" . trim( strtolower($st[$i] )) . ".humidity");
	$arrRain = file_get_contents("./output/" . trim( strtolower($st[$i] )) . ".rain");
	$arrPar = file_get_contents("./output/" . trim( strtolower($st[$i] )) . ".par");
	$arrWindspeed = file_get_contents("./output/" . trim( strtolower($st[$i] )) . ".windspeed");
	$arrWinddirection = file_get_contents("./output/" . trim( strtolower($st[$i] )) . ".winddirection");
	$arrBar = file_get_contents("./output/" . trim( strtolower($st[$i] )) . ".barometer");

	/* Check value data and error code */
	if ( strstr ( $arrTemp, ":" ) ) { $temp = explode (":", $arrTemp); $tout=$temp[1]; } else $tout = 999 ;
	if ( strstr ( $arrHum, ":" ) ) { $hum = explode (":", $arrHum); $hout=$hum[1]; } else $hout = 999 ;
	if ( strstr ( $arrRain, ":" ) ) { $rain = explode (":", $arrRain); $rout=$rain[1]; } else $rout = 999 ;
	if ( strstr ( $arrPar, ":" ) ) { $par = explode (":", $arrPar); $pout=$par[1]; } else $pout = 999;
	if ( strstr ( $arrWindspeed, ":" ) ) { $windspeed = explode (":", $arrWindspeed); $windspeedout=$windspeed[1]; } else $windspeedout = 999;
	if ( strstr ( $arrWinddirection, ":" ) ) { $winddirection = explode (":", $arrWinddirection); $winddirectout=$winddirection[1]; } else $winddirectionout = 999;
	if ( strstr ( $arrBar, ":" ) ) { $bar = explode (":", $arrBar); $bout=$bar[1]; } else $bout = 999;

	/* Write argritronics data to json file */ 	
	fwrite ( $fp, '{"station":"' . trim ( $st[$i] ) . '","par":'. $pout .',"temperature":' . 
		$tout. ',"humidity":' . $hout . ',"rain":' . $rout . ',"winddirection":'. 
		$winddirectout.',"windspeed":' . $windspeedout . ',"barometer":' . $bout . "}" . $s . "\n" );
	$i++;
	
}
fwrite ( $fp,"]"); // close json syntax
fclose ( $fp );
?>
