<?php

namespace Battle;

use Battle\OutputInterface;

class Outputter implements OutputInterface
{
    public function outputLine($line)
    {
      if (strlen($line) > 0)
      {
        echo "$line\n";
      }
    }

    public function outputLines($lines)
    {
      foreach ($lines as $line)
      {
          $this->outputLine($line);
      }
    }
}
