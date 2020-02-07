<?php


require_once('base.php');


session_start();

    if (isset($_POST['login']))
    {
        $login = $_POST['login'];
        $pass = md5($_POST['pass']);

        $sth = $pdo->prepare('SELECT * FROM users WHERE login = :login AND pass = :pass');
        $sth->bindParam(':login',$login,PDO::PARAM_STR);
        $sth->bindParam(':pass',$pass,PDO::PARAM_STR);
        $sth->execute();

        $result = $sth->fetch();

        //print_r($result);
        //phpinfo();

        // The firt access-list it's like not very efficent but at least it works
        if ($result && $result['login']=='root' && isset($result['id'])) // That not very effective way but maybe I improve that later
        {
            $_SESSION['logged'] = true;
            $_SESSION['admin'] = true;
            header('Location: index.php');
        }
        else  if ($result && isset($result['id']))
        {
            $_SESSION['logged'] = true;
            $_SESSION['client'] = true;

            header('Location: index.php');
       }




    }

    if (!isset($_SESSION['logged']) || $_SESSION['logged']==false)
    {


?>


        <form action="session.php" method="post">
            LOGIN: <input type="text" name="login"><br/><br/>
            PASSWORD: <input type="password" name="pass"><br/><br/>
            <input type="submit" value="Log in">


        </form>

<?php

        die;
    }
?>