<?php

//define the constants
 define("SERVERNAME","localhost");
 define("USERNAME","root");
 define("PASSWORD","");
 define("DBNAME","contactform");

//create a connection to the database
 $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DBNAME);

if(!$conn)
    die("Connection failed ".mysqli_connect_error());
else
     echo "Connected Successfully<br>";

?>