<?php
include('config.php');
session_start();
if(isset($_SESSION['user'])){
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
      <div class="navbar-brand"id="header" style="text-align:center"><p>Melly's Salon management System</p>
      </div>
      </div>
      </nav>
      </div>
      <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2" style="margin-left:0px;">
        <?php include('sidebar.php'); ?>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10">
        <div class="row" style="margin-top:50px;">
          <div class="col-lg-6">
            <div class="form" style="height:auto;width:auto">
              <h3 style="font-weight:bold; ">Appointments<sup><span class="badge badge-primary"><?php
              $n=$_SESSION['user'];
              $sql="select c_id from users where username='$n'";
              $query=mysqli_query($conn,$sql);
              if($row=mysqli_fetch_array($query)){
                $id=$row['c_id'];
              }
              $sql="SELECT * FROM appointments where c_id='$id'";
              $query=mysqli_query($conn,$sql);
              $count=mysqli_num_rows($query);
              echo $count;
               ?></span> </sup></h3>
              <a href="appointments.php" class="btn btn-warning btn-block more" style="font-weight:bold;font-family:cursive">More Information</a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form" style="height:auto;width:auto">
              <h3 style="font-weight:bold; ">Approved Appointments<sup><span class="badge badge-primary"><?php
              $sql="SELECT * FROM appointments where c_id='$id' and status=1";
              $query=mysqli_query($conn,$sql);
              $count=mysqli_num_rows($query);
              echo $count;
               ?></span> </sup></h3>
              <a href="view_ac.php" class="btn btn-warning btn-block more" style="font-weight:bold;font-family:cursive">More Information</a>
            </div>
          </div>
        </div>
        </div>
        </div>
      </div>
    </div>
    </body>
  </html>
<?php } else{
  header("Location: ../");
}?>
