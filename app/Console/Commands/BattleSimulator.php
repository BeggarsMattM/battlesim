<?php

namespace Battle\Console\Commands;

use Illuminate\Console\Command;
use Validator;
use Battle\Outputter;
use Battle\Battle;

class BattleSimulator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'battle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Do battle!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->outputter = new Outputter;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name1 = $this->ask('Enter a name for Combatant One');
        $name2 = $this->ask('Enter a name for Combatant Two');

        $combatant1 = $this->randomCombatant($name1);
        $combatant2 = $this->randomCombatant($name2);

        $this->outputter->outputLine('Let battle commence!');

        $battle = new Battle($combatant1, $combatant2, $this->outputter);
        $battle->runSimulation();
    }

    private function validate($name1, $name2)
    {
      $data = compact('name1', 'name2');
      $rules = ['name1' => 'required|max:30', 'name2' => 'required|max:30'];
      $validator = Validator::make($data, $rules);
      if ($validator->fails()) {
        foreach ($validator->messages()->all() as $message) {
          $this->outputter->outputLine($messsage);
        }
        $this->outputter->outputLine("Please try again!");
        exit;
      }
    }

    private function randomCombatant($name)
    {
      $combatantClasses = ['Battle\Brute', 'Battle\Grappler', 'Battle\Swordsman'];
      $randIndex = array_rand($combatantClasses);
      return new $combatantClasses[$randIndex]($name);
    }
}
