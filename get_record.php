<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Bootstrap/bootstrap.min.css" />
        <title>RDC Records</title>
        <link rel="shortcut icon" href="http://matchthemes.com/demohtml/dentalclinic/images/favicon.ico">
        <?php
            error_reporting(0);
            require('Myconnection.php');
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $query="SELECT * FROM patient_master";
                $result=mysqli_query($con, $query);
                while($row=mysqli_fetch_array($result))
                {
                    
                    if($_REQUEST[$row[0]]!=NULL)
                    {
                        $operation=$_REQUEST[$row[0]];
                        if($operation=='Delete')
                        {
                            try
                            {
                                $query="DELETE FROM patient_master WHERE pid=$row[0]";
                                mysqli_query($con, $query);
                                echo"<script>alert('Record Deleted');</script>";
                            }
                            catch(Exception $ex)
                            {
                                echo"<script>alert($e);</script>";
                            }
                            
                        }
                        else if($operation=='Edit')
                        {
                            try
                            {
                                session_start();
                                $_SESSION['edit_id']=$row[0];
                                $_SESSION['edit_name']=$row[2];
                                $_SESSION['edit_age']=$row[3];
                                $_SESSION['edit_sex']=$row[4];
                                $_SESSION['edit_address']=$row[5];
                                $_SESSION['edit_contact']=$row[6];
                                header("Location:edit_patient_master.php");
                            } 
                            catch (Exception $ex) 
                            {
                                echo"<script>alert($e);</script>";
                            }
                        }
                        else if($operation=='Upload')
                        {
                            try
                            {
                                session_start();
                                $_SESSION['upload_id']=$row[0];
                                $_SESSION['upload_name']=$row[2];
                                header("Location:upload_patient.php");
                            } 
                            catch (Exception $ex) 
                            {
                                echo"<script>alert($e);</script>";
                            }
                        }
                        else if($operation=='View')
                        {
                            try
                            {
                                session_start();
                                $_SESSION['select_id']=$row[0];
                                header("location:get_record_advance1.php"); 
                            } 
                            catch (Exception $ex) 
                            {
                                echo"<script>alert($e);</script>";
                            }
                        }
                    }
                }
            }
        ?>
        <style>
            #record_table tr
            {
                border-top: solid #79a6d2 5px;
            }
            #div_main
            {
                box-shadow: 5px 5px 5px #79a6d2;
                padding-top: 15px;
            }
            body
            {
                padding-top:30px;
            }
        </style>
    </head>
    <body>
        <div class="container" id="div_main">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3>Get Records&nbsp;&nbsp;&nbsp;<small><a href="current_admin.php" style="color:white">Current Admin</a></small></h3></div>
                <div class="panel-footer">
                    <form method="POST" action="get_record.php" class="form-group-sm form-inline" style="margin: 10px">
                        <input type="text" name="text_data1" class="form-control" value="Name" id="txt_clear" onclick="this.value=''"/>
                        <input type="submit" value="search" name="btn_submit1" class="form-control"/>
                        <select name='drop_location' class="form-control">
                            <option>----- Select -----</option>
                            <?php
                                error_reporting(0);
                                require('Myconnection.php');
                                session_start();
                                $admin=$_SESSION['admin_id'];
                                $query="SELECT distinct(address) FROM patient_master WHERE admin_id=$admin";
                                $result=mysqli_query($con,$query);
                                while($row=  mysqli_fetch_array($result))
                                {
                                    echo"<option>$row[0]</option>";
                                }
                                echo"</select>";
                            ?>
                        </select>
                        <input type="submit" value="search" name="btn_submit2" class="form-control"/>               
                    </form>
                </div>
            </div>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading"><b>Patient Records&nbsp;&nbsp;&nbsp;<small>Rajdhani Dental Clinic</small></b></div>
                <div class="panel-body" style="background-color: white">
                    <form action='get_record.php' method="POST">
                        <table class="table" id="record_table">
                            <tr>
                                <td><b>ID</b></td>
                                <td><b>Name</b></td>
                                <td><b>Age</b></td>
                                <td><b>Sex</b></td>
                                <td><b>Address</b></td>
                                <td><b>Contact</b></td>
                                <td><b>Delete</b></td>
                                <td><b>Edit</b></td>
                                <td><b>Upload</b></td>
                                <td><b>View</b></td>
                            </tr>                   
                            <?php     
                                session_start();
                                $admin_id=$_SESSION['admin_id'];
                                if($_REQUEST['btn_submit1']!=NULL)
                                {                           
                                    $data=$_REQUEST['text_data1'];
                                    $query="SELECT * FROM patient_master WHERE name LIKE '$data%' and admin_id=$admin_id;";
                                    $result=mysqli_query($con,$query);
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        echo"<tr>";
                                        echo"<td>$row[0]</td>";
                                        echo"<td>$row[2]</td>";
                                        echo"<td>$row[3]</td>";
                                        echo"<td>$row[4]</td>";
                                        echo"<td>$row[5]</td>";
                                        echo"<td>$row[6]</td>";
                                        echo"<td><input type='submit' name='$row[0]' value='Delete' class='form-control btn-danger' id='btn_delete' onclick='return confirm(\"Are you sure?\");'/></td>";
                                        echo"<td><input type='submit' name='$row[0]' value='Edit' class='form-control btn-success' id='btn_edit' /></td>";
                                        echo"<td><input type='submit' name='$row[0]' value='Upload' class='form-control btn-warning' id='btn_upload' /></td>";
                                        echo"<td><input type='submit' name='$row[0]' value='View' class='form-control btn-info' id='btn_view' /></td>";
                                        echo"</tr>";
                                    }
                                }
                                elseif($_REQUEST['btn_submit2']!=NULL)
                                {      
                                    $data=$_REQUEST['drop_location'];
                                    $query="SELECT * FROM patient_master WHERE address='$data' and admin_id=$admin_id;";
                                    $result=mysqli_query($con,$query);
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        echo"<tr>";
                                        echo"<td>$row[0]</td>";
                                        echo"<td>$row[2]</td>";
                                        echo"<td>$row[3]</td>";
                                        echo"<td>$row[4]</td>";
                                        echo"<td>$row[5]</td>";
                                        echo"<td>$row[6]</td>";
                                        echo"<td><input type='submit' name='$row[0]' value='Delete' class='form-control btn-danger' id='btn_delete' onclick='return confirm(\"Are you sure?\");'/></td>";
                                        echo"<td><input type='submit' name='$row[0]' value='Edit' class='form-control btn-success' id='btn_edit' /></td>";
                                        echo"<td><input type='submit' name='$row[0]' value='Upload' class='form-control btn-warning' id='btn_upload' /></td>";
                                        echo"<td><input type='submit' name='$row[0]' value='View' class='form-control btn-info' id='btn_view' /></td>";
                                        echo"</tr>";
                                    }
                                }
                            ?>                    
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>