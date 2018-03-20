<?php

namespace Battle;

class Swordsman extends Combatant {

  public function __construct($name) {

    parent::__construct($name);

    $this->health = rand(40, 60);
    $this->strength = rand(60, 70);
    $this->defense = rand(20, 30);
    $this->speed = rand(90, 100);
    $this->luck = mt_rand(30, 50) / 100;
  }

  private function currentAttackStrength()
  {
    return rand(1, 100) <= 5 ? $this->strength * 2 : $this->strength;
  }

}
