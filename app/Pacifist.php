<?php

namespace Battle;

class Pacifist extends Combatant {

  public function __construct($name) {

    parent::__construct($name);

    $this->health = rand(40, 60);
    $this->strength = 0;
    $this->defense = rand(20, 30);
    $this->speed = rand(90, 100);
    $this->luck = mt_rand(30, 50) / 100;
  }

}
