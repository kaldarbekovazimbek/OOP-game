<?php

class Game
{
    protected Player $player1;
    protected Player $player2;
    private int $flips = 0;

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function flip(): int
    {
        return rand(0, 1);
    }

    public function start()
    {


        echo <<<EOT
        
        Chance of winning {$this->player1->name}: {$this->player1->odds($this->player2)}
        Chance of winning {$this->player2->name}: {$this->player2->odds($this->player1)}

        EOT;

        return $this->play();
    }

    public function play()
    {
        while (true) {

            if ($this->flip() == 1) {
                $this->player1->point($this->player2);
            } else {
                $this->player2->point($this->player1);
            }

            if ($this->player1->bankrupt() or $this->player2->bankrupt()) {
                return $this->end();
            }
            $this->flips++;
        }
    }

    public function winner(): string
    {
        if ($this->player1->bank() > $this->player2->bank()) {
            return $this->player2->name;
        } else {
            return $this->player1->name;
        }
    }

    public function end(): void
    {
        echo <<<EOT
        
        Game over!
        
        {$this->player1->name}: {$this->player1->coins}
        {$this->player2->name}: {$this->player2->coins}
        
        Winner: {$this->winner()}
        
        Total flips: {$this->flips}
        
        
        EOT;

    }
}
