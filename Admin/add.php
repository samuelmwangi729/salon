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
            $fname=$_POST['fname'];
            $sname=$_POST['sname'];
            $tel=$_POST['tel'];
            $id=$_POST['id'];
            $age=$_POST['age'];
            $nat=$_POST['nat'];
            $username=$_POST['uname'];
            $positions=$_POST['positions'];
            $boss=$_POST['boss'];
            $pay=$_POST['pay'];
            $pass=sha1($_POST['pass']);
            $cpass=sha1($_POST['cpass']);
            $email=$_POST['email'];
            if($pass==$cpass){
              //if the two passwords match insert into the database
              $sql="insert into users(fname,sname,username,email,password,c_id,c_tel,age,nationality,position,boss,pay,type)values(
                '$fname','$sname','$username','$email','$pass','$id','$tel','$age','$nat','$positions','$boss','$pay','Employee')";
                $query=mysqli_query($conn,$sql);
                if($query){
                  echo "
                  <div class='alert alert-success'>
                  <strong>Success</strong> Employee Registered
                  </div>
                  ";
                }else{
                  echo "
                  <div class='alert alert-danger'>
                  <strong>Error!!!</strong> Employee Not Added
                  </div>
                  ";
                }
            }else{
              echo "
              <div class='alert alert-danger'>
              <strong>Error!!!</strong> Passwords Do not Match
              </div>
              ";
            }
          }
           ?>
          <div class="container-fluid" style="text-align:center;margin-bottom:10px">
            <a href="add.php" class="btn btn-primary">Add New Employee</a>
            <a href="emp.php" class="btn btn-warning">View Employee</a>
          </div>
          <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" class="form">
            <fieldset><legend id="header" style="color:white">Add New Employee</legend>
            <div class="row">
              <div class="col-lg-3">
                <label for="Names" class="label-control" id="headerb">First Name</label>
                <input type="text" class="form-control input-md"  name="fname" placeholder="Enter The First Name" required/>
              </div>
              <div class="col-lg-3"><label for="Names" id="headerb" class="label-control">Surname</label>
              <input type="text" class="form-control input-md" name="sname" placeholder="Surname" required/>
              </div>
              <div class="col-lg-3"><label for="Names" id="headerb" class="label-control">Tel Number</label>
              <input type="number" class="form-control input-md"  name="tel" placeholder="Telephone Number" required minlength="8"/>
              </div>
              <div class="col-lg-3"><label for="Names" id="headerb" class="label-control">Id Number</label>
              <input type="number" class="form-control input-md" name="id" placeholder="Enter The id Number" required />
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
              <label for="Names" class="label-control" id="headerb">Employee Age</label>
              <input type="number" name="age"class="form-control input-md" placeholder="Enter The Age" required/>
              </div>
              <div class="col-lg-3">
                <label for="Names" class="label-control" id="headerb">Nationality</label>
                <input type="text" class="input-md form-control" name="nat" placeholder="Enter the Nationality" required/>
              </div>
              <div class="col-lg-3"><label for="Names" class="label-control" id="headerb">Username</label>
              <input type="text" name="uname"class="form-control input-md" placeholder="Username" required/>
              </div>
              <div class="col-lg-3"><label for="Names" class="label-control" id="headerb">Position Awarded</label>
                <select name="positions" class="form-control input-md" required>
                  <?php
                  $sql="select * from positions";
                  $query=mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_array($query)){?>
                  <option><?php echo $row['name'];?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
              <label for="Names" class="label-control" id="headerb">Reports To</label>
              <select name="boss" class="form-control input-md" required>
                <?php
                $sql="select * from users where type='Employee'";
                $query=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($query)){?>
                <option><?php echo $row['position']."\t".$row['sname'];?></option>
              <?php } ?>
              </select>
              </div>
              <div class="col-lg-3">
                <label for="Names" class="label-control" id="headerb" >Paid</label>
                <input type="number" class="form-control input-md"  name="pay" placeholder="Eg. 10000" required/>
              </div>
              <div class="col-lg-3"><label for="Names" class="label-control" id="headerb">Login Password</label>
              <input type="text" name="pass"class="form-control input-md" placeholder="Please Make sure that you" required/>
              </div>
              <div class="col-lg-3"><label for="Names" class="label-control" id="headerb">Confirm Password</label>
                <input type="text"name="cpass" class="input-md form-control" placeholder="Remember Your Password"/>
              </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12">
                  <label for="Names" class="label-control" id="headerb">Employee Email Address</label>
                  <input type="email"name="email" class="input-md form-control" placeholder="Enter Your Email Here"/>
                </div>
            </div><br>
            <button class="btn btn-block btn-primary"type="submit" name="sub" id="headerb">Add Employee</button>
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
