<!DOCTYPE html>
<html>
<head>
	<title> Working Numbers </title>
</head>
<body>
	<?php 
		$total = 10;
		$num = 10;

		$total += $num;  // 20 -> total

		echo $total;

		$num++; // 10

		echo "<br>".$num; // 11

		$firestNumber = 45; $secondNumber = 12;

		$sub = $firestNumber - $secondNumber;
		$sum = $firestNumber + $secondNumber;
		$mul = $firestNumber * $secondNumber;
		$div = $firestNumber / $secondNumber;

		echo "<br>";
		echo "Sub =>".$sub; // 33

		echo "<br>";
		echo "Sum =>".$sum; // 57

		echo "<br>";
		echo "Mul =>".$mul; // 540

		echo "<br>";
		echo "Div =>".$div;// 3.75

	?>

</body>
</html>