<?php
include_once('db.php');
if(isset($_POST['AdUsername'])){
            $user = $_POST['AdUsername'];
            $pswd = $_POST['AdPassword'];
            $con = mysqli_connect("localhost", "root", "", "transient");
            
            $qry = 'SELECT * from admin where admin_username = "'.$user.'" and admin_pswd = "'.$pswd.'" ';
            $result = mysqli_query($con,$qry);
            if($row = mysqli_fetch_array($result)){

            } else {
                header('Location: index.php?Login-Failed');
            }
        }
 if(isset($_POST['UpdateUser'])){
                        $cNo = $_POST['UpdateUser'];
                        $update = $_POST['UserEdit'];
                        if($update == "Delete"){
                          $qry = 'DELETE FROM client where client_id = '.$cNo.' ';
                        
                            mysqli_query($con, $qry);
                            
                            header("Location adminMod.php?$cNo");

                        }
                        
                        if($update == "Active"){
                            $qry = 'UPDATE client SET client_status = "'.$update.'" where client_id = "'.$cNo.'" ';
                            mysqli_query($con, $qry);
                            
                            header("Refresh:0");

                        }
                    }

                    if(isset($_POST['DelAUser'])){
                        $num = $_POST['DelAUser'];
                        
                        $qry = 'DELETE FROM client where client_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                        
                        header("Refresh:0");
                        
                    }

if(isset($_POST['DelAProvider'])){
                        $num = $_POST['DelAProvider'];
                        
                        $qry = 'DELETE FROM provider where prov_id = '.$num.' ';
                        
                        mysqli_query($con, $qry);
                    }

if(isset($_POST['ProvEdit'])){
                        $cNo = $_POST['UpdateProvider'];
                        $update = $_POST['ProvEdit'];
                        if($update == "Delete"){
                          $qry = 'DELETE FROM provider where prov_id = '.$cNo.' ';
                        
                            mysqli_query($con, $qry);

                        }
                        
                        if($update == "Active"){
                            $qry = 'UPDATE provider SET rep_status = "'.$update.'" where prov_id = "'.$cNo.'" ';
                            mysqli_query($con, $qry);

                        }
}

if (isset($_POST['ID'])) {
        $id = $_POST['ID'];
        $status = $_POST['status'];
   
    
    if($status == "Approved"){
        echo $status;
    $con=mysqli_connect("localhost","root","","transient");
    $sql = 'UPDATE units SET post_status="'.$status.'" WHERE trans_id="'.$id.'"';
    if(mysqli_query($con, $sql)){
        header("Location: adminMod.php");
    }    
    }

if($status == "Declined"){
    $con=mysqli_connect("localhost","root","","transient");
    $sql = 'DELETE from units where trans_id="'.$id.'"';
    if(mysqli_query($con, $sql)){
        header("Location: adminMod.php");
    }
}
    
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="./styles/style1.css">
    </head>
    <body>
        <header id="nav-1">
            <span class="title"><a href="adminMod.php">ADMIN</a></span>
        <nav id="nav-2">
            <form action="client.php" id="form1">
                <button id="sub1">MANAGE CLIENT</button>
            </form>
            <form action="provider.php" id="form2">
                <button id="sub2">MANAGE PROVIDERS</button>
            </form>
            <form action="units.php" id="form3">
                <button id="sub3">MANAGE UNITS</button>
            </form>
        </nav>
        </header>

        <div class="dividor"></div>
        <div class="dividor"></div>
        
        <div id="result"></div>

        
        <script type=text/javascript src="jquery-3.3.1.min.js"></script>
        <script type=text/javascript src="my_script.js"></script>
    </body>
</html>