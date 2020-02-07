<?php

require_once('session.php');




// Adding new game
if (isset($_POST['name'])&&isset($_POST['producer'])) // Dodaje kolejne warunki z AND
{

    $POST_id = isset($_POST['id']) ? intval($_POST['id']) :0;

    if ($POST_id>0)
    {
        $sth = $pdo->prepare('UPDATE `games` SET `name`=:name,`producer`=:producer,`publisher`=:publisher,`type`=:type,`platform`=:platform,`price`=:price,`age_requirements`=:age_requirements,`digital`=:digital WHERE :id = id');
        $sth->bindParam(':id',$_POST['id']);
    }
    else
    {
        $sth = $pdo->prepare('INSERT INTO `games`(`name`, `producer`, `publisher`, `type`, `platform`, `price`, `age_requirements`, `digital`)
               VALUES (:name,:producer,:publisher,:type,:platform,:price,:age_requirements,:digital)');

    }

    // POST some Debugging
    echo '<pre>';
    print_r($_POST);

    $sth->bindParam(':name',$_POST['name']);
    $sth->bindParam(':producer',$_POST['producer']);
    $sth->bindParam(':publisher',$_POST['publisher']);
    $sth->bindParam(':type', $_POST['type']);
    $sth->bindParam(':platform', $_POST['platform']);
    $sth->bindParam(':price', $_POST['price']);
    $sth->bindParam(':age_requirements', $_POST['age_requirements']);
    $sth->bindParam(':digital', $_POST['digital']);
    $sth->execute();


    header('Location: index.php');
}
//Editing the exist game

$GET_id = isset($_GET['id']) ? intval($_GET['id']) :0;



if ($GET_id >0)
{

    $sth = $pdo->prepare('SELECT * FROM `games` WHERE id = :id');
    $sth->bindParam(':id',$GET_id);
    $sth->execute();

    // Add this record do variable result
    $result = $sth->fetch();
    //print_r($result);


}


?>

<a href="index.php">Back to index.php</a><br/><br/>
<form action="add.php" method="post">

<?php
    if ($GET_id>0)
    {
        echo '<input type="hidden" name="id" value="'.$GET_id.'">';
    }


?>
    Name:               <input type="text" name="name" <?php if(isset($result['name'])) {echo 'value="'.$result['name'].'"';}  ?> /><br/><br/>
    Producer:           <input type="text" name="producer" <?php if(isset($result['producer'])) {echo 'value="'.$result['producer'].'"';}  ?> /><br/><br/>
    Publisher:          <input type="text" name="publisher" <?php if(isset($result['publisher'])) {echo 'value="'.$result['publisher'].'"';}  ?> /><br/><br/>
    Type:               <input type="text" name="type"<?php if(isset($result['type'])) {echo 'value="'.$result['type'].'"';}  ?> /><br/><br/>
    Platform:           <input list="platforms"  name="platform" <?php if(isset($result['platform'])) {echo 'value="'.$result['platform'].'"';}  ?>  />
                        <datalist id="platforms">
                            <option value="PC">
                            <option value="PS4">
                            <option value="PS3">
                            <option value="Xbox180">
                            <option value="Xbox360">
                            <option value="Xbox One">
                        </datalist><br/><br/>
    Price:              <input type="number" name="price" placeholder="87,99" step="0.01" <?php if(isset($result['price'])) {echo 'value="'.$result['price'].'"';}  ?>  /><br/><br/>
    Age Requirements:   <input list="age_req" name="age_requirements" <?php if(isset($result['age_requirements'])) {echo 'value="'.$result['age_requirements'].'"';}  ?> />
                        <datalist id="age_req">
                            <option value="3+">
                            <option value="6+">
                            <option value="10+">
                            <option value="13+">
                            <option value="17+">
                            <option value="18+">
                        </datalist><br/><br/>
    Digital:            <select name="digital" >
                            <option value="1" <?php if(isset($result['digital']) && $result['digital'] == 1) { echo 'selected';} ?> >YES</option>
                            <option value="0" <?php if(isset($result['digital']) && $result['digital'] == 0) { echo  'selected';} ?> >NO</option>
                        </select><br/><br/>
    <input type="submit" value="Add game"/>

</form>
