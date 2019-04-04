<?php
include('config.php');
session_start();
if(isset($_SESSION['user'])){
  $id=$_GET['edit'];
  $disp="select * from services where id='$id'";
  $query=mysqli_query($conn,$disp);
  if($row=mysqli_fetch_array($query)){
    $title=$row['title'];
    $desc=$row['description'];
    $cost=$row['pay'];
  }
?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo TITLE;?></title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/custom.css">
    <style>
    #head{
      font-family:cursive;
      font-size:20px;
      font-weight:bold;
      text-shadow:2px 2px red;
    }
    #header{
        font-family:cursive;
        font-size:30px;
        font-weight:bold;
        text-shadow:2px 2px red;
    }
    .navbar{
      background-color:black;
      color:white;
      padding-left: 500px;
    }
    </style>
  </head>
    <body>
      <div class="row">
      <nav class="navbar container-fluid">
      <div class="navbar-brand"id="header"><a href="dashboard.php" style="color:white;text-decoration:none;">Melly's Salon management System</a>
      </div>
      </div>
      </nav>
      </div>
      <div class="container-fluid">
        <?php
        if(isset($_POST['sub'])){
          //count the messages
          $serv=$_POST['service'];
          $desc=$_POST['desc'];
          $cost=$_POST['cost'];
          $sql="update services set title='$serv' where id='$id'";
          $sql1="update services set description='$desc' where id='$id'";
          $sql2="update services set pay='$cost' where id='$id'";
          $query=mysqli_query($conn,$sql);
          $query=mysqli_query($conn,$sql1);
          $query=mysqli_query($conn,$sql2);
          if($query){
            echo "
            <div class='alert alert-success'>
            <strong>Success</strong> Service Updated
            </div>
            ";
          }else{
            echo "
            <div class='alert alert-danger'>
            <strong>Error!!!</strong> Service Not Updated
            </div>
            ";
          }
        }
         ?>
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2" style="margin-left:0px;">
        <?php include('sidebar.php'); ?>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10">
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>" style="margin-top:20px">
        <div class="row">
          <div class="col-lg-3">
            <label for="service" class="label-control">Service</label>
            <input type="text" class="form-control input-md" value="<?php echo $title;?>" name="service" placeholder="E.g Manicure" required/>
          </div>
       <div class="col-lg-4">
         <textarea name="desc" class="form-control input-lg" rows="5" placeholder="Describe your Service Here"><?php echo $desc;?></textarea>
         <br>
       </div>
       <div class="col-lg-3">
         <label for="service" class="label-control">Cost</label>
         <input type="number" class="form-control input-md" name="cost" value="<?php echo $cost;?>" placeholder="E.g 1000" required/>
       </div>
       <div class="col-lg-2">
         <button type="submit" class="btn btn-success btn-block" name="sub" style="margin-top:30px;">Update Services</button>
       </div>
        </div>
        </form>
        </div>
    </div>
    </body>
  </html>
<?php } else{
  header("Location: ../Admin");
}?>
