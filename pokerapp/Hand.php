<?php

namespace PokerApp;

class Hand extends HandValidator {
    public $cards;

    public function __construct($one, $two, $three, $four, $five)
    {
        $this->card_one = strtolower($one);
        $this->card_two = strtolower($two);
        $this->card_three = strtolower($three);
        $this->card_four = strtolower($four);
        $this->card_five = strtolower($five);

        $this->cards = [
            strtolower($one),
            strtolower($two),
            strtolower($three),
            strtolower($four),
            strtolower($five)
        ];
    }

    public function getErrors()
    {
        $errors = $this->isValidHand($this->cards);
        return $errors;
    }

    public function getScore()
    {
        $score = $this->evaluateScore($this->cards);
        return $score;
    }
}

?>