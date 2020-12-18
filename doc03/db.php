<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

$host = "localhost";
$username = "root";
$passwd = "admin1234";
$dbname = "test_db";
$db = new mysqli($host, $username, $passwd, $dbname);
$db->set_charset("utf-8");

function mq($sql) {
    global $db;
    return $db->query($sql);
}