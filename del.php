<?php


require_once('session.php');

$id = isset($_GET['id']) ? intval($_GET['id']) :0;

 if ($id >0)
 {
     $sth = $pdo->prepare('DELETE FROM `games` WHERE id = :id');
     $sth->bindParam(':id',$id);
     $sth->execute();
     header('Location: index.php');
 }
 else
 {
     header('Location: session.php');
 }