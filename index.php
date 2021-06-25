<!DOCTYPE html>
<html>
<head>
	<title>RRR</title>
</head>
<body bgcolor="red">

</body>
</html>
<?php
session_start();

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


//BLOCK CODE

$get_ip=getRealIpAddr();

$new_arr[]= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$get_ip));

$latitude=$new_arr[0]['geoplugin_latitude'];
$longitude=$new_arr[0]['geoplugin_longitude'];

$_SESSION['ip']=$get_ip;

echo $_SESSION['ip'];
echo "<br>Latitude:".$new_arr[0]['geoplugin_latitude']." and Longitude:".$new_arr[0]['geoplugin_longitude'];

if(21.416666666666668<=$latitude && $latitude<=27.216666666666665 && 85.83333333333333<=$longitude && $longitude<=89.83333333333333){
	echo "<br/>India<br/>";
	echo "Latitude: ".$latitude."<br/>"."Longitude: ".$longitude;
	echo "<br/>Successful...!!";
	
}else{
    ?>
    <script type="text/javascript">
        alert("Blocked");
    </script>
    <style type="text/css">
		.hidden{
			display: none;
		}
	</style>
	<label><font color="red">Opps!!</font> This website is block in your country</label>
    <?php
}
?>
