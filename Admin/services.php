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
            <a href="new_service.php" class="btn btn-warning">New Service</a>
          </div>
          <span id="header">Services</span>
          <?php if(isset($_GET['approve'])){
            $approve=$_GET['approve'];
            $sql="update services set status=1 where id='$approve'";
            $upd=mysqli_query($conn,$sql);
            if($upd){
              echo "<script>window.open('services.php','_self');</script>";
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
             $sql="update services set status=0 where id='$approve'";
             $upd=mysqli_query($conn,$sql);
             if($upd){
               echo "<script>window.open('services.php','_self');</script>";
             }else{
               echo "
               <div class='alert alert-danger'>
               <strong>Error!!!</strong> Service Not Rejected
               </div>
               ";
             }
           }
            ?>
            <?php if(isset($_GET['delete'])){
              $approve=$_GET['delete'];
              $sql="delete from services where id='$approve'";
              $upd=mysqli_query($conn,$sql);
              if($upd){
                echo "
                <div class='alert alert-success'>
                <strong>Success</strong> Service Deleted
                </div>
                ";
              }else{
                echo "
                <div class='alert alert-danger'>
                <strong>Error!!!</strong> Service Not Deleted
                </div>
                ";
              }
            }
             ?>
          <table class="table table-bordered table-striped"style="color:#2C2D6E;font-family:cursive;font-weight:bold;">
            <thead>
              <tr>
                <td>Service</td>
                <td>Description</td>
                <td>Pay</td>
                <td>Status</td>
                <td colspan="4" class="text-center">Actions</td>
              </tr>
            </thead>
            <tbody>
              <?php
              $c="SELECT * FROM services";
              $qr=mysqli_query($conn,$c);
              while($ro=mysqli_fetch_array($qr)){
                //count the prisoners assigned a cell
                ?>
              <tr>
                <td><?php echo $ro['title'];?></td>
                <td><?php echo $ro['description'];?></td>
                <td><?php echo $ro['pay'];?></td>
                <td><?php if($ro['status']==0){
                  echo "<span style='color:red'>Pending</span>";
                }else{
                  echo "<span style='color:blue'>Approved</span>";
                }?></td>
                <td><a class="btn btn-success btn-block" href="services.php?approve=<?php echo $ro['id']; ?>">Approve</a></td>
                <td><a class="btn btn-primary btn-block" href="services.php?reject=<?php echo $ro['id']; ?>">Reject</a></td>
                <td><a class="btn btn-info btn-block" href="s_edit.php?edit=<?php echo $ro['id']; ?>">Edit</a></td>
                <td><a  class="btn btn-danger btn-block" href="services.php?delete=<?php echo $ro['id']; ?>">Delete</a></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
    </div>
    </body>
  </html>
<?php }
 else{
  header("Location: ../Admin");
}?>
