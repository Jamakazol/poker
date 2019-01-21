<?php

class HandScoreTest extends \PHPUnit\Framework\TestCase
{
    public function testIsFiveOfAKind()
    {
        $cards = new \PokerApp\Hand('as', 'ah', 'ad', 'ac', 'j');

        if (($cards->joker() == true) && (count($cards->handInfo['values'])) == 1) {
            $result = true;
        } else {
            $result = false;
        }
        $this->assertEquals($result, true);
        
        $cards = new \PokerApp\Hand('as', 'ah', 'ad', 'ac', 'ks');
        
        if (($cards->joker() == true) && (count($cards->handInfo['values'])) == 1) {
            $result = true;
        } else {
            $result = false;
        }
        $this->assertEquals($result, false);
    }
    
    public function testIsStraightFlush()
    {
        $cards = new \PokerApp\Hand('as', 'ks', 'qs', 'js', '10s');
        
        if ($cards->isFlush() && $cards->isStraight()) {
            $result = true;
        } else {
            $result = false;
        }
        $this->assertEquals($result, true);

        $cards = new \PokerApp\Hand('as', '10s', 'j', 'qs', '9s');

        if ($cards->isFlush() && $cards->isStraight()) {
            $result = true;
        } else {
            $result = false;
        }
        $this->assertEquals($result, false);
    }

    // public function testIsFourOfAKind()
    // {
    //     $handInfo = $this->handInfo;
    //     $three = false;
    //     $four = false;
    //     foreach ($handInfo['values'] as $card => $count) {
    //         if ($count == 3) {
    //             $three = true;
    //         }
    //         if ($count == 4) {
    //             $four = true;
    //         }
    //     }
    //     if ($this->joker() == true) {
    //         if ($three == true) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         if ($four == true) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     }
    // }

    // public function testIsFullHouse()
    // {
    //     $handInfo = $this->handInfo;
    //     $pairs = $this->countPairs();

    //     if ($this->joker() == true) {
    //         if ($pairs == 2) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         if (($pairs == 1) && (count($handInfo['values']) == 2)) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     }
    // }

    // public function testIsFlush()
    // {
    //     $handInfo = $this->handInfo;
    //     if (count($handInfo['suits']) == 1) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function testIsStraight()
    // {
    //     $hand = $this->hand;
    //     $joker = false;
    //     $handInfo = $this->handInfo;
    //     $ace = 1;

    //     if (array_key_exists(12, $handInfo['values']) || array_key_exists(13, $handInfo['values'])) {
    //         $ace = 14;
    //     }
        
    //     if ($this->joker() == true) {
    //         sort($hand);
    //         array_pop($hand);
    //         $joker = true;
    //     }

    //     $lastCard = end($hand);
    //     $firstCard = $hand[0];

    //     $index = 0;
    //     foreach ($hand as $card) {
    //         $numberValue = (int)substr($card, 0, -1);
    //         if ($numberValue === 1 && $ace == 14) {
    //             $hand[$index] = $ace;
    //         } else {
    //             $hand[$index] = (int)substr($card, 0, -1);
    //         }
    //         $index++;
    //     }

    //     sort($hand);

    //     $straight = true;

    //     for ($x = 0; $x < count($hand) - 1; $x++) {
    //         $card = $hand[$x];
    //         $nextCard = $hand[$x + 1];
    //         if ($card + 1 != $nextCard) {
    //             if ($joker == true) {
    //                 if ($card + 2 != $nextCard) {
    //                     $straight = false;
    //                 }
    //             } else {
    //                 $straight = false;
    //             }
    //         }
    //     }

    //     return $straight;
    // }

    // public function testIsThreeOfAKind()
    // {
    //     $handInfo = $this->handInfo;
    //     $pairs = $this->countPairs();

    //     if ($this->joker() == true) {
    //         if ($pairs == 1) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         if (($pairs == 0) && (count($handInfo['values']) == 3)) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     }
    // }

    // public function testIsTwoPair()
    // {
    //     $handInfo = $this->handInfo;
    //     $pairs = $this->countPairs();

    //     if ($this->joker() == true) {
    //         if ($pairs == 1) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         if ($pairs == 2) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     }
    // }

    // public function testIsOnePair()
    // {
    //     $pairs = $this->countPairs();
    //     $handInfo = $this->handInfo;

    //     if ($this->joker() == true) {
    //         if (count($handInfo['values']) == 4) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         if (($pairs == 1) && (count($handInfo['values']) == 4)) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    // }
      
}
?>