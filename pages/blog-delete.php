<?php
$blog_id =$_GET['id'];
print($blog_id);

if($q = runQuery("delete from blogs where id=:id", [':id' => $blog_id])){
    $q->execute();
}

if($q) {
    header('Location: index.php?page=home');
} else {
    echo "Error deleting data";
}