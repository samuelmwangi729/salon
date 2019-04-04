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
            $pos=$_POST['erole'];
            $sql="insert into positions(name)values('$pos')";
            $query=mysqli_query($conn,$sql);
            if($query){
              echo "
              <div class='alert alert-success'>
              <strong>Success</strong> Position Added
              </div>
              ";
            }else{
              echo "
              <div class='alert alert-danger'>
              <strong>Success</strong> Position Not Added
              </div>
              ";
            }
          }
          if(isset($_GET['delete'])){
            $del_name=$_GET['delete'];
            $sql="delete from positions where name='$del_name'";
            $query=mysqli_query($conn,$sql);
            if($query){
              echo "
              <div class='alert alert-success'>
              <strong>Success</strong> Position Deleted
              </div>
              ";
            }else{
              echo "
              <div class='alert alert-danger'>
              <strong>Success</strong> Position Could Not be Removed
              </div>
              ";
            }
          }
           ?>
          <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" class="form" style="margin-top:30px">
            <fieldset><legend id="header" style="color:white">Employee Positions</legend>
            <div class="row">
              <div class="col-lg-6">
                <label for="Names" class="label-control" id="headerb" >Employee Position</label>
                <input type="text" class="form-control input-md" name="erole" placeholder="Eg.Manager" required/>
              </div>
              <div class="col-lg-6">
                <button class="btn btn-block btn-primary"type="submit" style="margin-top:30px" name="sub" id="headerb">Add Position</button>
              </div>
            </div>
          </br>
          </fieldset>
          </form>
          <br><span style="color:black;font-family:cursive;text-shadow:1px 1px red;font-size:20px">Positions Available</span>
          <table class="table table-bordered table-striped"style="color:#2C2D6E;font-family:cursive;font-weight:bold;">
            <thead>
              <tr>
                <td>Id</td>
                <td>Position</td>
                <td colspan="2">Action</td>
              </tr>
            </thead>
            <tbody>
              <?php
              $c="SELECT * FROM positions";
              $qr=mysqli_query($conn,$c);
              $c=0;
              while($ro=mysqli_fetch_array($qr)){
                $c=$c+1;

                //count the prisoners assigned a cell
                ?>
              <tr>
                <td><?php echo $c;?></td>
                <td><?php echo $ro['name'];?></td>
                <td><a  class="btn btn-danger btn-block"href="ranks.php?delete=<?php echo $ro['name'];?>">Delete</a></td>
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
