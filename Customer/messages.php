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
          <span id="header">Messages  Sent &amp;Received</span>
          <table class="table table-bordered table-striped"style="color:#2C2D6E;font-family:cursive;font-weight:bold;">
            <thead>
              <tr>
                <td>Sent By</td>
                <td>message</td>
                <td>Reply</td>
                <td>Action</td>
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
              if(isset($_POST['sub'])){
                $message=$_POST['message'];
                $sql="insert into messages(from_c,body)values('$id','$message')";
                $sent=mysqli_query($conn,$sql);
                if($sent){
                  echo "
                  <div class='alert alert-success' id='alert'>
                  <strong>Success!!!</strong>Message Sent
                  </div>
                  ";
                }else{
                  echo "
                  <div class='alert alert-danger' id='alert'>
                  <strong>Error!!!</strong>Message not  Sent
                  </div>
                  ";
                }
              }
              $c="SELECT * FROM messages where from_c='$id'";
              $qr=mysqli_query($conn,$c);
              $c=mysqli_num_rows($qr);
              if($c==0){
                echo "
                <div class='alert alert-danger' id='alert'>
                <strong>Message Box Empty</strong>No messages Sent
                </div>
                ";
              }
              while($ro=mysqli_fetch_array($qr)){
                //count the prisoners assigned a cell
                ?>
              <tr>
                <td><?php echo $ro['from_c'];?></td>
                <td><?php echo $ro['title']."\t".$ro['body'];?></td>
                <td><?php echo $ro['reply'];?></td>
                <td><a href="reply.php?id=<?php echo $ro['from_c'];?>">Reply</a></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
         <div class="col-lg-6">
           <textarea name="message" class="form-control input-lg" rows="5" placeholder="Type your Message Here"></textarea>
           <br>
           <button type="submit" class="btn btn-success" name="sub">Send Message</button>
         </div>
          </form>
        </div>
    </div>
    </body>
  </html>
<?php } else{
  header("Location: ../");
}?>
