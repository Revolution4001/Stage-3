<?php
/**
 * Created by PhpStorm.
 * User: Revolution
 * Date: 2018-06-23
 * Time: 19:49
 */

    session_start();
    session_unset();
    header('location: index.php');