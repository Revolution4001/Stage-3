<?php

require_once('session.php');




$table = $pdo->query('SELECT * FROM `basket`');

echo '<h1>YOUR BASKET</h1>';

echo '<table border="1">';

echo '<tr>';

    echo '<th>Name</th>';
    echo '<th>Producer</th>';
    echo '<th>Publisher</th>';
    echo '<th>Type</th>';
    echo '<th>Platform</th>';
    echo '<th>Price</th>';
    echo '<th>Age_Requirements</th>';
    echo '<th>Digital</th>';
    echo '<th>Options</th>';

echo '</tr>';

foreach ($table->fetchAll() as $key => $value)
{
    echo '<tr>';

        echo '<td>'.$value['name'].'</td>';
        // Dokoñcz dodawanieFGFG

    echo '</tr>';
}






