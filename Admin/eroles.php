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
            $pos=$_POST['pos'];
            $role=$_POST['details'];
            $sql="insert into roles(name,role)values('$pos','$role')";
            $query=mysqli_query($conn,$sql);
            if($query){
              echo "
              <div class='alert alert-success'>
              <strong>Success</strong> Roles Added!!!
              </div>
              ";
            }else{
              echo "
              <div class='alert alert-danger'>
              <strong>Error!!!</strong> The roles Not Added
              </div>
              ";
            }
          }
           ?>
          <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" class="form" style="margin-top:30px">
            <fieldset><legend id="header" style="color:white">Employee Roles</legend>
            <div class="row">
              <div class="col-lg-6">
                <label for="Names" class="label-control" id="headerb" >Employee Position</label>
                <select name="pos" class="form-control input-md">
                  <?php
                  $sql="select * from positions";
                  $query=mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_array($query)){
                    echo "<option>".$row['name']."</option>";
                  }
                   ?>
                </select>
              </div>
              <div class="col-lg-6"><label for="Names" class="label-control" id="headerb">Details</label>
              <textarea class="form-control input-lg" name="details" required rows="5" placeholder="Enter the roles Here"></textarea>
              </div>
            </div><br>
            <button type="submit" class="btn btn-success btn-block" name="sub">Add Roles</button>
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
