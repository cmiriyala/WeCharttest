<?php 
	if(Auth::user()->role =='Student'){
	echo $notification['data']['insfname']."\t".$notification['data']['inslname']
    ."\t\t has submitted the feedback for \t\t".$notification['data']['patientfname']."\t"
    .$notification['data']['patientlname']; 
}
	else
	{
	echo $notification['data']['insfname']."\t".$notification['data']['inslname'].
	"\t\t has submitted \t\t".$notification['data']['patientfname']."\t"
    .$notification['data']['patientlname']."\t\t for review";
	}
?>

