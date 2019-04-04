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
      <div class="navbar-brand"id="header"><a href="../Customer" style="color:white;text-decoration:none;">Melly's Salon management System</a>
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
          <div class="container-fluid" style="text-align:center;margin-bottom:10px">
            <a href="add_app.php" class="btn btn-warning">New Appointment</a>
          </div>
          <span id="header">Appointments</span>
          <?php if(isset($_GET['approve'])){
            $approve=$_GET['approve'];
            $sql="update appointments set status=1 where id='$approve'";
            $upd=mysqli_query($conn,$sql);
            if($upd){
              echo "
              <div class='alert alert-success'>
              <strong>Success</strong> Appointment Approved
              </div>
              ";
            }else{
              echo "
              <div class='alert alert-danger'>
              <strong>Error!!!</strong> Service Not Approved
              </div>
              ";
            }
          }
           ?>
           <?php if(isset($_GET['reject'])){
             $approve=$_GET['reject'];
             $sql="update appointments set status=0 where id='$approve'";
             $upd=mysqli_query($conn,$sql);
             if($upd){
               echo "
               <div class='alert alert-success'>
               <strong>Success</strong> Appointment Rejected
               </div>
               ";
             }else{
               echo "
               <div class='alert alert-danger'>
               <strong>Error!!!</strong> Appointment Not Rejected
               </div>
               ";
             }
           }
            ?>
          <table class="table table-bordered table-striped"style="color:#2C2D6E;font-family:cursive;font-weight:bold;">
            <thead>
              <tr>
                <td>Client Id</td>
                <td>Date</td>
                <td>Time</td>
                <td>Service</td>
              </tr>
            </thead>
            <tbody>
              <?php
              $n=$_SESSION['user'];
              $sql="select c_id from users where username='$n'";
              $query=mysqli_query($conn,$sql);
              if($row=mysqli_fetch_array($query)){
                $id=$row['c_id'];
              }
              $c="SELECT * FROM appointments where c_id='$id'";
              $qr=mysqli_query($conn,$c);
              $c=mysqli_num_rows($qr);
              if($c==0){
                echo "
                <div class='alert alert-danger'>
                <strong>Not Found!!!</strong>No Appointments Made By You
                </div>
                ";
              }
              while($ro=mysqli_fetch_array($qr)){
                //count the prisoners assigned a cell
                ?>
              <tr>
                <td><?php echo $ro['c_id'];?></td>
                <td><?php echo $ro['date'];?></td>
                <td><?php echo $ro['time'];?></td>
                <td><?php echo $ro['service'];?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
    </div>
    </body>
  </html>
<?php } else{
  header("Location: ../");
}?>
