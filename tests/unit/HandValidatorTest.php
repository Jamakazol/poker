<?php

class HandValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testCheckCardsUnique()
    {
        $result;
        $hand = new \PokerApp\Hand('as', 'qh', '4d', 'kh', 'kh');
        if (array_unique($hand->cards) !== $hand->cards) {
            $result = false;
        } else {
            $result = true;
        }

        $this->assertEquals($result, false);

        $hand = new \PokerApp\Hand('as', 'qh', '4d', 'kh', 'qd');
        if (array_unique($hand->cards) !== $hand->cards) {
            $result = false;
        } else {
            $result = true;
        }

        $this->assertEquals($result, true);
    }
    
    public function testCheckCardsExist()
    {
        $cardsValid = true;
        $hand = new \PokerApp\Hand('as', 'qh', '4d', 'kh', 'j');
        foreach ($hand->cards as $card) {
            if (preg_match('/^(((([2-9]|10)|(j|q|k|a))(s|c|h|d))|j)$/i', $card) != true) {
                $cardsValid = false;
            }
        }
        
        $this->assertEquals($cardsValid, true);

        $cardsValid = true;
        $hand = new \PokerApp\Hand('as', 'qh', '4d', 'kh', 'at');
        foreach ($hand->cards as $card) {
            if (preg_match('/^(((([2-9]|10)|(j|q|k|a))(s|c|h|d))|j)$/i', $card) != true) {
                $cardsValid = false;
            }
        }
        
        $this->assertEquals($cardsValid, false);
    }
}

?>