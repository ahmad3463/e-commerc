
<?php
session_start();
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