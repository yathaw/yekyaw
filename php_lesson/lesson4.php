<?php 
	echo "<h1> For Loop </h1><br>";

	for ($i=1; $i <= 10; $i++) 
	{ 
		echo "Hello - $i <br>";
	}

	echo "<br> <br>";
	echo "<hr>";

	echo "<h1> While Loop </h1>";
	$b = 4;
 
	while($b <= 5) 
	{
		echo "Student: $b <br>";
		$b++;
	}

	echo "<br> <br>";
	echo "<hr>";

	echo "<h1> Do..while Loop </h1>";

	$c = 1;

	do 
	{
	    echo "Student : $c <br>";
	    $c++;
	} while ($c <= 10);

	echo "<br> <br>";
	echo "<hr>";
	
	echo "<h1> Foreach Loop </h1>";

	$fruits = array("apple", "orange", "grape", "pineapple");
	foreach ($fruits as $fruit) 
	{
		echo $fruit."<br>";
	}
?>