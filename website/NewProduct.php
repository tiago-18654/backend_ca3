
<?php 

include 'NavBar.php';
include 'library/DBConnection.php'; 

if(!isset($_SESSION['id'])){
    header("Location: index.php");
}


?>
    <div class="container">
        
        <h1>Insert Product</h1>
        <form action="InsertProduct.php" class="needs-validatio" id="productForm"  method="POST">
            <div class="mb-3">
                <label for="name_product" class="form-label">Product Name</label>
                <input style="width:550px;" type="text" class="form-control" id="name_product" name="name_product" aria-describedby="name_productHelp" value="<?php if(isset($name_product)){ echo $name_product;}  ?>" >
                <!-- show error to user  -->
                <span class="text-danger" id='name_productError'>
                    <?= isset($error['name_product']) ? $error['name_product'] : ''?> 
                </span>
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
                <input style="width:550px;" type="number" class="form-control" id="quantity" name="quantity" value="<?= (isset($quantity))? $quantity : NULL ?>" aria-describedby="quantityeHelp">
                <span class="text-danger" id="quantityError"><?= isset($error['quantity']) ? $error['quantity'] : '' ?> </span>
           </div>        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>