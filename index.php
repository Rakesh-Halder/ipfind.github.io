<?php
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

//fetch provide details
function fetch_value($val){
	//BLOCK CODE
	$get_ip=getRealIpAddr();
	$new_arr= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$get_ip));

	//Get values
	$latitude=$new_arr['geoplugin_latitude'];
	$longitude=$new_arr['geoplugin_longitude'];
	$city=$new_arr['geoplugin_city'];
	$state=$new_arr['geoplugin_regionName'];
	$country=$new_arr['geoplugin_countryName'];
	$output='';

	if(21.416666666666668<=$latitude && $latitude<=27.216666666666665 && 85.83333333333333<=$longitude && $longitude<=89.83333333333333){

		if($val=="check"){		//Checking IP
			$output=true;
		}		
	}else{
		if($val=="check"){		//Checking IP
			$output=false;
		}
	}

	if($val=="ip"){		//Get IP
		$output=$get_ip;
	}else if($val=="city"){
		$output=$city;
	}else if($val=="state"){
		$output=$state;
	}else if($val=="country"){
		$output=$country;
	}else if($val=="lat"){
		$output=$latitude;
	}else if($val=="lon"){
		$output=$longitude;
	}

	return $output;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPfind</title>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<style type="text/css">
		*,body{
			margin: 0;
			padding: 0;
			font-family: sans-serif;
		}
		header{
			color:red;
            margin:3px 0;
		}
		#panel{
            display:block;
            width:100%;
            height:70vh;
			/*box-shadow: 1px 2px 6px 0px #bbb;*/
		}
		#panel h3{
			padding: 5px 0;
		}
		#data_table{
			overflow-x: auto;
		}
		span{
			float: right;
		}
		button{
			border: none;
			width: 5rem;
			height: 2rem;
			font-size: 1rem;
			color: #fff;
			background-color: #3366ff;
			border-radius: 0.2rem;
		}
		button:hover{
			background-color: green;
		}
	</style>
	<script type="text/javascript">
		function onClickBtn() {
			var btn=document.getElementById("btn");
			var check="<?php echo fetch_value("check"); ?>";
            if(!check){
                window.location.replace("https://shakhor.cf/");  
            }else{
                alert("Sorry!! This site block in your country.");
            }
		}
	</script>
</head>
<body>
	<header>
		<center>
			<h3>: Your IP Address :</h3>
			<h1><?php echo fetch_value("ip"); ?></h1>
		</center>
	</header><br><hr>
	<div id="panel">
		<center>
			<h3>IP Provider Details</h3>
			<hr><br>
			<div id="data_table">
				<table border="0" cellspacing="15">
					<tr>
						<td><b>Country<span>:</span></b></td>
						<td><?php echo fetch_value("country"); ?></td>
					</tr>
					<tr>
						<td><b>State<span>:</span></b></td>
						<td><?php echo fetch_value("state"); ?></td>
					</tr>
					<tr>
						<td><b>City<span>:</span></b></td>
						<td><?php echo fetch_value("city"); ?></td>
					</tr>
					<tr>
						<td><b>Latitude<span>:</span></b></td>
						<td><?php echo fetch_value("lat"); ?></td>
					</tr>
					<tr>
						<td><b>Longitude<span>:</span></b></td>
						<td><?php echo fetch_value("lon"); ?></td>
					</tr>
				</table>
			</div>
			<button id="btn" onclick="onClickBtn()">Go!</button>
		</center>
        <br><hr>
		<center><h3>Student Details</h3></center>
		<hr>
		<div id="my_details">
			<table border="0" cellspacing="8">
				<tr>
					<td><b>Name<span>:</span></b></td>
					<td>Rakesh Halder</td>
				</tr>
				<tr>
					<td><b>Semester<span>:</span></b></td>
					<td>8th (2021)</td>
				</tr>
				<tr>
					<td><b>Roll<span>:</span></b></td>
					<td>24000318002</td>
				</tr>
				<tr>
					<td><b>Course<span>:</span></b></td>
					<td>B.Tech</td>
				</tr>
				<tr>
					<td><b>Branch<span>:</span></b></td>
					<td>ECE</td>
				</tr>
				<tr>
					<td style="width: 80px;"><b>College<span>:</span></b></td>
					<td>Abacus Institute Of Engineering & Management (AIEM), Mogra, Hooghly</td>
				</tr>
			</table>
		</div>
        <br>
		<hr>
		<div>
			<center>
                <p style="font-size: 12px;"><b style="color: red;">Note :</b> It is a temporary static website, create only for learning pourpose(MAR Activity, MAKAUT).</p>
            </center>
		</div>
	</div>
</body>
</html>