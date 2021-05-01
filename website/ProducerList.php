<?php 
//restrict the page to logged in users
include 'NavBar.php';
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}
//get the publishers
include 'library/DBConnection.php';
$sql = "SELECT * FROM producer";
$result = $conn->query($sql);

?>
    <div class="container">
    
    <h1>Producers List </h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name Producer</th>
                    <?php 
                        if(isset($_SESSION) && isset($_SESSION['id'])) {
                            echo '<th scope="col"><a class="btn btn-success" href="NewProducer.php" role="new">New</a></th>';
                        }
                    ?>
                <tr>
            </thead>
            <tbody>
            <?php 
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        echo "<tr>";
                        echo "<th scope='row'>".$row['id_producer']."</th>";
                        echo "<td>".$row['name_producer']."</td>";
                        if(isset($_SESSION) && isset($_SESSION['id'])) {
                            echo "<td><a class='btn btn-primary' href='UpdateProducer.php?id_producer=".$row['id_producer']."' role='update'>Update</a></td>";
                            echo "<td><a class='btn btn-danger' href='DeleteProducer.php?id_producer=".$row['id_producer']."' role='delete'>Delete</a></td>";
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
