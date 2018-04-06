<html>
    <head>
        <title>New Entry</title>
        <link rel="stylesheet" href="Bootstrap/bootstrap.min.css" />
        <link rel="stylesheet" href="form_style.css" />
        <title>RDC Appointment</title>
        <link rel="shortcut icon" href="http://matchthemes.com/demohtml/dentalclinic/images/favicon.ico">
        <?php
            error_reporting(0);
            session_start();
            $admin_id=$_SESSION['admin_id'];
            require('Myconnection.php');
            $query_get="SELECT max(pid) FROM patient_master";
            $result=  mysqli_query($con, $query_get);
            $row=mysqli_fetch_array($result);
            if($row[0]==NULL)
            {
                $pid='1001';
            }
            else
            {
                $pid=$row[0]+1;
            }
            if($_REQUEST['Upload']!=NULL)
            {
                $name=$_REQUEST['text_name'];
                $age=$_REQUEST['drop_age'];
                $sex=$_REQUEST['sex'];
                $address=$_REQUEST['text_address'];
                $contact=$_REQUEST['text_contact'];
                $query1="INSERT INTO patient_master VALUES($pid,$admin_id,'$name','$age','$sex','$address','$contact');";
                mysqli_query($con,$query1);
                //--------------------------------------------- Set New Appointement ID ---------------------------------------------
                $query_get1="SELECT max(aid) FROM patient_appointment";
                $result1=  mysqli_query($con, $query_get1);
                $row1=mysqli_fetch_array($result1);
                if($row1[0]==NULL)
                {
                    $aid='11';
                }
                else
                {
                    $aid=$row1[0]+1;
                }
                //-------------------------------------------------------------------------------------------------------------------
                $cur_day=$_REQUEST['arr_day'];
                $cur_month=$_REQUEST['arr_month'];
                $cur_year=$_REQUEST['arr_year'];
                $next_day=$_REQUEST['next_day'];
                $next_month=$_REQUEST['next_month'];
                $next_year=$_REQUEST['next_year'];
                $query2="INSERT INTO patient_appointment VALUES($pid,$aid,'$cur_day','$cur_month','$cur_year','$next_day','$next_month','$next_year');";
                mysqli_query($con,$query2);
                //--------------------------------------------- Set New Record ID ---------------------------------------------
                $query_get2="SELECT max(rid) FROM patient_record";
                $result2=  mysqli_query($con, $query_get2);
                $row2=mysqli_fetch_array($result2);
                if($row2[0]==NULL)
                {
                    $rid='11';
                }
                else
                {
                    $rid=$row2[0]+1;
                }
                //-------------------------------------------------------------------------------------------------------------------
                $chief_problem=$_REQUEST['text_problem'];
                $medical_histo=$_REQUEST['text_history'];
                $present_problem=$_REQUEST['text_present'];
                $symptoms=$_REQUEST['text_symptoms'];
                $treatement=$_REQUEST['text_treatment'];
                //--------------------------------- Uploading An Image ------------------------
                    $uploadimage=$_FILES["myimage"]["name"];
                    $folder="/xampp/htdocs/Medical_Project/";
                    move_uploaded_file($_FILES["myimage"]["tmp_name"], "$folder".$_FILES["myimage"]["name"]);
                //--------------------------------- Uploading An Image End --------------------
                $query3="INSERT INTO patient_record VALUES($pid,$rid,'$chief_problem','$medical_histo','$present_problem','$symptoms','$treatement','$uploadimage');";
                mysqli_query($con,$query3);
                header("location:confirmation_new.php");
            }
        ?>
        <style>
            table
            {
                width:1000px;
                padding:15px;
                border-bottom: 5px solid #d0e9c6;
                border-top: 5px solid #d0e9c6;
            }
            td
            {
                padding:15px;
                width:100px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="container" id="div_body">
                <div class="panel panel-primary" id="div_panel">
                    <div class="panel-heading"><h3>New Patient Entry</h3><b><small>Rajdhani Dental Clinic</small></b>&nbsp;&nbsp;&nbsp;<small><a style="color:white" href="current_admin.php"> Current Admin </a></small></div>
                        <div class="panel-body">     
                            <form method="POST" action="new_entry.php" enctype="multipart/form-data" class="form-group-sm" style="padding: 15">
                                <center>
                                    <table>
                                        <tr>
                                            <td>
                                                <label>Name</label>
                                            </td>
                                            <td>
                                                <input type="text" name="text_name"class="form-control"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Age</label>
                                            </td>
                                            <td>
                                                <select name="drop_age" class="form-control">
                                                <?php 
                                                for($i=0;$i<=100;$i++)
                                                {
                                                   echo"<option>$i</option>";
                                                }
                                                ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Sex</label>
                                            </td>
                                            <td>
                                                <input type="radio" name="sex" value="Male" class="form-inline"/><label>&nbsp;Male&nbsp;</label>
                                                <input type="radio" name="sex" value="Female" class="form-inline"/><label>&nbsp;Female&nbsp;</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Address</label>
                                            </td>
                                            <td>
                                                <input type="text" name="text_address" class="form-control"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Contact Info</label>
                                            </td>
                                            <td>
                                                <input type="text" name="text_contact" class="form-control"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Arrival Date</label>
                                            </td>
                                            <td class="form-inline">
                                                <label>Day : </label>
                                                <select name="arr_day" class="form-control" style="width: 100px;height: 28px">
                                                <?php
                                                    for($i=1;$i<=31;$i++)
                                                    {
                                                        echo"<option>$i</option>";
                                                    }
                                                ?>
                                                </select>
                                                <label>Month : </label>
                                                <select name="arr_month" class="form-control" style="width: 100px;height: 28px">
                                                <?php
                                                    for($i=1;$i<=12;$i++)
                                                    {
                                                        echo"<option>$i</option>";
                                                    }
                                                ?>
                                                </select>
                                                <label>Year : </label>
                                                <select name="arr_year" class="form-control" style="width: 100px;height: 28px">
                                                <?php
                                                    for($i=2000;$i<=2100;$i++)
                                                    {
                                                        echo"<option>$i</option>";
                                                    }
                                                ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Next Appointment</label>
                                            </td>
                                            <td class="form-inline">
                                                <label>Day : </label>
                                                <select name="next_day" class="form-control" style="width: 100px;height: 28px">
                                                <?php
                                                    for($i=1;$i<=31;$i++)
                                                    {
                                                        echo"<option>$i</option>";
                                                    }
                                                ?>
                                                </select>
                                                <label>Month : </label>
                                                <select name="next_month" class="form-control" style="width: 100px;height: 28px">
                                                <?php
                                                    for($i=1;$i<=12;$i++)
                                                    {
                                                        echo"<option>$i</option>";
                                                    }
                                                ?>
                                                </select>
                                                <label>Year : </label>
                                                <select name="next_year" class="form-control" style="width: 100px;height: 28px">
                                                <?php
                                                    for($i=2000;$i<=2100;$i++)
                                                    {
                                                        echo"<option>$i</option>";
                                                    }
                                                ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Present Problem</label>
                                            </td>
                                            <td>
                                                <textarea name="text_problem" class="form-control"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Medical History</label>
                                            </td>
                                            <td>
                                                <textarea name="text_history" class="form-control"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Symptoms</label>
                                            </td>
                                            <td>
                                                <textarea name="text_symptoms" class="form-control"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Diagnosis</label>
                                            </td>
                                            <td>
                                                <textarea name="text_present" class="form-control"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Treatment</label>
                                            </td>
                                            <td>
                                                <textarea name="text_treatment" class="form-control"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Prescription</label>
                                            </td>
                                            <td>
                                                <input type="file" name="myimage" class="form-inline"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="submit" name="Upload" value="Upload" class="form-control btn-success"/>
                                            </td>
                                            <td>
                                                <?php
                                                    echo"<label class='from-control'>Patient ID $pid</label>";
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </body>
</html>