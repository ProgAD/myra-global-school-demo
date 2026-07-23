<?php

$db_host = "mysql.gb.stackcp.com";
$db_port = 44814; // See note below
$db_name = "myramgt-39392ffe";
$db_user = "myramgt-39392ffe";
$db_pass = "KGAI!8Q--D.a";


date_default_timezone_set('Asia/Kolkata');

$conn = new mysqli(
    $db_host,
    $db_user,
    $db_pass,
    $db_name,
    $db_port
);

// Check Connection
if ($conn->connect_error) {
    die("❌ Connection Failed: " . $conn->connect_error);
}


$conn->set_charset("utf8mb4");


$conn->query("SET time_zone = '+05:30'");

// NOTE: connection is intentionally left open so files that
// `require` this config can run queries. Do not close it here.
