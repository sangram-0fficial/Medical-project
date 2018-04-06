<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Bootstrap/bootstrap.min.css" />
        <title>RDC Appointment</title>
        <link rel="shortcut icon" href="http://matchthemes.com/demohtml/dentalclinic/images/favicon.ico">
        <style>
            #record_table tr
            {
                border-top: solid #79a6d2 5px;
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
                <div class="panel-heading"><h3>Today Appointment&nbsp;&nbsp;&nbsp;<small><a href="current_admin.php" style="color:white">Current Admin</a></small></h3></div>
                <div class="panel-body">
                    <?php
                        require('Myconnection.php');
                        session_start();
                        $aid=$_SESSION['admin_id'];
                        $count=0;      
                        $mydate=getdate();
                        $myday=$mydate['mday'];
                        $mymonth=$mydate['mon'];
                        $myyear=$mydate['year'];
                        echo "<h3>Todays Date $myday / $mymonth / $myyear</h3>";
                        $query="SELECT * FROM patient_appointment WHERE next_day=$myday and next_month=$mymonth and next_year=$myyear";
                        $result=mysqli_query($con,$query);
                        while($row=mysqli_fetch_array($result))
                        {
                            $query1="SELECT * FROM patient_master WHERE admin_id=$aid AND pid=$row[0]";
                            $result1=  mysqli_query($con,$query1);
                            while($row1=  mysqli_fetch_array($result1))
                            {
                                echo"<table class='table'>";
                                echo"<tr>";
                                echo"<td><b>$row1[2]</b></td>";
                                echo"<td><b>$row1[3]</b></td>";
                                echo"<td><b>$row1[4]</b></td>";
                                echo"<td><b>$row1[5]</b></td>";
                                echo"<td><b>$row1[6]</b></td>";
                                echo"</tr>";
                                echo"</table>";
                                $count++;
                            }
                        }
                        if($count==0)
                        {
                            echo"<b>No Appointement</b>";
                        }
                        
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>