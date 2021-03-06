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
      <div class="navbar-brand"id="header"><a href="dashboard.php" style="color:white;text-decoration:none;">Melly's Salon management System</a>
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
          <span id="header">All Appointments</span>
          <table class="table table-bordered table-striped"style="color:#2C2D6E;font-family:cursive;font-weight:bold;">
            <thead>
              <tr>
                <td>Client Id</td>
                <td>Date</td>
                <td>Time</td>
                <td>Service</td>
                <td>Status</td>
              </tr>
            </thead>
            <tbody>
              <?php
              $c="SELECT * FROM appointments where status=1";
              $qr=mysqli_query($conn,$c);
              while($ro=mysqli_fetch_array($qr)){
                //count the prisoners assigned a cell
                ?>
              <tr>
                <td><?php echo $ro['c_id'];?></td>
                <td><?php echo $ro['date'];?></td>
                <td><?php echo $ro['time'];?></td>
                <td><?php echo $ro['service'];?></td>
                <td><?php
                if($ro['status']==0){
                  echo "<span style='color:red'>Pending</span>";
                }else{
                  echo "<span style='color:green'>Attended</span>";
                }
                ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
    </div>
    </body>
  </html>
<?php } else{
  header("Location: ../Admin");
}?>
