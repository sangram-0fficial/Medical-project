<html>
    <head>
        <meta charset="UTF-8">
        <title>New Administrator</title>
        <link rel="stylesheet" href="Bootstrap/bootstrap.min.css" />
        <?php
            error_reporting(0);
            require('Myconnection.php');
            $query_get="SELECT max(aid) FROM new_admin";
            $result=  mysqli_query($con, $query_get);
            $arr=  mysqli_fetch_array($result);
            if($arr[0]==NULL)
            {
                $id=101;
            }
            else
            {
                $id=$arr[0]+1;
            }
            if($_REQUEST['btn_submit']!=null)
            {
                $name=$_REQUEST['text_name'];
                $conta=$_REQUEST['text_contact'];
                $email=$_REQUEST['text_email'];
                $desc=$_REQUEST['text_desc'];
                $address=$_REQUEST['text_address'];
                $confpass=$_REQUEST['text_password_conf'];
                $password=$_REQUEST['text_password'];
                if($name==null || $conta==null || $email==null || $desc==null || $password==null)
                {
                    echo"<script>alert('Sorry Some Fields Are Empty !');</script>";
                }
                else if($password!=$confpass)
                {
                    echo"<script>alert('Sorry Password Mismatch !');</script>";
                }
                else
                {
                    $query="INSERT INTO new_admin VALUES($id,'$name','$conta','$email','$desc','$password')";
                    mysqli_query($con,$query);
                    header("Location:Dental_Home_Page.php");
                }
                
            }
        ?>
        <style>
            #form_table tr
            {
                border: solid white 3px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h1>New Administrator&nbsp;&nbsp;&nbsp;<small><a href="Dental_Home_Page.php" style="color:white">Rajdhani Dental Clinic</a></small></h1>
                </div>
                <div class="panel-body">
                    <form method="POST" action="new_admin.php" name="admin_form">             
                        <table class="table" id="form_table">
                            <tr>
                                <td><b>Name</b></td>
                                <td><input type="text" name="text_name" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td><b>Contact</b></td>
                                <td><input type="text" name="text_contact" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td><input type="text" name="text_email" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td><b>Description</b></td>
                                <td><textarea name="text_desc" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                                <td><b>Password</b><br><br><b>Confirm Password</b></td>
                                <td>
                                    <input type="password" name="text_password" class="form-control" />
                                    <br>
                                    <input type="password" name="text_password_conf" class="form-control" />
                                </td>   
                            </tr>
                            <tr>
                                <td><input type="submit" name="btn_submit" class="form-control btn-success" value="save" /></td>
                                <td><?php echo"<input type='text' class='form-control' value='Your ID $id' readonly />" ?></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>