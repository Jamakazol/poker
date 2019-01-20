<?php

class HandScoreTest extends \PHPUnit\Framework\TestCase
{
    public $hand;

    public function testIsFiveOfAKind()
    {
        $result = true;
        $this->hand = new \PokerApp\Hand('as', 'ah', 'ad', 'ac', 'j');

        $this->assertEquals($result, true);
    }
}
?>