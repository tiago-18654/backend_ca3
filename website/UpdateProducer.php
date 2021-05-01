<?php
include 'library/DBConnection.php';


$sql = "SELECT * FROM producer WHERE id_producer=" . $_GET['id_producer'];

$result = $conn->query($sql);


if($result->num_rows==0){
    header("Location: ProducerList.php");
}

$row=$result->fetch_assoc();


?>

<!DOCTYPE html>
<html>
<head>
<title>Update Producer</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
    <?php include 'NavBar.php' ?>
    <div class="container">
        
        <h1>Update Producer</h1>
        <form action="EditProducer.php" method="POST">
            <input type="hidden" value="<?=$_GET['id_producer']?>" name="id_producer">
            <div class="mb-3">
                <label for="name_producer" class="form-label">Producer Name</label>
                <input type="text" class="form-control" id="name_producer" name="name_producer" aria-describedby="name_producerHelp" value="<?= $row['name_producer'] ?>">
                <span class="text-danger">
                    <?= isset($error['name_producer']) ? $error['name_producer'] : ''?> 
                </span>
            </div>             
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

    

   
</body>
</html>