<?php

include 'library/DBConnection.php';

$error=[];

// https://www.php.net/manual/en/function.filter-input.php
// https://www.php.net/manual/en/filter.filters.php

//sanitizing is removing anything not adhering to the filter
//filter_input (TYPE OF INPUT, INPUT NAME , FILTER NAME/TYPE - see on PHP.net)
$name_product = filter_input(INPUT_POST, 'name_product',  FILTER_SANITIZE_STRING);
$id_producer = filter_input(INPUT_POST, 'id_producer',  FILTER_SANITIZE_STRING);
$id_status = filter_input(INPUT_POST, 'id_status',  FILTER_SANITIZE_STRING);
$quantity = filter_input(INPUT_POST, 'quantity',  FILTER_SANITIZE_STRING);
//make input required
//checks to see if the $name is set (should be) or if it is empty
//if it is initialize the error array with a message
if(!isset($name_product) || empty($name_product)){
        $error['name_product'] = 'The product name is required';
}
if(!isset($id_producer) || empty($id_producer)){
        $error['id_producer'] = 'The producer is required';
}
if(!isset($quantity) || empty($quantity)){
        $error['quantity'] = 'The quantity is required';
}
if(!isset($id_status) || empty($id_status) ){
        $error['id_status'] = 'Status is required';
}


if(empty($error)){
        //prepare and bind
        //everything has to be the exact same as it is in the database
        $sql = "INSERT INTO product (`name_product`, `id_producer`, `id_status`, `quantity`) 
        VALUES (?,?,?,?)";

        //prepared statement
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssss", $name_product, $id_producer, $id_status, $quantity);

        //send to database
        $stmt->execute();
        $conn->close();

        header("Location: index.php");
}else{ 
        require_once('NewProduct.php');
}
?>