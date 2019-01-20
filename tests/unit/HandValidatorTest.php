<?php

class HandValidatorTest extends \PHPUnit\Framework\TestCase
{
    public $hand;

    public function testCheckCardsUnique()
    {
        $result;
        $this->hand = new \PokerApp\Hand('as', 'qh', '4d', 'kh', 'kh');
        if (array_unique($this->hand->cards) !== $this->hand->cards) {
            $result = false;
        } else {
            $result = true;
        }

        $this->assertEquals($result, false);

        $this->hand = new \PokerApp\Hand('as', 'qh', '4d', 'kh', 'qd');
        if (array_unique($this->hand->cards) !== $this->hand->cards) {
            $result = false;
        } else {
            $result = true;
        }

        $this->assertEquals($result, true);
    }
    
    public function testCheckIsFiveCards()
    {
        $result;
        $this->hand = new \PokerApp\Hand('as', 'qh', '4d', 'kh', 'kh');
        if ((count($this->hand->cards) !== 5) || in_array('', $this->hand->cards)) {
            $result = false;
        } else {
            $result = true;
        }

        $this->assertEquals($result, true);
        
        $this->hand = new \PokerApp\Hand('as', 'qh', '4d', 'kh', '');
        if ((count($this->hand->cards) !== 5) || in_array('', $this->hand->cards)) {
            $result = false;
        } else {
            $result = true;
        }

        $this->assertEquals($result, false);
    }
    
    public function testCheckCardsExist()
    {
        $cardsValid = true;
        $this->hand = new \PokerApp\Hand('as', 'qh', '4d', 'kh', 'j');
        foreach ($this->hand->cards as $card) {
            if (preg_match('/^(((([2-9]|10)|(j|q|k|a))(s|c|h|d))|j)$/i', $card) != true) {
                $cardsValid = false;
            }
        }
        
        $this->assertEquals($cardsValid, true);

        $cardsValid = true;
        $this->hand = new \PokerApp\Hand('as', 'qh', '4d', 'kh', 'at');
        foreach ($this->hand->cards as $card) {
            if (preg_match('/^(((([2-9]|10)|(j|q|k|a))(s|c|h|d))|j)$/i', $card) != true) {
                $cardsValid = false;
            }
        }
        
        $this->assertEquals($cardsValid, false);
    }
}

?>