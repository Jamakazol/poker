
<?php

require "vendor/autoload.php";

use PokerApp\Hand;

if (trim($_POST['card-one']) == '' || 
    trim($_POST['card-two']) == '' ||
    trim($_POST['card-three']) == '' ||
    trim($_POST['card-four']) == '' ||
    trim($_POST['card-five']) == '') 
{
    echo 'Please fill all the boxes';
    die;
}

$cards = new Hand($_POST['card-one'], $_POST['card-two'], $_POST['card-three'], $_POST['card-four'], $_POST['card-five']);

$errors = $cards->getErrors();

if (count($errors) > 0) {
    $count = 0;
    foreach ($errors as $error) {
        if ($count == 0) {
            echo $error;
        } else {
            echo ', ' . $error;
        }
        $count++;
    };
} else {
    $score = $cards->evaluateScore($cards->hand, $cards->handInfo);
    echo 'Score:' . $score;
}

?>