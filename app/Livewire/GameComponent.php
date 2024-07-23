<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class GameComponent extends Component
{

    public array $questions;
    public int $currentQuestionIndex = 0;

    pub
    public function mount(array $questions)
    {
        $this->questions = $questions;
    }

    public function selectAnswer($index): void
    {
        if ($index = $this->questions[$this->currentQuestionIndex]['correct_answer']) {
            $this->isCorrect = true;
        }
    }

    public function nextQuestion(): void
    {
        $this->currentQuestionIndex++;
        $this->selectedAnswer = null;
        $this->isCorrect = null;
    }

    /**
     * @return Factory|View|Application
     */
    public function render()
    {
        return view('livewire.game-component', [
            'currentQuestion' => $this->questions[$this->currentQuestionIndex]
        ]);
    }
}
