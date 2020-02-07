<?php

require_once('session.php');

$id = isset($_GET['id']) ? intval($_GET['id']) :0;

    if ($id>0)
    {
        $sth = $pdo->prepare('DELETE FROM `users` WHERE id = :id');
        $sth->bindParam(':id',$id);
        $sth->execute();

    }


        $table = $pdo->query('SELECT * FROM users');

        echo '<table border=1>';

        echo '<tr>';
            echo '<th>USER NAME</th>';
            echo '<th>USER PASSWORD</th>';
            echo '<th>OPTIONS</th>';
        echo '</tr>';


        foreach ($table->fetchAll() as $key => $value)
        {
            echo '<tr>';
            echo '<td>'.$value['login'].'</td>';
            echo '<td>'.$value['pass'].'</td>';
            echo '<td><a href="del_user.php?id='.$value['id'].'">DELETE</a> | <a href="add_user.php?id='.$value['id'].'">EDIT</a></td>';
            echo '</tr>';
        }

    echo '<a href="index.php">BACK TO INDEX</a>';
?>
