<?php
//default
define("HOST", "localhost"); // host localhost or 127.0.0.1 by default
define("USER", "root"); // user mysql
define("PASSWORD", ""); // password mysql
define("DB", "chat"); // name database

$link = mysqli_connect(HOST, USER, PASSWORD, DB);
mysqli_set_charset($link, "utf8");
if (!$link) {
    echo "Error! Unable to connect to MySQL ";
    echo "Error code" . mysqli_connect_errno();
    echo "Error text" . mysqli_connect_error();
    exit;
}
echo "MySQL connection established! <br>";
echo "Server information " . mysqli_get_host_info($link) . "<br>";
