<?php

namespace PokerApp;

class HandScore
{
    public $handInfo;
    public $hand;

    /**
     * Returns the score of the hand
     * 
     * @param array $hand
     * @return array
     */
    public function evaluateScore($hand, $handInfo)
    {
        $this->hand = $hand;
        $this->handInfo = $handInfo;

        if ($this->isFiveOfAKind()) {
            return '5 of a kind';
        } elseif ($this->isStraightFlush()) {
            return 'Straight flush';
        } elseif ($this->isFourOfAKind()) {
            return '4 of a kind';
        } elseif ($this->isFullHouse()) {
            return 'Full house';
        } elseif ($this->isFlush()) {
            return 'Flush';
        } elseif ($this->isStraight()) {
            return 'Straight';
        } elseif ($this->isThreeOfAKind()) {
            return '3 of a kind';
        } elseif ($this->isTwoPair()) {
            return '2 pair';
        } elseif ($this->isOnePair()) {
            return '1 pair';
        } else {
            return 'High card';
        }
    }
    
    /**
     * Determines whether a hand is 5 of a kind, only possible if there is a joker in the hand.
     * 
     * @return bool
     */
    public function isFiveOfAKind()
    {
        if (($this->joker() == true) && (count($this->handInfo['values'])) == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determines whether a hand is a straight flush
     * 
     * @return bool
     */
    public function isStraightFlush()
    {
        if ($this->isFlush() && $this->isStraight()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determines whether a hand is 4 of a kind
     * 
     * @return bool
     */
    public function isFourOfAKind()
    {
        $handInfo = $this->handInfo;
        $three = false;
        $four = false;
        foreach ($handInfo['values'] as $card => $count) {
            if ($count == 3) {
                $three = true;
            }
            if ($count == 4) {
                $four = true;
            }
        }
        if ($this->joker() == true) {
            if ($three == true) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($four == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Determines whether a hand is a full house
     * 
     * @return bool
     */
    public function isFullHouse()
    {
        $handInfo = $this->handInfo;
        $pairs = $this->countPairs();

        if ($this->joker() == true) {
            if ($pairs == 2) {
                return true;
            } else {
                return false;
            }
        } else {
            if (($pairs == 1) && (count($handInfo['values']) == 2)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Determines whether a hand is a flush
     * 
     * @return bool
     */
    public function isFlush()
    {
        $handInfo = $this->handInfo;
        if (count($handInfo['suits']) == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determines whether a hand is a straight
     * 
     * @return bool
     */
    public function isStraight()
    {
        $hand = $this->hand;
        $joker = false;
        $handInfo = $this->handInfo;
        $ace = 1;

        if (array_key_exists(12, $handInfo['values']) || array_key_exists(13, $handInfo['values'])) {
            $ace = 14;
        }

        if ($this->joker() == true) {
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

        $straight = true;

        $oneFarCardAllowed = true;
        for ($x = 0; $x < count($hand) - 1; $x++) {
            $card = $hand[$x];
            $nextCard = $hand[$x + 1];
            if ($card + 1 != $nextCard) {
                if ($oneFarCardAllowed == true) {
                    if ($joker == true) {
                        if ($card + 2 == $nextCard) {
                            $oneFarCardAllowed = false;
                        } else {
                            $straight = false;
                        }
                    } else {
                        $straight = false;
                    }
                } else {
                    $straight = false;
                }
            }
        }

        return $straight;
    }

    /**
     * Determines whether hand is 3 of a kind
     * 
     * @return bool
     */
    public function isThreeOfAKind()
    {
        $handInfo = $this->handInfo;
        $pairs = $this->countPairs();

        if ($this->joker() == true) {
            if ($pairs == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            if (($pairs == 0) && (count($handInfo['values']) == 3)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Determines whether hand is 2 pair
     * 
     * @return bool
     */
    public function isTwoPair()
    {
        $handInfo = $this->handInfo;
        $pairs = $this->countPairs();

        if ($this->joker() == true) {
            if ($pairs == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($pairs == 2) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Determines whether hand is a one pair
     * 
     * @return bool
     */
    public function isOnePair()
    {
        $pairs = $this->countPairs();
        $handInfo = $this->handInfo;

        if ($this->joker() == true) {
            if (count($handInfo['values']) == 4) {
                return true;
            } else {
                return false;
            }
        } else {
            if (($pairs == 1) && (count($handInfo['values']) == 4)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Utility function that counts the number of pairs in a hand
     * 
     * @return bool
     */
    public function countPairs()
    {
        $handInfo = $this->handInfo;

        $pairs = 0;
        foreach ($handInfo['values'] as $card => $count) {
            if ($count == 2) {
                $pairs++;
            }
        }

        return $pairs;
    }

    /**
     * Utility function that checks for joker
     * 
     * @return bool
     */
    public function joker()
    {
        if (in_array('j', $this->hand)) {
            return true;
        } else {
            return false;
        }
    }
}

?>