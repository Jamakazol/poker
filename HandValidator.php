<?php

require('HandScore.php');

class HandValidator extends HandScore
{
    /**
     * Returns an array of errors which is empty if none are found
     * 
     * @param array $hand
     * @return array
     */
    public function isValidHand($hand)
    {
        $errors = [];

        if ($this->checkCardsUnique($hand) == false) {
            array_push($errors, 'missing or duplicate cards');
        }

        if ($this->checkIsFiveCards($hand) == false) {
            array_push($errors, 'hand must contain exactly 5 cards');
        }
        
        if ($this->checkCardsExist($hand) == false) {
            array_push($errors, "invalid card in hand");
        }
        
        return $errors;
    }

    /**
     * Checks for duplicate cards in hand
     * @return bool
     */
    private function checkCardsUnique($hand)
    {
        if (array_unique($hand) !== $hand) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Checks that hand contains exactly 5 cards
     * @return bool
     */
    private function checkIsFiveCards($hand)
    {
        if ((count($hand) !== 5) || in_array('', $hand)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Checks that all cards in hand exist
     * @return bool
     */
    private function checkCardsExist($hand)
    {
        $cardsValid = true;
        foreach ($hand as $card) {
            if (preg_match('/^(((([2-9]|10)|(j|q|k|a))(s|c|h|d))|j)$/i', $card) != true) {
                $cardsValid = false;
            }

            return $cardsValid;
        }
    }
}

?>