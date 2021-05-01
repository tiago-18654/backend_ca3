<?php

session_start();
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}

include 'library/DBConnection.php';



// sql to delete a record
$sql = "DELETE FROM product WHERE id_product=?";

$stmt=$conn->prepare($sql);

$stmt->bind_param("i", $id_product);

$id_product = $_GET['id_product'];

$stmt->execute();
$conn->close();


header("Location: index.php");
 



?>