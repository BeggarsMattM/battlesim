<?php

namespace Battle;

class Battle {

  private $combatant1;
  private $combatant2;
  private $rounds;
  private $outputter;

  public function __construct($combatant1, $combatant2, Outputter $outputter)
  {
    $this->combatant1 = $combatant1;
    $this->combatant2 = $combatant2;
    $this->attacks = 0;
    $this->battleLength = 60; // 60 attacks = 30 rounds
    $this->outputter = $outputter;
  }

  public function runSimulation()
  {
    $attacker = $this->findFirstAttacker();
    $defender = $attacker == $this->combatant1 ? $this->combatant2 : $this->combatant1;

    $this->outputter->outputLine("{$attacker->getName()} is attacking first and has {$attacker->getHealth()} health");
    $this->outputter->outputLine("Defender {$defender->getName()} has {$defender->getHealth()} health");

    while ($defender && $this->attacks < $this->battleLength) {
      list($attacker, $defender, $attacksIncrement, $outputArray) = $attacker->resolveAttackAgainst($defender);
      $this->outputter->outputLines($outputArray);
      $this->attacks += $attacksIncrement;
    }
    // the battle is over
    if (! $defender) {
      // someone has been defeated, we are done
      return "defeat";
    }
    // else
    $this->declareADraw();
    return "draw";
  }

  private function findFirstAttacker()
  {
    $c1speed = $this->combatant1->getSpeed();
    $c2speed = $this->combatant2->getSpeed();
    if ($c1speed > $c2speed) {
      return $this->combatant1;
    }
    else if ($c2speed > $c1speed)
    {
      return $this->combatant2;
    }

    $c1defense = $this->combatant1->getDefense();
    $c2defense = $this->combatant2->getDefense();
    if ($c1defense < $c2defense) {
      return $this->combatant1;
    }
    else if ($c2defense < $c1defense) {
      return $this->combatant2;
    }

    // toss a coin
    return mt_rand(0, 1) ? $this->combatant1 : $this->combatant2;

  }

  private function declareADraw()
  {
    $this->outputter->outputLine("After a hard fought battle ... it's a draw!");
  }

}
