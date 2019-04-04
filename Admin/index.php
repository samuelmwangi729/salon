<?php
require('config.php');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SMS | Login</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/custom.css">
    <link rel="stylesheet" href="../Assets/css/all.min.css">
    <script src="../Assets/js/bootstrap.js"></script>
    <script src="../Assets/js/jquery.min.js"></script>
    <style>
    form{
        margin-top:30px;
    }
    #header{
        border:1px solid red;
        border-radius:100px;
        font-family:cursive;
        font-size:40px;
        font-weight:bold;
        text-align:center;
        text-shadow:2px 2px red;
    }.label-control{
        font-family:cursive;
        font-size:20px;
        font-weight:bold;
    }
    #footer{
        font-family:cursive;
        font-size:20px;
        font-weight:bold;
        text-align:center;
        text-shadow:2px 2px red;
    }
    </style>
  </head>
  <body>
    <div class="body">
      <div class="container">
      <div class="container">
      <?php
      if(isset($_POST['sub'])){
          $name=$_POST['username'];
          $pass=sha1($_POST['password']);
          $sql="SELECT * FROM users WHERE username='$name' AND password='$pass' AND position='Manager'";
           $query=mysqli_query($conn,$sql);
           $count=mysqli_num_rows($query);
           if($row=mysqli_fetch_array($query)){
               $type=$row['type'];
           }
          if($count==1){
            session_start();
            $_SESSION['user']=$name;
              header("Location: dashboard.php");
          }else{
            echo "
            <div class='alert alert-danger' id='alert'>
            <a href='#' data-dismiss='alert' class='close'>&times</a>
            <strong>Error!!!</strong>Login Failed,Try Again
            </div>
            ";
          }
      }
      if(isset($_POST['sign'])){
        $name=$_POST['fname'];
        $sname=$_POST['sname'];
        $username=$_POST['uname'];
        $email=$_POST['uemail'];
        $pass=sha1($_POST['pass']);
        $cpass=sha1($_POST['cpass']);
        if($pass!=$cpass){
            echo "
            <div class='alert alert-danger' id='alert'>
            <a href='#' data-dismiss='alert' class='close'>&times</a>
            <strong>Error!!!</strong>Your Passwords Do Not Match
            </div>
            ";
        }else{
            $sql="insert into users(fname,sname,username,email,password)values('$name','$sname','$username','$email','$pass')";
            $query=mysqli_query($conn,$sql);
                echo "
                <div class='alert alert-success' id='alert'>
                <a href='#' data-dismiss='alert' class='close'>&times</a>
                <strong>Success</strong>You are Now Registered.Please Login To Continue
                </div>
                ";
        }
    }


?>
      </div>
        <form  method="POST" action="<?php $_SERVER['PHP_SELF']?>">
          <fieldset>
            <legend id="header"><p>Melly's Salon management System</p></legend>
            <label for="Username" class="label-control">Username</label>
            <input type="text" name="username" class="form-control input-md" placeholder="enter the Username here" required minlength="5"/>
              <label for="Password" class="label-control">Password</label>
              <input type="password"  name="password" class="form-control input-md" placeholder="enter the Password here" required minlength="8"/>
              </br>
              <button type="submit" class="btn btn-primary btn-block" name="sub">Login</button>
              <a href="#" id="nm">Forgot Password?</a>
          </fieldset>
        </form>
    </div>
    <!--the siign up modal-->
    <div class="modal" id="smodal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header"style="padding-left:100px;">
                        <h3 class="modal-title" id="header">Retrieve Password</h3>
                            <button type="button" id="sclose" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                </div>
            <div class="modal-body">
                <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="Username" class="label-control">Username</label>
                        <input type="text"class="form-control input-md" name="uname" placeholder="Enter the UserName Here" required/>
                    </div>
                    <div class="col-lg-6">
                    <label for="Username" class="label-control">Email Address</label>
                        <input type="email" class="form-control input-md" name="uemail" placeholder="Enter the Email Here" required/>
                </div>
                <button class="btn btn-block btn-primary" type="submit" name="sign" style="margin-top:20px">Retrieve</button>
                </form>
            </div>
            <div class="modal-footer" id="footer">
               &copy Melly's
            </div>
        </div>
    </div>
</div>
    <!--included are precompiled bootstrap and jquery-->
    <script>
    $(document).ready(function(){
        $("#nm").click(function(){
            $("#smodal").show("fade");
        });
        $("#sclose").click(function(){
            $("#smodal").hide('fade');
        });
        $(".close").click(function(){
            $("#alert").hide('fade');
        });
    });
    </script>
  </body>
</html>
