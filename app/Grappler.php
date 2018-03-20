<?php

namespace Battle;

class Grappler extends Combatant {

  public function __construct($name) {

    parent::__construct($name);

    $this->health = rand(60, 100);
    $this->strength = rand(75, 80);
    $this->defense = rand(35, 40);
    $this->speed = rand(60, 80);
    $this->luck = mt_rand(30, 40) / 100;
    $this->counterAttackDamage = 10;
  }

  public function counterAttacks(Combatant $attacker)
  {
    $attacker->reduceHealthBy($this->counterAttackDamage);
    return
      "$attacker->name misses!\n" .
      "Grappler $this->name counterattacks, pow!\n" .
      "$attacker->name's health is now {$attacker->getHealth()}";
  }

}
