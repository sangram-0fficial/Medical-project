<html>
    <head>
        <title>Get Record Advance</title>
        <link rel="stylesheet" href="Bootstrap/bootstrap.min.css" />
        <title>RDC Appointment</title>
        <link rel="shortcut icon" href="http://matchthemes.com/demohtml/dentalclinic/images/favicon.ico">
        <?php
            session_start();
            $data=$_SESSION['select_id'];
        ?>
        <?php
        error_reporting(0);
            require('Myconnection.php');
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $query_get="SELECT * FROM patient_record";
                $result_get=  mysqli_query($con, $query_get);
                while($row_get=mysqli_fetch_array($result_get))
                {
                        if($_REQUEST[$row_get[1]]!=NULL)
                        {
                            if($_REQUEST[$row_get[1]]=='Delete')
                            {
                                $query_delete="DELETE FROM patient_appointment WHERE aid=$row_get[1]";
                                mysqli_query($con,$query_delete);                                   
                                echo"<script>alert('Deletion Completed !');</script>";                                
                            }
                            else if($_REQUEST[$row_get[1]]=='Update')
                            {
                                    $cproblem=$_REQUEST['txt_cproblem_'.$row_get[1]];
                                    $mhistory=$_REQUEST['txt_mhistory_'.$row_get[1]];
                                    $pproblem=$_REQUEST['txt_pproblem_'.$row_get[1]];
                                    $symptoms=$_REQUEST['txt_symptoms_'.$row_get[1]];
                                    $treatement=$_REQUEST['txt_treatement_'.$row_get[1]];
                                    //--------------------------------- Uploading An Image ------------------------
                                    $uploadimage=$_FILES['file_'.$row_get[1]]["name"];
                                    
                                    $folder="/xampp/htdocs/Medical_Project/";
                                    move_uploaded_file($_FILES['file_'.$row_get[1]]["tmp_name"], "$folder".$_FILES['file_'.$row_get[1]]["name"]);
                                    //--------------------------------- Uploading An Image End --------------------
                                    if($uploadimage=="")
                                    {
                                        $query_update="UPDATE patient_record set chief_problem='$cproblem',medical_history='$mhistory',present_problem='$symptoms',symptoms='$pproblem',treatment='$treatement' WHERE rid=$row_get[1]";                                       
                                    }
                                    else
                                    {
                                        $query_update="UPDATE patient_record set chief_problem='$cproblem',medical_history='$mhistory',present_problem='$symptoms',symptoms='$pproblem',treatment='$treatement',imagename='$uploadimage' WHERE rid=$row_get[1]";
                                    }
                                    mysqli_query($con,$query_update);
                                    echo"<script>alert('Updation Completed !');</script>";                                
                            }
                        }
                }
            }
        ?>
    </head>
    <body style="background-color: white">
        <div class="container" >
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h1>Patient Records&nbsp;&nbsp;<small><a href="get_record.php" style="color:white">Get Records</a></small></h1>
                </div>
                <div class="panel-body" style="box-shadow: 0 15px 15px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <form method="post" action="get_record_advance1.php" enctype="multipart/form-data">
                        <?php
                            require('Myconnection.php');
                            $query="SELECT * FROM patient_master WHERE pid=$data";
                            $result=  mysqli_query($con, $query);
                            $row=  mysqli_fetch_array($result);  
                            echo"<table class='table'>";
                            echo"<tr>";
                            echo"<td><label>ID</label></td>";
                            echo"<td><label>Name</label></td>";
                            echo"<td><label>Age</label></td>";
                            echo"<td><label>Sex</label></td>";
                            echo"<td><label>Address</label></td>";
                            echo"<td><label>Contact</label></td>";
                            echo"</tr>";
                            echo"<tr>";
                            echo"<td>$row[0]</td>";
                            echo"<td>$row[1]</td>";
                            echo"<td>$row[2]</td>";
                            echo"<td>$row[3]</td>";
                            echo"<td>$row[4]</td>";
                            echo"<td>$row[5]</td>";
                            echo"</tr>";
                            echo"</table>";                   
                            $query1="SELECT * FROM patient_appointment WHERE pid=$data";
                            $result1=  mysqli_query($con,$query1);
                            while($row1=  mysqli_fetch_array($result1))
                            {   echo"<h3>Appointement Detail</h3>";
                                echo"<table class='table'>";
                                echo"<tr>";
                                echo"<td><label>Arrival Date</label></td>";
                                echo"<td>$row1[2] / $row1[3] / $row1[4]</td>";
                                echo"</td>";
                                echo"</tr>";
                                echo"<tr>";
                                echo"<td><label>Next Appointment Date</label></td>";
                                echo"<td>$row1[5] / $row1[6] / $row1[7]</td>";
                                echo"</td>";
                                echo"</tr>";
                                echo"</table>";
                                echo"<h3>Report Detail</h3>";
                                $query2="SELECT * FROM patient_record WHERE rid=$row1[1]";
                                $result2= mysqli_query($con,$query2);
                                echo"<table class='table'>";
                                while($row2=  mysqli_fetch_array($result2))
                                {
                                    echo"<tr>";
                                    echo"<td><label>Report No</label></td>";
                                    echo"<td><label>$row2[1]</label></td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                    echo"<td><label>Present Problem</label></td>";
                                    echo"<td><label>Medical History</label></td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                    echo"<td><textarea class='form-control' name='txt_cproblem_$row2[1]'>$row2[2]</textarea>";                           
                                    echo"<td><textarea class='form-control' name='txt_mhistory_$row2[1]'>$row2[3]</textarea>";
                                    echo"</tr>";
                                    echo"<tr>";
                                    echo"<td><label>Symptoms</label></td>";
                                    echo"<td><label>Diagnosis</label></td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                    echo"<td><textarea class='form-control' name='txt_pproblem_$row2[1]'>$row2[5]</textarea>";
                                    echo"<td><textarea class='form-control' name='txt_symptoms_$row2[1]'>$row2[4]</textarea>";
                                    echo"</tr>";
                                    echo"<tr>";
                                    echo"<td><label>Treatement</label></td>";
                                    echo"<td><label>Report</label></td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                    echo"<td><textarea class='form-control' name='txt_treatement_$row2[1]'>$row2[6]</textarea>";
                                    echo"<td>";
                                    echo"<a href='$row2[7]'><img src='$row2[7]' width=200px height=50px/></a>";
                                    echo"<input type='file' name='file_$row2[1]' />";
                                    echo"</td>";
                                    echo"</tr>";
                                    echo"<tr>";
                                    echo"<td>";
                                    echo"<input type='submit' name='$row2[1]' value='Delete' class='form-control btn-danger' id='hello' onclick='return confirm(\"Are you sure ?\");'/>";
                                    echo"</td>";
                                    echo"<td>";
                                    echo"<input type='submit' name='$row2[1]' value='Update' class='form-control btn-success' id='hello' onclick='return confirm(\"Are you sure?\");'/>";
                                    echo"</td>";
                                    echo"</tr>";
                                    echo"</table>";
                                }                           
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>