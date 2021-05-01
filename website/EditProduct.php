<?php
//connect to the database
include 'library/DBConnection.php';

//set up the sql string with prepared statements
if(empty($error)){
    $sql = "UPDATE product 
            SET name_product=?, 
            id_producer=?, 
            id_status=?, 
            quantity=? 
            WHERE id_product=?";


    $stmt = $conn->prepare($sql);

    //the variables are at your own choice, 
    //they do not require to be the exact same as the columns in the database
    $stmt->bind_param("ssssi", $name_product, $id_producer, $id_status, $quantity, $id_product);

    //set up the variables
    $id_product = $_POST["id_product"];
    $name_product = $_POST["name_product"];
    $id_producer = $_POST["id_producer"];
    $id_status = $_POST["id_status"];
    $quantity = $_POST["quantity"];

    //execute the statement
    $stmt->execute();
    //close the connection
    $conn->close();
    //redirect back to index page
    header("Location: index.php");
}else{ 
    require_once('UpdateProduct.php');
}
?>