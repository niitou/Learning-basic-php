<?php
    
    $new_user = $_POST['username']."|".$_POST['name']."|".$_POST['password']."\n";
    $namafile = "db.txt";
    //write new user data to db
    $myfile = fopen($namafile, "a") or die("Error Occured");
    fwrite($myfile, $new_user);
    echo("<script>window.location.href=('login.php')</script>");
    fclose($myfile);

?>