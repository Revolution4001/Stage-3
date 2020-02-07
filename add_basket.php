<?php

require_once('session.php');

$id = isset($_GET['id']) ? intval($_GET['id']) :0;

// some easy debugging
echo $id.'<br/><br/>';

if ($id >0)
{

    $sth = $pdo->prepare('SELECT * FROM `games` WHERE id=:id');
    $sth->bindParam(':id',$id);
    $sth->execute();

    // Download one record
    $result = $sth->fetch();

    // Intersting question ? You need to use $sth = $pdo->prepare(sql question) twice or only one time
    $sth = $pdo->prepare('INSERT INTO `basket`(`name`,`producer`,`publisher`,`type`,`platform`,`price`,`age_requirements`,`digital`)
                          VALUES (:name,:producer,:publisher,:type,:platform,:price,:age_requirements,:digital)');

    $sth->bindParam(':name',$result['name'],PDO::PARAM_STR);
    $sth->bindParam(':producer',$result['producer'], PDO::PARAM_STR);
    $sth->bindParam(':publisher',$result['publisher'], PDO::PARAM_STR);
    $sth->bindParam(':type',$result['type'], PDO::PARAM_STR);
    $sth->bindParam(':platform',$result['platform'], PDO::PARAM_STR);
    $sth->bindParam(':price',$result['price'], PDO::PARAM_STR);
    $sth->bindParam(':age_requirements', $result['age_requirements'], PDO::PARAM_STR);
    $sth->bindParam(':digital',$result['digital'], PDO::PARAM_STR);
    $sth->execute();
    header('Location: basket.php');
}
// if id in GET is empty go back to index.php
else
{

    header('Location: index.php');
}