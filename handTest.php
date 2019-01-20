<?php

require "vendor/autoload.php";

use PokerApp\Hand;

$hand = new Hand($_POST['card-one'], $_POST['card-two'], $_POST['card-three'], $_POST['card-four'], $_POST['card-five']);

$errors = $hand->getErrors();

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
    echo 'Hand is valid';
}

?>