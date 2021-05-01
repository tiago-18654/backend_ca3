
<?php 

include 'NavBar.php';
    
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}
?>
    <div class="container">
        
        <h1>Insert Producer</h1>
        <form action="InsertProducer.php" class="needs-validatio" novalidate method="POST">
            <div class="mb-3">
                <label for="name_producer" class="form-label">Producer Name</label>
                <input type="text" class="form-control" id="name_producer" name="name_producer" aria-describedby="name_producerHelp" value="<?php if(isset($name_producer)){ echo $name_producer;}  ?>" >
                <!-- show error to user  -->
                <span class="text-danger">
                    <?= isset($error['name_producer']) ? $error['name_producer'] : ''?> 
                </span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

    

   
</body>
</html>