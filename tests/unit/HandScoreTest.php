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

    public function testIsFourOfAKind()
    {
        $cards = new \PokerApp\Hand('as', 'ks', 'qs', 'js', '10s');

        $three = false;
        $four = false;
        foreach ($cards->handInfo['values'] as $card => $count) {
            if ($count == 3) {
                $three = true;
            }
            if ($count == 4) {
                $four = true;
            }
        }
        if ($cards->joker() == true) {
            if ($three == true) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            if ($four == true) {
                $result = true;
            } else {
                $result = false;
            }
        }

        $this->assertEquals($result, false);

        $cards = new \PokerApp\Hand('as', 'ac', 'ad', 'ah', '10s');

        $three = false;
        $four = false;
        foreach ($cards->handInfo['values'] as $card => $count) {
            if ($count == 3) {
                $three = true;
            }
            if ($count == 4) {
                $four = true;
            }
        }
        if ($cards->joker() == true) {
            if ($three == true) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            if ($four == true) {
                $result = true;
            } else {
                $result = false;
            }
        }

        $this->assertEquals($result, true);
    }

    public function testIsFullHouse()
    {
        $cards = new \PokerApp\Hand('as', 'ac', 'ad', '10h', '10s');
        $pairs = $cards->countPairs();

        if ($cards->joker() == true) {
            if ($pairs == 2) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            if (($pairs == 1) && (count($cards->handInfo['values']) == 2)) {
                $result = true;
            } else {
                $result = false;
            }
        }

        $this->assertEquals($result, true);

        $cards = new \PokerApp\Hand('as', '9c', 'ad', 'ah', '10s');
        $pairs = $cards->countPairs();

        if ($cards->joker() == true) {
            if ($pairs == 2) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            if (($pairs == 1) && (count($cards->handInfo['values']) == 2)) {
                $result = true;
            } else {
                $result = false;
            }
        }

        $this->assertEquals($result, false);
    }

    public function testIsFlush()
    {
        $cards = new \PokerApp\Hand('as', '9s', 'ks', 'ad', '10s');

        if (count($cards->handInfo['suits']) == 1) {
            $result = true;
        } else {
            $result = false;
        }

        $this->assertEquals($result, false);

        $cards = new \PokerApp\Hand('as', '9s', 'as', 'qs', '10s');

        if (count($cards->handInfo['suits']) == 1) {
            $result = true;
        } else {
            $result = false;
        }

        $this->assertEquals($result, true);
    }

    public function testIsStraight()
    {
        // False test case
        $cards = new \PokerApp\Hand('as', '9s', 'ks', 'ad', '10s');

        $hand = $cards->hand;
        $joker = false;
        $handInfo = $cards->handInfo;
        $ace = 1;

        if (array_key_exists(12, $handInfo['values']) || array_key_exists(13, $handInfo['values'])) {
            $ace = 14;
        }
        
        if ($cards->joker() == true) {
            sort($hand);
            array_pop($hand);
            $joker = true;
        }

        $lastCard = end($hand);
        $firstCard = $hand[0];

        $index = 0;
        foreach ($hand as $card) {
            $numberValue = (int)substr($card, 0, -1);
            if ($numberValue === 1 && $ace == 14) {
                $hand[$index] = $ace;
            } else {
                $hand[$index] = (int)substr($card, 0, -1);
            }
            $index++;
        }

        sort($hand);

        $result = true;

        for ($x = 0; $x < count($hand) - 1; $x++) {
            $card = $hand[$x];
            $nextCard = $hand[$x + 1];
            if ($card + 1 != $nextCard) {
                if ($joker == true) {
                    if ($card + 2 != $nextCard) {
                        $result = false;
                    }
                } else {
                    $result = false;
                }
            }
        }

        $this->assertEquals($result, false);

        // True test case
        $cards = new \PokerApp\Hand('as', '10c', 'kh', 'qs', 'jd');

        $hand = $cards->hand;
        $joker = false;
        $handInfo = $cards->handInfo;
        $ace = 1;

        if (array_key_exists(12, $handInfo['values']) || array_key_exists(13, $handInfo['values'])) {
            $ace = 14;
        }
        
        if ($cards->joker() == true) {
            sort($hand);
            array_pop($hand);
            $joker = true;
        }

        $lastCard = end($hand);
        $firstCard = $hand[0];

        $index = 0;
        foreach ($hand as $card) {
            $numberValue = (int)substr($card, 0, -1);
            if ($numberValue === 1 && $ace == 14) {
                $hand[$index] = $ace;
            } else {
                $hand[$index] = (int)substr($card, 0, -1);
            }
            $index++;
        }

        sort($hand);

        $result = true;

        for ($x = 0; $x < count($hand) - 1; $x++) {
            $card = $hand[$x];
            $nextCard = $hand[$x + 1];
            if ($card + 1 != $nextCard) {
                if ($joker == true) {
                    if ($card + 2 != $nextCard) {
                        $result = false;
                    }
                } else {
                    $result = false;
                }
            }
        }

        $this->assertEquals($result, true);
    }

    public function testIsThreeOfAKind()
    {
        $cards = new \PokerApp\Hand('as', 'ad', 'ac', 'qs', 'jd');

        $handInfo = $cards->handInfo;
        $pairs = $cards->countPairs();

        if ($cards->joker() == true) {
            if ($pairs == 1) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            if (($pairs == 0) && (count($handInfo['values']) == 3)) {
                $result = true;
            } else {
                $result = false;
            }
        }

        $this->assertEquals($result, true);

        $cards = new \PokerApp\Hand('as', 'ad', 'qc', 'qs', 'jd');

        $handInfo = $cards->handInfo;
        $pairs = $cards->countPairs();

        if ($cards->joker() == true) {
            if ($pairs == 1) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            if (($pairs == 0) && (count($handInfo['values']) == 3)) {
                $result = true;
            } else {
                $result = false;
            }
        }

        $this->assertEquals($result, false);
    }

    public function testIsTwoPair()
    {
        $cards = new \PokerApp\Hand('as', 'ad', 'kc', 'ks', 'jd');

        $pairs = $cards->countPairs();

        if ($cards->joker() == true) {
            if ($pairs == 1) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            if ($pairs == 2) {
                $result = true;
            } else {
                $result = false;
            }
        }

        $this->assertEquals($result, true);

        $cards = new \PokerApp\Hand('as', 'ad', 'ac', 'qs', 'jd');

        $pairs = $cards->countPairs();

        if ($cards->joker() == true) {
            if ($pairs == 1) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            if ($pairs == 2) {
                $result = true;
            } else {
                $result = false;
            }
        }

        $this->assertEquals($result, false);
    }

    public function testIsOnePair()
    {
        $cards = new \PokerApp\Hand('as', 'ad', 'ac', 'qs', 'jd');

        $pairs = $cards->countPairs();
        $handInfo = $cards->handInfo;
        
        if ($cards->joker() == true) {
            if (count($handInfo['values']) == 4) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            if (($pairs == 1) && (count($handInfo['values']) == 4)) {
                $result = true;
            } else {
                $result = false;
            }
        }

        $this->assertEquals($result, false);

        $cards = new \PokerApp\Hand('as', 'ad', 'jh', 'qs', '4d');

        $pairs = $cards->countPairs();
        $handInfo = $cards->handInfo;
        
        if ($cards->joker() == true) {
            if (count($handInfo['values']) == 4) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            if (($pairs == 1) && (count($handInfo['values']) == 4)) {
                $result = true;
            } else {
                $result = false;
            }
        }

        $this->assertEquals($result, true);
    }
}
?>