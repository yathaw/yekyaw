<?php 
  
  require('connection.php');
  session_start();

  $batchid = $_POST['batch'];
  $name = $_POST['name'];
  $dob = $_POST['dob'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $address = $_POST['address'];
  $price = $_POST['price'];
  $type = $_POST['type'];
  $phone = $_POST['phone'];
  $fullprice = $_POST['fullprice'];
  $userid = 1;
  if($type == 1){
    $transaction = $_POST['transaction'];
    $file = $_FILES['file'];

    $uploadFileDir = "upload/file/";

    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));


    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $dest_path = $uploadFileDir . $newFileName; 

    move_uploaded_file($fileTmpPath, $dest_path);
  }else{
    $dest_path = NULL;
    $transaction = NULL;
  }

  if ($fullprice == $price) {
    $paymentstatus = 1;
  }else{
    $paymentstatus = 0;
  }

  $registerdate = date('Y-m-d');

  $photo = 'upload/img/user.png';
  
  $sql = "SELECT * FROM batches 
        WHERE id= :value1";
  $statement = $conn->prepare($sql);
  $statement->bindParam(':value1', $batchid);
  $statement->execute();
  $batch = $statement->fetch(PDO::FETCH_ASSOC);

  $sql = "INSERT INTO students(name, profile, dob, phone, address, email, password) VALUES(:value1, :value2, :value3, :value4, :value5, :value6, :value7)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':value1', $name);
  $stmt->bindParam(':value2', $photo);
  $stmt->bindParam(':value3', $dob);
  $stmt->bindParam(':value4', $phone);
  $stmt->bindParam(':value5', $address);
  $stmt->bindParam(':value6', $email);
  $stmt->bindParam(':value7', $password);
  $stmt->execute();

  $studentid = $conn->lastInsertId();
  $courseid = $batch['course_id'];
  $sql = "INSERT INTO enroll(registerdate, paymentstatus, student_id, batch_id) VALUES (?,?,?,?)";
  $conn->prepare($sql)->execute([$registerdate, $paymentstatus, $studentid, $batchid]);

  $sql = "INSERT INTO payment(date, type, amount, transaction, transferfile, student_id, course_id, batch_id, created_by) VALUES (?,?,?,?,?,?,?,?,?)";
  $conn->prepare($sql)->execute([$registerdate, $type, $price, $transaction, $dest_path, $studentid, $courseid, $batchid, $userid]);

  $_SESSION['success_msg']="One Student is <b> CREATED </b> successfully in our database.";

  header('location:student_list.php');

?>