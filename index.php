<?php

	if ($_GET['city']) {

	$weather = "";
	$error = "";

	$urlContents =
		file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=0160ca44e9a9cbc8929826e973ef8223");


	$weatherArray = json_decode($urlContents, true);

		if ($weatherArray) {

			$weather = "The weather in ".$_GET['city']." is currently ".$weatherArray['weather'][0]['description']." .";

			$temperatureInFarenheit = intval($weatherArray['main']['temp'] * 1.8 -  459.67);
			$windSpeed = intval($weatherArray['wind']['speed'] * 2.23694);

			//adding it back together to give us the entire string
			$weather .= " The current temperature is ".$temperatureInFarenheit."&deg;F.";

			$weather .= " The wind speed is ".$windSpeed." miles per hour.";
			
		} else {
	            
	           $error = "Could not find city - please try again.";
	            
	       }

	}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Weather App</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

	<!-- MY LINKS -->
	<link rel="stylesheet" href="stylesheet.css"> 
	<script src="script.js"></script> 
</head>

<body>

	<div class="container-fluid text-center" id="box">
			
			<!-- PRIMARY FORM FOR THE WEATHER SITE -->
			<form>
			  <div class="form-group">
			  	<h1> What's The Weather? </h1>
			  	<p> Enter the name of a city </p>
			  	<br>

			    <input type="text" class="form-control" id="input" aria-describedby="input" name="city" placeholder="E.g. Paris, London" value="<?php echo $_GET['city']; ?>">
			  </div>

			  <button type="submit" class="button">Submit</button>
			</form>

			<!-- show the weather IF STRING IS NOT EMPTY -->

		<div id=weather>
			<? if ($weather) {
                  
                  echo '<div class="alert alert-success" role="alert">
  						'.$weather.'</div>';
                  
              } else if ($error) {
                  
                  echo '<div class="alert alert-danger" role="alert">
  				'.$error.'</div>';
                  
              }

            ?>
			</div>
		</div>




	</div>




</body>
</html>