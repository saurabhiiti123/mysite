<?php
$servername="localhost";
$username="root";
$password="";

$conn= new mysqli($servername,$username,$password);
$sql="create database db;";


if($conn->connect_error){
    die("Connection failed:".$conn->connect_error);
}
if($conn->query($sql))
{
    echo "Database created";
}
$database="db";
echo "Connected Successfully";
$sql="create table db.XYZ(A int,B int);";
    if($conn->query($sql)){
        echo "Table created.";
    }
else {echo "Table not created".$conn->error;}
?>