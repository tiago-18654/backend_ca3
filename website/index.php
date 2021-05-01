<?php 
include 'library/DBConnection.php';


if(empty($_GET['searchInput'])){
    $sql = "SELECT * FROM product INNER JOIN producer, status where product.id_producer = producer.id_producer
    and product.id_status = status.id_status";
} else {

    $searchInput = filter_input(INPUT_GET, 'searchInput',  FILTER_SANITIZE_STRING);
    $searchType  = filter_input(INPUT_GET, 'searchType',  FILTER_SANITIZE_STRING);

    if( $searchType == 'product' || 
        $searchType == 'producer' || 
        $searchType == 'status'){

        if($searchType == 'producer'){
            $sql = "SELECT * FROM product INNER JOIN producer, status where product.id_producer = producer.id_producer
            and product.id_status = status.id_status and producer.name_producer LIKE '%$searchInput%'";
        } else if($searchType == 'status'){
            $sql = "SELECT * FROM product INNER JOIN producer, status where product.id_producer = producer.id_producer
            and product.id_status = status.id_status and  status.detail LIKE '%$searchInput%'";
        } else if($searchType == 'product'){
            $sql = "SELECT * FROM product INNER JOIN producer, status where product.id_producer = producer.id_producer
            and product.id_status = status.id_status and product.name_product LIKE '%$searchInput%'";
        } 
    } else {
        echo 'Search Type doesn\'t exist!';
        $sql = "SELECT * FROM product INNER JOIN producer, status where product.id_producer = producer.id_producer
    and product.id_status = status.id_status";
    }
}


$result = $conn->query($sql);


$sql1 = 'SELECT * FROM `producer`';
$result1 = $conn->query($sql1);
$validProducer = 'none';
if(!empty($result1)){
    $validProducer = 'exist'; 
}

include 'NavBar.php';


?>
<div class="container">
    <h1>Nerd Stock </h1>
        <form action='' method="GET">
            <div class="row ">
                <div class="col-5">
                    <div class="input-group mb-3">
                        <select class="form-select" id="inputGroupSelect04" name="searchType" aria-label="Example select with button addon">
                            <option selected>Choose...</option>
                            <option value="product">Product</option>
                            <option value="producer">Producer</option>                            
                            <option value="status">Status</option>
                        </select>
                        <input class="form-control" type="text" name="searchInput">
                        <button class="btn btn-outline-secondary" type="submit" id="submit">Search</button>
                    </div>
                </div>
            </div>            
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Producer</th>
                    <th scope="col">Status</th>
                    <th scope="col">Quantity</th>
                    <?php 
                        if($validProducer == 'exist' && (isset($_SESSION) && isset($_SESSION['id']))) {
                            echo '<th scope="col"><a class="btn btn-success" href="NewProduct.php" role="new">New</a></th>';
                        } else {
                            echo '<div class="alert alert-danger">';
                            echo    '<strong>Attention!</strong> It is Necessary to create the Instructor first.';
                            echo '</div>';
                        }
                    ?>                  
                <tr>
            </thead>
            <tbody>
            <?php 
            $instruc = "empty";
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        echo "<tr>";
                        echo "<th scope='row'>".$row['id_product']."</th>";
                        echo "<td>".$row['name_product']."</td>";
                        echo "<td>".$row['name_producer']."</td>";
                        echo "<td>".$row['detail']."</td>";
                        echo "<td>".$row['quantity']."</td>";
                        if(isset($_SESSION) && isset($_SESSION['id'])) {
                            echo "<td><a class='btn btn-primary' href='UpdateProduct.php?id_product=".$row['id_product']."' role='update'>Update</a></td>";
                            echo "<td><a class='btn btn-danger' href='DeleteProduct.php?id_product=".$row['id_product']."' role='delete'>Delete</a></td>";
                        }
                        echo "</tr>";
                    } 
                }
            ?>
            </tbody>
        </table>
    </div>        
</body>
</html>
