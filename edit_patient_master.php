<html>
    <head>
        <link rel="stylesheet" href="Bootstrap/bootstrap.min.css" />
        <title>RDC Edit Patient</title>
        <link rel="shortcut icon" href="http://matchthemes.com/demohtml/dentalclinic/images/favicon.ico">
        <?php
            error_reporting(0);
            session_start();
            $id=$_SESSION['edit_id'];
            $name=$_SESSION['edit_name'];
            $age=$_SESSION['edit_age'];
            $sex=$_SESSION['edit_sex'];
            $address=$_SESSION['edit_address'];
            $contact=$_SESSION['edit_contact'];
            if($_REQUEST['btn_upload']!=NULL)
            {
                require('Myconnection.php');
                $ename=$_REQUEST['txt_name'];
                $eage=$_REQUEST['txt_age'];
                $esex=$_REQUEST['txt_sex'];
                $eaddress=$_REQUEST['txt_address'];
                $econtact=$_REQUEST['txt_contact'];
                $query="UPDATE patient_master SET name='$ename',age='$eage',sex='$esex',address='$eaddress',contact='$econtact' WHERE pid=$id";
                mysqli_query($con, $query);
                header('Location:update_patient_master.php');
            }
        ?>
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
                    <h3>Edit Patient Record <small style="color:white">(<?php echo$name ?>)</small>&nbsp;&nbsp;&nbsp;&nbsp;<small><a href="get_record.php" style="color: white">Get Records</a></small></h3>
                </div>
                <form method="POST" action="edit_patient_master.php">
                    <table class="table" id="record_table">
                        <tr>
                            <td style="width:200px;">
                                &nbsp;&nbsp;<b>Patient ID</b>
                            </td>
                            <td>
                                <?php 
                                    echo"<label>$id</label>";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;&nbsp;<b>Name</b>
                            </td>
                            <td>
                                <input type="text" name="txt_name" value="<?php echo$name ?>" class="form-control"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;&nbsp;<b>Age</b>
                            </td>
                            <td>
                                <input type="text" name="txt_age" value="<?php echo$age ?>" class="form-control"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;&nbsp;<b>Sex</b>
                            </td>
                            <td>
                                <input type="text" name="txt_sex" value="<?php echo$sex ?>" class="form-control"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;&nbsp;<b>Address</b>
                            </td>
                            <td>
                                <input type="text" name="txt_address" value="<?php echo$address ?>" class="form-control"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;&nbsp;<b>Contact</b>
                            </td>
                            <td>
                                <input type="text" name="txt_contact" value="<?php echo$contact ?>" class="form-control"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="btn_upload" value="Save" class="form-control btn-success"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>     
    </body>
</html>