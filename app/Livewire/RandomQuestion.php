<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class RandomQuestion extends Component
{
    public $question;
    public $showAnswer = false;
    public $started = false;
    public $players = [
        ['name' => 'Pemain 1', 'points' => 0],
        ['name' => 'Pemain 2', 'points' => 0],
        ['name' => 'Pemain 3', 'points' => 0],
        ['name' => 'Pemain 4', 'points' => 0],
    ];

    public function startGame()
    {
        $this->started = true;
        $this->getRandomQuestion();
    }

    public function getRandomQuestion()
    {
        $this->question = Game::inRandomOrder()->first();
        $this->showAnswer = false;
    }

    public function revealAnswer()
    {
        $this->showAnswer = true;
    }

    public function increasePoints($index)
    {
        $this->players[$index]['points'] += 5;
    }

    public function decreasePoints($index)
    {
        if ($this->players[$index]['points'] >= 5) {
            $this->players[$index]['points'] -= 5;
        }
    }

    public function render()
    {
        return view('livewire.random-question');
    }
}
