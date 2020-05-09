<?php
	$weather="";
	$error ="";
	if(isset($_GET['city'])){
		$city = str_replace(' ', '', $_GET['city']);

		$file_header = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		if($file_header[0] == 'HTTP/1.0 404 Not Found'){
			$error = "The city could not be found.";
		}else{


	$forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
	$content = explode('</h2> (1–3 days):</div><p class="location-summary__text"><span class="phrase">',$forecastPage);
	if(sizeof($content)>1){
	$content1 = explode('</span>', $content[1]);
	if(sizeof($content1)>1){
	$weather =  $content1[0];
}else{
	$error = "The city could not be found.";
}
}else{
	$error = "The city could not be found.";
}

}
}



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width , initial-scale=1.0">
	<title>Weather Forecast</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body>
<div class="container">
	<h1 id="heading"> What's the Weather?</h1>
	<h4>Enter the name of the city</h4>
		<form >
			<fieldset class="form-group">
			<input type="text" name="city" class="form-control" placeholder="Eg.Vellore" id="city" value="<?php 

			if(isset($_GET['city'])){
			echo $_GET['city'];
			} ?>">
			</fieldset>
			<button type="submit" class="btn btn-info">Submit</button>
		</form>

<div id="weather"><?php 
	if($weather){
		echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
	}else if($error){
		echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
	}


 ?></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>