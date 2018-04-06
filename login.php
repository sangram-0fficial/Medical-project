<html>
<head>
  <title>
    Log In
  </title>
  <link rel="stylesheet" type="text/css" href="css/login.css"></link>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>
<?php
            error_reporting(0);
            require('Myconnection.php');     
            if($_REQUEST['button']!=NULL)
            {
                
                $id=$_REQUEST['username'];
                $password=$_REQUEST['password'];
                $query="SELECT * FROM new_admin WHERE aid=$id";
                mysqli_query($con,$query);
                $result=  mysqli_query($con, $query);
                $row=  mysqli_fetch_array($result);
                if($row[5]==$password)
                {
                    session_start();                   
                    $_SESSION['admin_id']=$row[0];
                    header('Location:current_admin.php');
                }
                else
                {
                    echo"<script>alert('Invalid Password');</script>";
                }
            }
        ?>
</head>
<body>
  <div class="container">
    <form action="login.php" method="post">
      <img src="dentisticon.png">
      <div class="input">
        <input type="text" name="username" placeholder="Enter Your Username">
      </div>
      <div class="input">
        <input type="password" name="password" placeholder="Enter Your Password">
      </div>
      <div class="login_button">
        <input type="submit" name="button" value="Log In">
      </div>


    </form>
  </div>
</body>
</html>
