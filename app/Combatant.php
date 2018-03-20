<?php

namespace Battle;

abstract class Combatant {

  protected $name;
  protected $health;
  protected $strength;
  protected $defense;
  protected $speed;
  protected $luck;

  public function __construct($name) {
    $this->name = $name;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getSpeed()
  {
    return $this->speed;
  }

  public function getDefense()
  {
    return $this->defense;
  }

  public function getLuck()
  {
    return $this->luck;
  }

  public function getHealth()
  {
    return $this->health;
  }

  public function reduceHealthBy($amount)
  {
    $this->health -= $amount;
  }

  private function currentAttackStrength()
  {
    // most combatants' strength is invariant
    return $this->strength;
  }

  public function counterAttacks(Combatant $attacker)
  {
    return "$this->name dodges {$attacker->getName()}'s attack";
  }

  private function determineNextAttacker(Combatant $attacker, Combatant $defender, $dodge = false)
  {
    // most combatants politely take turns
    return [$defender, $attacker, 1, ""];
  }

  public function resolveAttackAgainst(Combatant $defender)
  {
    $output = [];
    $dodge = $defender->getLuck() <= mt_rand(0, 100) / 100;

    if ($dodge) {
      $output[] = $defender->counterAttacks($this);
    }
    else
    {
      $damage = $this->currentAttackStrength() - $defender->getDefense();
      if ($damage > 0)
      {
        $defender->reduceHealthBy($damage);
        $output[] = "$this->name strikes for $damage damage, wham!";
        $output[] = "$defender->name's health is now {$defender->getHealth()}";
      }
      else
      {
        $output[] = "$this->name flails ineffectually at $defender->name";
      }
    }

    if ($defender->getHealth() < 1)
    {
      $output[] = $this->declareAsWinner();
      return [null, null, false, $output];
    }
    else
    {
      list($attacker, $defender, $dodge, $newoutput) = $this->determineNextAttacker($this, $defender, $dodge);
      $output[] = $newoutput;
      return [$attacker, $defender, $dodge, $output];
    }
  }

  private function declareAsWinner()
  {
    return "$this->name ... is the winner!";
  }

}
