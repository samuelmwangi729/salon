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
          <span id="header">All Employees</span>
          <?php
          if(isset($_GET['sack'])){
            $id=$_GET['sack'];
            $sql="update users set status=0 where id='$id'";
            $query=mysqli_query($conn,$sql);
            if($query){
              echo "
              <div class='alert alert-success'>
              <strong>Success</strong> Employee Suspended
              </div>
              ";
            }else{
              echo "
              <div class='alert alert-danger'>
              <strong>Error!!!</strong> Employee Not Suspended
              </div>
              ";
            }
          }
           ?>
           <?php
           if(isset($_GET['active'])){
             $id=$_GET['active'];
             $sql="update users set status=1 where id='$id'";
             $query=mysqli_query($conn,$sql);
             if($query){
               echo "
               <div class='alert alert-success'>
               <strong>Success</strong> Employee Reinstated
               </div>
               ";
             }else{
               echo "
               <div class='alert alert-danger'>
               <strong>Error!!!</strong> Employee Not Reinstated
               </div>
               ";
             }
           }
            ?>
          <table class="table table-bordered table-striped"style="color:#2C2D6E;font-family:cursive;font-weight:bold;">
            <thead>
              <tr>
                <td>First Name</td>
                <td>Second Name</td>
                <td>Id Number</td>
                <td>Email</td>
                <td>Job Position</td>
                <td>Reports to</td>
                <td>Salary</td>
                <td>Status</td>
                <td colspan="2" class="text-center" style="font-size:20px">Actions</td>
              </tr>
            </thead>
            <tbody>
              <?php
              $c="SELECT * FROM users WHERE type='Employee'";
              $qr=mysqli_query($conn,$c);
              $count=mysqli_num_rows($qr);
              if($count==0){
                echo "
                <div class='alert alert-danger'>
                <strong>Empty </strong> No Employees
                </div>
                ";
              }
              while($ro=mysqli_fetch_array($qr)){
                $fn=$ro['fname'];
                $sn=$ro['sname'];

                //count the prisoners assigned a cell
                ?>
              <tr>
                <td><?php echo $fn;?></td>
                <td><?php echo $sn;?></td>
                <td><?php echo $ro['c_id'];?></td>
                <td><?php echo $ro['email'];?></td>
                <td><?php echo $ro['position'];?></td>
                <td><?php echo $ro['boss'];?></td>
                <td style="font-size:12px;"><?php echo "Ksh ".$ro['pay'];?></td>
                <td><?php
                if($ro['status']==1){
                  echo "<span style='color:green'>Active</span>";
                }else{
                  echo "<span style='color:red'>Suspended</span>";
                }
                ?></td>
                <td><a  class="btn btn-warning btn-block"href="emp.php?sack=<?php echo $ro['id'];?>">Suspend</a></td>
                <td><a  class="btn btn-warning btn-block"href="emp.php?active=<?php echo $ro['id'];?>">Reinstate</a></td>
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
