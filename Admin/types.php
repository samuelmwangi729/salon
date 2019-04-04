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
          <?php
          if(isset($_POST['sub'])){
            $ty=$_POST['stype'];
            $sql="insert into types(name)value('$ty')";
            $query=mysqli_query($conn,$sql);
            if($query){
              echo "
              <div class='alert alert-success'>
              <strong>Success</strong> Service Type Added
              </div>
              ";
            }else{
              echo "
              <div class='alert alert-danger'>
              <strong>Error!!</strong> Service Type Not Added.May already Been Added
              </div>
              ";
            }
          }
           ?>
          <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" class="form" style="margin-top:30px">
            <fieldset><legend id="header" style="color:white">Service Type</legend>
            <div class="row">
              <div class="col-lg-6">
                <label for="Names" class="label-control" id="headerb" >Service Type</label>
                <input type="text" class="form-control input-md" name="stype" placeholder="Eg.Pedicure" required/>
              </div>
              <div class="col-lg-6">
                <button class="btn btn-block btn-primary"type="submit" style="margin-top:30px" name="sub" id="headerb">Add Type</button>
              </div>
            </div>
          </br>
          </fieldset>
          </form>
        </div>
    </div>
    </body>
  </html>
<?php } else{
  header("Location: ../Admin");
}?>
