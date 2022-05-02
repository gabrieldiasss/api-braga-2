<?php

$host = "dbapi.cms4oaksztvp.us-east-1.rds.amazonaws.com";
$user = "admin";
$pass = "braga1001";
$dbname = "dbprodutos";

$conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
