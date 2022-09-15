<!DOCTYPE html>
<html lang="en">
	<head>
		<title> Lesson 1 </title>
	</head>
	<body>
		<h1> Working Text and Number </h1>

		<?php 

			$name = "Mg Mg";
			$address = "Yangon";

			// Output => Mg Mg lives in Yangon.

			echo "$name lives in $address <br>";
			echo '$name lives in $address <br>';

			echo $name.' lives in '.$address.'<br>';

			// trim(string) => remove spaces the beginning and ending of a string

			$trim_name = " Aye Aye ";
			echo trim($trim_name).'<br>';

			// strlen => string length
			echo strlen($trim_name); // 9
			echo strlen(trim($trim_name)); // 7

			// strcasecmp(string1, string2) => compares two strings. 
				//  0 - if the two strings are equal
				//  <0 - if string1 is less than string2
				//  >0 - if string1 is greater than string2

			echo strcasecmp("Hello world!","HELLO WORLD!")."<br>"; // 0
			echo strcasecmp("Hello world!","HELLO")."<br>"; // 7
			echo strcasecmp("Hello world!","HELLO WORLD! HELLO!")."<br>"; // -7

			// strtolower(string)
			echo strtolower('Beef, CHICKEN, Pork, duCK')."<br>"; 

			// strtoupper(string)
			echo strtoupper('Beef, CHICKEN, Pork, duCK')."<br>";

			// substr(string, start number);

				// positive number
					echo substr("Hello World",6)."<br>"; // World

				// negative number
					echo substr("Hello World",-2)."<br>"; // ld

			// str_replace(find, replace, string)
				echo str_replace("World", "John", "Hello World"); // Hello John


		?>

	</body>
</html>