<?php
include 'library/DBConnection.php';


$sql = "SELECT * FROM product WHERE id_product=".$_GET['id_product'];

$result = $conn->query($sql);


if($result->num_rows==0){
    header("Location: index.php");
}

$row=$result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
<title>Update Product</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
    <?php include 'NavBar.php' ?>
    <?php 

        if(!isset($_SESSION['id'])) {
            header("Location: index.php");
        }
    ?>
    <div class="container">
        
        <h1>Update Product</h1>
        <form action="EditProduct.php" method="POST">
            <input type="hidden" value="<?=$_GET['id_product']?>" name="id_product">
            <div class="mb-3">
                <label for="name_product" class="form-label">Product Name</label>
                <input style="width:550px;" type="text" class="form-control" id="name_product" name="name_product" aria-describedby="name_productHelp" value="<?= $row['name_product'] ?>">
            </div>
            <div class="mb-3">
                <label for="id_producer" class="form-label">Producer</label><br />
                <select style="width:550px;" name="id_producer" id="id_producer">
                    <?php

                        $sql = "SELECT * FROM producer";
                        $result = $conn->query($sql); 

                        while($producer = $result->fetch_assoc())
                        {
                            echo "<option value='". $producer['id_producer'] ."'>" .$producer['name_producer'] ."</option>";  // displaying data in option menu
                        }	
                    ?>  
                </select>            
                <span class="text-danger" id='id_producerError'><?= isset($error['id_producer']) ? $error['id_producer'] : '' ?> </span>
           </div>
           <div class="mb-3">
                <label for="id_status" class="form-label">Stock Status</label><br />
                <select style="width:550px;" name="id_status" id="id_status">
                    <?php

                        $sql = "SELECT * FROM status";
                        $result = $conn->query($sql); 

                        while($status = $result->fetch_assoc())
                        {
                            echo "<option value='". $status['id_status'] ."'>" .$status['detail'] ."</option>";  // displaying data in option menu
                        }	
                    ?>  
                </select>            
                <span class="text-danger" id='id_statusError'><?= isset($error['id_status']) ? $error['id_status'] : '' ?> </span>
           </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input style="width:550px;" type="number" class="form-control" id="quantity" name="quantity" value="<?= $row['quantity'] ?>" aria-describedby="quantityeHelp">
                <span class="text-danger" id="quantityError"><?= isset($error['quantity']) ? $error['quantity'] : '' ?> </span>
           </div>                
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</body>
</html>