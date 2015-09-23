<?php

    $dname = $_POST['dname'];
    $dtel = $_POST['dtel'];
    $did = $_POST['did'];
    $dgroup = $_POST['dgroup'];
    $dadd = $_POST['dadd'];
    $score = $_POST['score'];
    $con = @mysql_connect("localhost","root","wiki");
    if (!$con){
	  die('Could not connect: ' . mysql_error());
	}
    mysql_select_db("jx09com",$con);
    $date = date('Ymd his');
    $insertSql = "INSERT INTO dform (dname,dtel,did,dgroup,dadd,score,date) values ('".$dname."','".$dtel."','".$did."','".$dgroup."','".$dadd."','".$score."','".$date."')";
    mysql_query($insertSql);
    mysql_close();
    echo json_encode(1);
?>