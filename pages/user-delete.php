<?php
$id = $_GET['id'];

$q = runQuery("delete from users where id=:id", [':id' => $id]);

if($q) {
    session_unset();
    header('Location: index.php?page=home');
} else {
    echo "Error deleting data";
}