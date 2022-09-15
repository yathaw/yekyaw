<?php 
	
	$x = 3;
	if ($x < 10) 
	{
		echo "IF statement <br>";
		echo "x is less than 10";
	}

	echo "<hr>";


	$y = 12;
	echo "<br><br> IF-else statement<br>";
	if ($y < 10) 
	{
		echo "y is less than 10";
	}
	else
	{
		echo "error";
	}

	echo "<hr>";
	
	$z = 30;
	echo "<br><br> IF...elseif...else statement <br>";
	if ($z < 10) 
	{
		echo "z is less than 10";
	}

	elseif ($z > 50) 
	{
		echo "z is greater than 50";
	}

	else
	{
		echo "z is equal to 30.";
	}

	echo "<hr>";
	
	echo "<br> <br> Switch Statement <br>";
	$a = 10;
	
	switch($a)
	{
		case "apple":
		echo "a is less than 3";
		break;

		case "$a = 10":
		echo "a is equal to 10";
		break;

		case "$a >= 9 ":
		echo "a is greater than 9";
		break;

		default:
		echo "a is not equal to 0, 1 or 2";
		break;
	}


?>