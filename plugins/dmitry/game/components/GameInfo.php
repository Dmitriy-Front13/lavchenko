<?php namespace Dmitry\Game\Components;

use Cms\Classes\ComponentBase;
use Dmitry\Game\Models\Game;

class GameInfo extends ComponentBase
{

    public function componentDetails()
        {
            return [
                'name'        => 'Game Info',
                'description' => 'Cash and icon'
            ];
        }


public function onRun()
    {
       
        $record = Game::where('is_active', true)->first();

// Если нет активной игры, получаем последнюю завершенную игру
if (!$record) {
    $record = Game::where('is_active', false)
    ->orderBy('id', 'desc')
    ->skip(1)
    ->first();
}

// Проверяем, что запись существует перед доступом к её свойствам
if ($record) {
    $this->page['cash'] = $record->cash;
    $this->page['icon'] = $record->icon;
}
    }
    
}