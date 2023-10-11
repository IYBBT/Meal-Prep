
<?php

$server = "cray.cs.gettysburg.edu";
$dbase  = "f23_grotka01";
$user   = "grotka01";
$pass   = "grotka01";

try {
    $db = new PDO("mysql:host=$server;dbname=$dbase", $user, $pass);
    // print "<H1>Successfully connected to the database.</H1>\n";
} catch (PDOException $e) {
    die("Error connecting to database " . $e->getMessage());
}

?>
