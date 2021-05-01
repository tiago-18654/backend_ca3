<?php
//connect to the database
include 'library/DBConnection.php';
$error = [];

$name_producer = filter_input(INPUT_POST, 'name_producer',  FILTER_SANITIZE_STRING);

if(!isset($name_producer) || empty($name_producer)){
        $error['name_producer'] = 'The Producer name is required';
}

$sql = "UPDATE producer 
        SET name_producer=?
        WHERE id_producer=?";


$stmt = $conn->prepare($sql);

//the variables are at your own choice, 
//they do not require to be the exact same as the columns in the database
$stmt->bind_param("si", $name_producer, $id_producer);

//set up the variables
$id_producer = $_POST["id_producer"];
$name_producer = $_POST["name_producer"];

//execute the statement
$stmt->execute();
//close the connection
$conn->close();
//redirect back to Pub list page
header("Location: ProducerList.php");
?>