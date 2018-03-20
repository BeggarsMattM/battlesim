<?php

namespace Battle;

class Brute extends Combatant {

  public function __construct($name) {

    parent::__construct($name);

    $this->health = rand(90, 100);
    $this->strength = rand(65, 75);
    $this->defense = rand(40, 50);
    $this->speed = rand(40, 65);
    $this->luck = mt_rand(30, 35) / 100;
  }

  private function determineNextAttacker($attacker, $defender, $dodge)
  {
    if ($dodge) {
      // No stunning blow if the defender dodged
      return [$defender, $attacker, 1, ""];
    }
    // 2% chance of attacking again straightaway
    // if the opponent is stunned, their next attack is skipped - we get a little closer to a draw
    return rand(1, 100) <= 2 ? [$attacker, $defender, 2, "Brute $this->name stuns their opponent, blam!"] : [$defender, $attacker, 1, ""];
  }

}
