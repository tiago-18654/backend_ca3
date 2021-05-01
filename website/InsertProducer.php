<?php

include 'library/DBConnection.php';

$error=[];
$name_producer = filter_input(INPUT_POST, 'name_producer',  FILTER_SANITIZE_STRING);
if(!isset($name_producer) || empty($name_producer)){
        $error['name_producer'] = 'The Producer name is required';
}

if(empty($error)){

        $sql = "INSERT INTO producer (name_producer) 
        VALUES (?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name_producer);
        $stmt->execute();
        $conn->close();

        header("Location: ProducerList.php");
}else{ 
        require_once('NewProducer.php');
}
?>