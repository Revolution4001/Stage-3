<?php


require_once('session.php');


    if (isset($_POST['login'])&&isset($_POST['pass']))
    {

        $POST_id = isset($_POST['id']) ? intval($_POST['id']) :0;


        if ($POST_id >0)
        {
            $sth = $pdo->prepare('UPDATE `users` SET `login` = :login,`pass`=:pass WHERE `id`=:id');
            $sth->bindParam(':id', $_POST['id']);
        }
        else
        {
            $sth = $pdo->prepare('INSERT INTO `users`(`login`, `pass`) VALUES (:login,:pass)');
        }


        $sth->bindParam(':login',$_POST['login'],PDO::PARAM_STR);
        $sth->bindParam(':pass', md5($_POST['pass']),PDO::PARAM_STR);
        $sth->execute();

        header('Location: del_user.php');
    }

// Editing the Existing user

$GET_id = isset($_GET['id']) ? intval($_GET['id']) :0;

if ($GET_id >0)
{
    $sth = $pdo->prepare('SELECT * FROM `users` WHERE id=:id');
    $sth->bindParam(':id',$GET_id);
    $sth->execute();


    // add record

    $result = $sth->fetch(); // one record
    //print_r($result);
}


?>

<a href="index.php">Back to index.php</a><br/><br/>

<form action="add_user.php" method="post">
    ADD NEW USER: <br/><br/>

    <?php

        if ($GET_id>0)
        {
            echo '<input type="hidden" name="id" value="'.$GET_id.'"/>';;
        }

    ?>

    LOGIN:  <input type="text" name="login" <?php if(isset($result['login'])) { echo 'value="'.$result['login'].'"'; }  ?> ><br/><br/>
    PASS:   <input <?php $visible = isset($result['pass']) ? 'type=text' : 'type=password'; echo $visible;  ?> name="pass" <?php if(isset($result['pass'])) { echo 'value="'.$result['pass'].'"'; } ?>><br/><br/>
    <input type="submit" value="Add User">

</form>
