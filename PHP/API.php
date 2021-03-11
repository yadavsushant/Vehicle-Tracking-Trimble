<?php
function get_trimble_tracking(){
	$curl = curl_init();
	$url = "https://ws.tmsitrimble.in/GenericServices/get/json/locationDataFetcher/locationDetails";
	$data = array(
		"key" => XXXXXXXXXX,
	);

	// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	$url = sprintf("%s?%s", $url, http_build_query($data));

	// OPTIONS:
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

	// EXECUTE:
	$result = curl_exec($curl);
	if(!$result){die("Connection Failure");}
	curl_close($curl);
	$response = json_decode($result);

	for($i = 0; $i<=count($response->consignments[0]->consignment); $i++)
	{
		$VehicleNo = $response->consignments[0]->consignment[$i]->vehicleNumber;
		$Imei = "$response->consignments[0]->consignment[$i]->Imei";
		$Location = $response->consignments[0]->consignment[$i]->location;
		$Date = date('Y-m-d H:i:s',strtotime($response->consignments[0]->consignment[$i]->datetime));
		$Tempr = "$response->consignments[0]->consignment[$i]->Tempr";
		$Ignition = "$response->consignments[0]->consignment[$i]->Ignition";
		$Lat = $response->consignments[0]->consignment[$i]->latitude;
		$Long = $response->consignments[0]->consignment[$i]->longitude;
		$lat_longi = $response->consignments[0]->consignment[$i]->latitude.",".$response->consignments[0]->consignment[$i]->longitude;
		$Speed = $response->consignments[0]->consignment[$i]->speed;
		$Angle = "$response->consignments[0]->consignment[$i]->Angle";
	}
}
