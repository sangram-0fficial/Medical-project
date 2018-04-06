<html>
    <head>
        <title>Administrator Dashboard</title>
        <link rel="stylesheet" href="Bootstrap/bootstrap.min.css" />
        <title>RDC Edit Patient</title>
        <link rel="shortcut icon" href="http://matchthemes.com/demohtml/dentalclinic/images/favicon.ico">
        <?php
            error_reporting(0);
            require('Myconnection.php');
            session_start();
            //----------------------------------- Get Current Admin Data -----------------------------------               
            $aid=$_SESSION['admin_id'];
            $query="SELECT * FROM new_admin WHERE aid=$aid";
            $result=mysqli_query($con,$query);
            $row=mysqli_fetch_array($result);  
        ?>
        <style>
            #div_body
            {
                margin-top: 20px;
                box-shadow: 10px 10px 10px;
                padding-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container" id="div_body">
            <div class="panel panel-primary" id="div_panel">
                <div class="panel-heading"><b><h2>Welcome Doctor&nbsp;&nbsp;&nbsp;<small style="color:white"><?php echo$row[1] ?></small></h2><small><a href="Dental_Home_Page.php" style="color:white">Rajdhani Dental Clinic</a></small></b></div>
                <table>
                    <td>
                <div style="width:400px">
                    <div class="panel-body">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3>Contents</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-divider">
                                    <li><a href="get_record.php">Get Patient</a></li>
                                    <li><a href="new_entry.php">Add New Patient</a></li>
                                    <li><a href="today_appointment.php">Today's Appointments</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                    </td>
                    <td style="width:800px;">
                <div>
                    <div class="panel-body">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3>Doctor Information</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-stacked">
                                    <li><b>Name     :</b>&nbsp;&nbsp;Dr <?php echo$row[1]  ?></li>
                                    <li><b>Contact     :</b>&nbsp;&nbsp;<?php echo$row[2]  ?></li>
                                    <li><b>Email       :</b>&nbsp;&nbsp;<?php echo$row[3]  ?></li>
                                    <li><b>Discription :</b>&nbsp;&nbsp;<?php echo$row[4]  ?></li>
                                    <li><b>Password    :</b>&nbsp;&nbsp;<?php echo$row[5]  ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                    </td>
                </table>
            </div>
        </div>
    </body>
</html>