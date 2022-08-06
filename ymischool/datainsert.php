<?php 
	require_once 'vendor/autoload.php';
    include("connection.php");

	$faker = Faker\Factory::create();
	$positions = ["Senior Leadership Team", "Administration Staff", "Teacher"];
	$genders = ["Male","Female"];

	// foreach($positions as $position){
	// 	$sql = "INSERT INTO position (name) VALUES (?)";
	// 	$conn->prepare($sql)->execute([$position]);
	// }
	for ($i=1; $i <= 5; $i++) {
		$a=$faker->numberBetween(1, 25);

		$position=$faker->numberBetween(1, 2);

		$name = $faker->name();
		$dob = $faker->date();
		$address = $faker->address();
		$email = $faker->email();
		$password = '12345';

		$profile = "upload/img/user".$a.".png";
		
		$staff_sql = "INSERT INTO staff(name, profile, dob, address, email, password) VALUES (?,?,?,?,?,?)";
    	$conn->prepare($staff_sql)->execute([$name, $profile, $dob, $address, $email, $password]);

    	$userid = $conn->lastInsertId();

        $positionuser_sql = "INSERT INTO staff_position(staff_id, position_id) VALUES (?,?)";
        $conn->prepare($positionuser_sql)->execute([$userid, $position]);

    	
	}

	for ($i=1; $i <= 20; $i++) {
		$a=$faker->numberBetween(1, 25);

		$position=3;
		$name = $faker->name();
		$dob = $faker->date();
		$address = $faker->address();
		$email = $faker->email();
		$password = '12345';

		$profile = "upload/img/user".$a.".png";
		
		$staff_sql = "INSERT INTO staff(name, profile, dob, address, email, password) VALUES (?,?,?,?,?,?)";
    	$conn->prepare($staff_sql)->execute([$name, $profile, $dob, $address, $email, $password]);

    	$userid = $conn->lastInsertId();

        $positionuser_sql = "INSERT INTO staff_position(staff_id, position_id) VALUES (?,?)";
        $conn->prepare($positionuser_sql)->execute([$userid, $position]);

    	
	}


?>