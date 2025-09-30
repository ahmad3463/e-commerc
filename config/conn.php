
<?php
session_start();
    // $severname = "sql113.infinityfree.com";
    // $dbname = "if0_39983528_skyway";
    // $username = "if0_39983528";
    // $password = "QpNGy0Fmt6L4";


    // try {
    //     $conn = new PDO("mysql:host=$severname;dbname=$dbname" , $username , $password);
    //     $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    //     // echo "connect";
    // } catch (PDOException $e) {
    //     echo "Error: ". $e->getMessage();
    // }


    $severname = "localhost";
    $dbname = "skyway";
    $username = "root";
    $password = "";


    try {
        $conn = new PDO("mysql:host=$severname;dbname=$dbname" , $username , $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        // echo "connect";
    } catch (PDOException $e) {
        echo "Error: ". $e->getMessage();
    }
?>