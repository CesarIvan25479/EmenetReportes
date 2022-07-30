<?php
$curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => "https://apisgratis.com/cp/colonias/cp/?valor=52665",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
]);
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if($err){
    $data["estado"] = "error";
    $data["error"] = $err;
    echo json_encode($data);
}else{
    echo json_encode($response);
}