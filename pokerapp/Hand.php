<?php

namespace PokerApp;

class Hand extends HandValidator {
    // Array of raw cards.
    public $cards;
    // Array of cards after face cards have been set to number values, ie q->12, k->13. 
    public $hand;
    // Array of hand info, contains the totals of different types of cards and the totals of different suits
    public $handInfo;

    public function __construct($one, $two, $three, $four, $five)
    {
        $this->cards = [
            strtolower($one),
            strtolower($two),
            strtolower($three),
            strtolower($four),
            strtolower($five)
        ];

        $this->hand = $this->setNumbersAndJokers();
        $this->handInfo = $this->setHandInfo();
    }

    public function getErrors()
    {
        $errors = $this->isValidHand($this->cards);
        return $errors;
    }

    public function getScore()
    {
        $score = $this->evaluateScore($this->hand, $this->handInfo);
        return $score;
    }

    /**
     * Sets face cards (a,j,q,k) to number values (1,11,12,13) and puts joker on end of hand array if one exists.
     * 
     * @param array $hand
     * @return array $hand
     */
    public function setNumbersAndJokers()
    {
        $hand = $this->cards;
        $index = 0;
        $joker = false;
        foreach ($hand as $card) {
            if ($card == 'j') {
                $joker = true;
                unset($hand[$index]);
            } else {
                switch ($card[0]) {
                    case 'j':
                        $hand[$index] = '11' . substr($card, -1);
                        break;
                    case 'q':
                        $hand[$index] = '12' . substr($card, -1);
                        break;
                    case 'k':
                        $hand[$index] = '13' . substr($card, -1);
                        break;
                    case 'a':
                        $hand[$index] = '1' . substr($card, -1);
                        break;
                    default:
                        break;
                }
            }
            $index++;
        }

        if ($joker == true) {
            array_push($hand, 'j');
        }

        return $hand;
    }

    /**
     * Sets handInfo array values
     * 
     * @param array $hand
     * @return void
     */
    public function setHandInfo()
    {
        $handInfo = [
            'values' => [],
            'suits' => []
        ];

        foreach ($this->hand as $card) {
            if ($card != 'j') {

                $cardValue = substr($card, 0, -1);
                $suit = substr($card, -1);

                if (array_key_exists($cardValue, $handInfo['values'])) {
                    $handInfo['values'][$cardValue] = $handInfo['values'][$cardValue] + 1;
                } else {
                    $handInfo['values'][$cardValue] = 1;
                }

                if (array_key_exists($suit, $handInfo['suits'])) {
                    $handInfo['suits'][$suit] = $handInfo['suits'][$suit] + 1;
                } else {
                    $handInfo['suits'][$suit] = 1;
                }
            }
        }

        return $handInfo;
    }
}

?>