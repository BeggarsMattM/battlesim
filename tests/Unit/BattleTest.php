<?php

namespace Tests\Unit;

use Tests\TestCase;
use Battle\Pacifist;
use Battle\Battle;
use Battle\QuietOutputter;

class BattleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testADrawIsPossible()
    {
        $pacifist1 = new Pacifist("Gandhi");
        $pacifist2 = new Pacifist("Corbyn");
        $outputter = new QuietOutputter;

        $battle = new Battle($pacifist1, $pacifist2, $outputter);

        $this->assertEquals("draw", $battle->runSimulation());
    }
}
