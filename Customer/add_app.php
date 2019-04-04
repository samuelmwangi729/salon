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
    #headerb{
      color: white;
        font-family:cursive;
        font-size:20px;
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
          <?php
          $n=$_SESSION['user'];
          $sql="select c_id from users where username='$n'";
          $query=mysqli_query($conn,$sql);
          if($row=mysqli_fetch_array($query)){
            $id=$row['c_id'];
          }
          if(isset($_POST['sub'])){
            $ser=$_POST['service'];
            $ad=$_POST['adate'];
            $at=$_POST['atime']."\t".$_POST['at'];
            $sql="INSERT INTO appointments(date,time,c_id,service) values('$ad','$at','$id','$ser')";
            $quer=mysqli_query($conn,$sql);
            if($quer){
              echo "
              <div class='alert alert-success'>
              <strong>Success!!!</strong>Request Sent
              </div>
              ";
            }else{
              echo "
              <div class='alert alert-danger' id='alert'>
              <strong>Failed</strong>Request Not Sent
              </div>
              ";
            }
          }
           ?>
          <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" class="form" style="margin-top:30px">
            <fieldset><legend id="header" style="color:white">Add New Appointment</legend>
            <div class="row">
              <div class="col-lg-3">
              <label for="Names" class="label-control" id="headerb">Service Type</label>
              <select name="service" class="form-control input-md" required autofocus>
                <?php
                $sql="select * from types";
                $query=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($query)){
                  echo "
                  <option>".$row['name']."</option>
                  ";
                }
                 ?>
              </select>
              </div>
              <div class="col-lg-3">
                <label for="Names" class="label-control" id="headerb" >Appointment Date</label>
                <input type="date" class="form-control input-md" name="adate" placeholder="Eg. 10000" required/>
              </div>
              <div class="col-lg-3">
                <label for="Names" class="label-control" id="headerb" >Appointment Time</label>
                <input type="time" class="form-control input-md" name="atime" placeholder="Eg. 10000" required/>
              </div>
              <div class="col-lg-3">
                <label for="Names" class="label-control" id="headerb" >Time of day</label>
              <select  name="at" class="form-control input-md" required>
                <option>AM</option>
                <option>PM</option>
              </select>
              </div>
            </div><br/>
            <button class="btn btn-block btn-primary"type="submit" name="sub" id="headerb">Book Appointment</button>
            <input type="hidden"/>
          </br>
          </fieldset>
          </form>
        </div>
    </div>
    </body>
  </html>
<?php } else{
  header("Location: ../");
}?>
