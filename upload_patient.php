<html>
    <head>
        <title>RDC Upload Patient Record</title>
        <link rel="shortcut icon" href="http://matchthemes.com/demohtml/dentalclinic/images/favicon.ico">
        <?php
            error_reporting(0);
            session_start();
            $id=$_SESSION['upload_id'];
            $name=$_SESSION['upload_name'];
            require('Myconnection.php');
            ///------------------------------------ Upload ----------------------------------------
            if($_REQUEST['btn_submit']!=NULL)
            {
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
                $cur_day=$_REQUEST['drop_day'];
                $cur_month=$_REQUEST['drop_month'];
                $cur_year=$_REQUEST['drop_year'];
                $next_day=$_REQUEST['drop_nday'];
                $next_month=$_REQUEST['drop_nmonth'];
                $next_year=$_REQUEST['drop_nyear'];
                $query2="INSERT INTO patient_appointment VALUES($id,$aid,'$cur_day','$cur_month','$cur_year','$next_day','$next_month','$next_year');";
                mysqli_query($con,$query2);
                //--------------------------------------------- Set New Record ID ---------------------------------------------
                $query_get2="SELECT max(rid) FROM patient_record";
                $result2=  mysqli_query($con, $query_get2);
                $row2=mysqli_fetch_array($result2);
                //--------------------------------------------------
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
                $chief_problem=$_REQUEST['txt_cproblem'];
                $medical_histo=$_REQUEST['txt_mhistory'];
                $present_problem=$_REQUEST['txt_pproblem'];
                $symptoms=$_REQUEST['txt_symptoms'];
                $treatement=$_REQUEST['txt_treatment'];
                //--------------------------------- Uploading An Image ------------------------
                    $uploadimage=$_FILES["up_image"]["name"];
                    $folder="/xampp/htdocs/Medical_Project/";
                    move_uploaded_file($_FILES["up_image"]["tmp_name"], "$folder".$_FILES["up_image"]["name"]);
                //--------------------------------- Uploading An Image End --------------------
                $query3="INSERT INTO patient_record VALUES($id,$rid,'$chief_problem','$medical_histo','$present_problem','$symptoms','$treatement','$uploadimage');";
                mysqli_query($con,$query3);
                header("Location:upload_patient.php");
            }
        ?>
        <title>Upload Record</title>
        <link rel="stylesheet" href="Bootstrap/bootstrap.min.css" />
        <style>
            #record_table tr
            {
                border-top: solid white 3px;
            }
            #div_main
            {
                box-shadow: 5px 5px 10px #79a6d2;
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
                <div class="panel-heading">
                    <h2>Upload Record&nbsp;<small style="color:white">(<?php echo$name ?>)</small>&nbsp;&nbsp;&nbsp;<small><a href="get_record.php" style="color:white">Get Record</a></small></h2>
                </div>
                <form method="POST" action="upload_patient.php" enctype="multipart/form-data">
                    <table class="table" id="record_table">
                        <tr>
                            <td><b>&nbsp;&nbsp;&nbsp;Arrival</b></td>
                            <td class="form-inline"> 
                                <select name="drop_day" class="form-control">
                                    <?php
                                        for($i=1;$i<=31;$i++)
                                        {
                                            echo"<option>$i</option>";
                                        }
                                    ?>
                                </select>
                                <select name="drop_month" class="form-control">
                                    <?php
                                        for($i=1;$i<=12;$i++)
                                        {
                                            echo"<option>$i</option>";
                                        }
                                    ?>
                                </select>
                                <select name="drop_year" class="form-control">
                                    <?php
                                        for($i=2000;$i<=2050;$i++)
                                        {
                                            echo"<option>$i</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>&nbsp;&nbsp;&nbsp;Next Appointment<b></td>
                            <td class="form-inline">
                                <select name="drop_nday" class="form-control">
                                    <?php
                                        for($i=1;$i<=31;$i++)
                                        {
                                            echo"<option>$i</option>";
                                        }
                                    ?>
                                </select>
                                <select name="drop_nmonth" class="form-control">
                                    <?php
                                        for($i=1;$i<=12;$i++)
                                        {
                                            echo"<option>$i</option>";
                                        }
                                    ?>
                                </select>
                                <select name="drop_nyear" class="form-control">
                                    <?php
                                        for($i=2000;$i<=2050;$i++)
                                        {
                                            echo"<option>$i</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>&nbsp;&nbsp;&nbsp;Present Problem</b>
                            </td>
                            <td>
                                <textarea name='txt_cproblem' class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>&nbsp;&nbsp;&nbsp;Medical History</b>
                            </td>
                            <td>
                                <textarea name='txt_mhistory' class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>&nbsp;&nbsp;&nbsp;Symptoms</b>
                            </td>
                            <td>
                                <textarea name='txt_symptoms' class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>&nbsp;&nbsp;&nbsp;Diagnosis</b>
                            </td>
                            <td>
                                <textarea name='txt_pproblem' class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>&nbsp;&nbsp;&nbsp;Treatment</b>
                            </td>
                            <td>
                                <textarea name="txt_treatment" class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>&nbsp;&nbsp;&nbsp;Image</b>
                            </td>
                            <td>
                                <input type="file" name="up_image"/>
                            </td>
                        </tr>
                        <tr>
                            <td  colspan="2">
                                <input type="submit" name="btn_submit" value="Upload" class="form-control btn-success"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>