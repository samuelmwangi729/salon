<?php
include('config.php');
session_start();
if(isset($_SESSION['user'])){
  $id=$_GET['id'];
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
          $sc="select * from messages";
          $query=mysqli_query($conn,$sc);
          $count=mysqli_num_rows($query);
          $message=$_POST['message'];
          $sql1="update messages set reply='$message' where from_c='$id' and id='$count'";
          $sql2="update messages set status='1' where from_c='$id' and id='$count'";
          $qry1=mysqli_query($conn,$sql1);
          $qry=mysqli_query($conn,$sql2);
        }
         ?>
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2" style="margin-left:0px;">
        <?php include('sidebar.php'); ?>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10">
          <span id="header">Messages Center.Message Sent By Client id.<?php echo $id?></span>
          <div class="row">
            <div class="col-lg-6">
              <span class="text-danger">Received</span>
            </div>
            <div class="col-lg-6">
              <span class="text-success">Reply</span>
            </div>
          </div>
          <?php
          $sql="select * from messages where from_c='$id' order by id DESC limit 3";
          $query=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_array($query)){
          ?>
          <div class="row">
            <div class="col-lg-6">
              <input type="hidden" name="id" value="<?php echo $id;?>" class="form-control input-md" disabled/>
              <input type="text"value="<?php echo $row['body'];?>" class="form-control input-md" disabled/><br>
            </div>
            <div class="col-lg-6">
              <input type="text"value="<?php echo $row['reply'];?>" class="form-control input-md" disabled/>
            </div>
          </div>
        <?php } ?><br><br><br>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
       <div class="col-lg-6">
         <textarea name="message" class="form-control input-lg" rows="5" placeholder="Type your Message Here"></textarea>
         <br>
         <button type="submit" class="btn btn-success" name="sub">Send</button>
       </div>
        </form>
        </div>
    </div>
    </body>
  </html>
<?php } else{
  header("Location: ../Admin");
}?>
