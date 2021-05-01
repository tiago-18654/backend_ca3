<?php

session_start();
if(!isset($_SESSION['id_producer'])){
    header("Location: index.php");
}

include 'library/DBConnection.php';
// sql to delete a record
$sql = "DELETE FROM producer WHERE id_producer=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("i", $id_producer);
$id_producer = $_GET['id_producer'];
$stmt->execute();
$conn->close();
header("Location: ProducerList.php");
?>