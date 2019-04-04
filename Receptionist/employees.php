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
          <span id="header">Employees Details</span>
          <table class="table table-bordered table-striped"style="color:#2C2D6E;font-family:cursive;font-weight:bold;">
            <thead>
              <tr>
                <td>First Name</td>
                <td>Second Name</td>
                <td>Age</td>
                <td>Phone</td>
                <td>Nationality</td>
                <td>Position</td>
              </tr>
            </thead>
            <tbody>
              <?php
              $c="SELECT * FROM users where type='Employee'";
              $qr=mysqli_query($conn,$c);
              while($ro=mysqli_fetch_array($qr)){
                $fn=$ro['fname'];
                $sn=$ro['sname'];
                //count the prisoners assigned a cell
                ?>
              <tr>
                <td><?php echo $fn;?></td>
                <td><?php echo $sn;?></td>
                <td><?php echo $ro['age'];?></td>
                <td><?php echo $ro['c_tel'];?></td>
                <td><?php echo $ro['nationality'];?></td>
                <td><?php echo $ro['position'];?></td>
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
