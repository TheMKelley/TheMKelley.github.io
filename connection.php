<?php
    define("USER", "root");
    define("PASSWORD", "");
    define("HOST", "localhost");
    define("DATABASE", "userdata");
    
    try{
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch(PDOException $e) {
        exit("ERROR: ".$e->getMessage());
    }
?>
