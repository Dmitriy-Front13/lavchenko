<?php namespace Dmitry\Game\Components;

use Cms\Classes\ComponentBase;
use Dmitry\Game\Models\Game;

class Timer extends ComponentBase
{

    public function componentDetails()
        {
            return [
                'name'        => 'Timer',
                'description' => 'Timer for next game'
            ];
        }
     public function onRun()
    {
        $this->page['lastGame'] = $this->loadLastGame();
    }

    protected function loadLastGame()
    {
        return Game::orderBy('created_at', 'desc')->first();
    }
    
}