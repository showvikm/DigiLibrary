<?php
 $servername = "www.remotemysql.com";
 $username = "7nG1YbRy8s";
 $password = "4EDhlkzSFh";
 
 
 try {
   $ConnectingDB = new PDO("mysql:host=$servername;dbname=7nG1YbRy8s", $username, $password);
   // set the PDO error mode to exception
   $ConnectingDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   //echo "Connected successfully";
 } catch(PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
 }

// EOF
