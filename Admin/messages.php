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
      <div class="navbar-brand"id="header"><a href="dashboard.php" style="color:white;text-decoration:none;"><marquee>Melly's Salon management System</marquee></a>
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
          <span id="header">Messages Received</span>
          <table class="table table-bordered table-striped"style="color:#2C2D6E;font-family:cursive;font-weight:bold;">
            <thead>
              <tr>
                <td>Sent By</td>
                <td>Title</td>
                <td>Body</td>
                <td>Status</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
              <?php
              $c="SELECT * FROM messages";
              $qr=mysqli_query($conn,$c);
              $count=mysqli_num_rows($qr);
              if($count==0){
                echo "
                <div class='alert alert-danger'>
                <strong>Empty </strong> No Messages 
                </div>
                ";
              }
              while($ro=mysqli_fetch_array($qr)){
                //count the prisoners assigned a cell
                ?>
              <tr>
                <td><?php echo $ro['from_c'];?></td>
                <td><?php echo $ro['title'];?></td>
                <td><?php echo $ro['body'];?></td>
                <td><?php
                if($ro['status']==0){
                  echo "<span style='color:red'>Unattended</span>";
                }else{
                  echo "<span style='color:blue'>Answered</span>";
                }
                ?></td>
                <td><a href="reply.php?id=<?php echo $ro['from_c'];?>">Reply</a></td>
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
