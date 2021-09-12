<?php
 function connectToSQL(){
     $server_name = "localhost";
     $username = "root";
     $password = "";
     $database_name = "user_manager";
     $conn = mysqli_connect($server_name, $username, $password, $database_name);
     if (!$conn) {
         die("connection Failed:" . mysqli_connect_error());
     }
     return $conn;
 }