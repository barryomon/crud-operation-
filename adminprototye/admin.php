

<?php

session_start();


$conn = mysqli_connect('localhost', 'barryomon', 'usiomonjasonbarry', 'admin');
if(!$conn){
    echo 'connection error' . mysqli_connect_error();
}
$id=0;
$update= false;
$name="";
$location="";



if(isset($_POST['save']))
{
    $name=$_POST['name'];
    $location=$_POST['location'];
    $_SESSION['message'] = "record has been saved";
    $_SESSION['msg_type'] = "success";


    $conn->query("INSERT INTO package(name, location) VALUES ('$name' , '$location')") or die($mysqli->error);

    $_SESSION['message'] = "record has been saved";
    $_SESSION['msg_type'] = "success";
    header('location: Admin.php');


}




if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli= $conn->query("DELETE  FROM package WHERE id=$id") or die($mysqli->error());
    
$_SESSION['message'] = "record has been deleted";
$_SESSION['msg_type'] = "danger";
header('location: Admin.php');

}






// to check if the edit botton has been clicked 
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update= true;
    $mysqli= $conn->query("SELECT * FROM package WHERE id=$id") or die($mysqli->error());
    // CHECK IF THE RECORD EXIST
    if (count($mysqli)==1){
        $row = $mysqli->fetch_array();
        $name = $row['Name'];
        $location = $row['location'];
   
        

    }
}

// check if update is set 
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location =$_POST['location'];

        
    $mysqli=$conn->query("UPDATE  package SET  Name ='$name',  location ='$location' where id=$id " ) or die($mysqli->error());
    header('location: Admin.php');


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"  rel="stylesheet" >

    <title>Hello, world!</title>
  </head>
<body> 



<!-- SESSION MESSEAGE -->
<?php

if(isset($_SESSION['message'])):


?>


<div class="alert alert-<?=$_SESSION['msg_type']?>">
<?php

echo $_SESSION['message'];
unset($_SESSION['message']);

?>

</div>

<?php endif?>


<!-- SESSION MESSEAGE -->










<!-- container div -->

<div class="container" >
<!-- container div -->


<?php
     $conn = mysqli_connect('localhost', 'barryomon', 'usiomonjasonbarry', 'admin');
    if(!$conn){
    echo 'connection error' . mysqli_connect_error();
   }

 
    $result = $conn->query("SELECT * FROM package") or die($mysqli->errror);

// pre_r($result);
?>





<div class="row justify-content-center"> 
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>location</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>




 <?php
        while($row =$result->fetch_assoc()):
        
        
        
 ?>
        <tbody>
            <tr>
                <td scope="row"><?php echo $row['Name']?></td>
                <td><?php echo $row['location']?></td>
                <td>
                    <a href="admin.php?edit=<?php echo $row['id']?>" class="btn btn-info">Edit</a>
                    <a href="admin.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a>

                </td>
            </tr>
        
 <?php endwhile; ?>
        </tbody>
    </table>
    


</div>


<!-- open a while loop -->

<?php

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';


}







?>






























<div   class="row justify-content-center">
    <form action="admin.php" method="post" >

<input type="hidden" name="id" value="<?php echo $id;?>">
       <div class="form-group">
           <label for="name">Name</label>
           <input type="text" name="name" id="" class="form-control" value="<?php echo $name;?>">
       </div>

       <div class="form-group">
           <label for="Location">location</label>
           <input type="text" name="location" id=""  class="form-control"  value="<?php echo $location;?>">
       </div>






       <div class="form-group">
       <?php
 if($update == true):
 
 ?>
<button type="submit" name="update" class="btn btn-info">update</button>
<?php else: ?>
<button type="submit" name="save" class="btn btn-primary">upload</button>
<?php endif; ?>



       </div>





    </form>
</div>  







<!-- container div -->

</div>
<!-- container div -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>