<?php

/**@var $pdo \PDO */
require_once "../../database.php";


$id = $_POST['pid'] ??  null;

//If there is no id, then redirect to 
if(!$id){
    header('Location: main.php');
    exit;
}

$statement=$pdo->prepare('Delete FROM products where pid= :id');
$statement->bindValue(':id', $id);
$statement->execute();

// echo '<pre>';
// var_dump($id);
// echo '<pre>';
header('Location:main.php');