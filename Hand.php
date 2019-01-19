<?php

require('HandValidator.php');

class Hand extends HandValidator {
    public $cards;
    public $card_one;
    public $card_two;
    public $card_three;
    public $card_four;
    public $card_five;

    public function __construct($one, $two, $three, $four, $five)
    {
        $this->card_one = strtolower($one);
        $this->card_two = strtolower($two);
        $this->card_three = strtolower($three);
        $this->card_four = strtolower($four);
        $this->card_five = strtolower($five);

        $this->cards = [
            $this->card_one,
            $this->card_two,
            $this->card_three,
            $this->card_four,
            $this->card_five
        ];
    }

    public function getErrors()
    {
        $errors = $this->isValidHand($this->cards);
        return $errors;
    }
}

?>