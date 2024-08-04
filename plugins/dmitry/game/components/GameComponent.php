<?php namespace Dmitry\Game\Components;

use Cms\Classes\ComponentBase;
use Dmitry\Game\Models\Game;
use Dmitry\Game\Models\GameNumber;
use Auth;

class GameComponent extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Game Component',
            'description' => 'Displays the game for authenticated and verified users.'
        ];
    }

    public function onRun()
    {
        $game = Game::where('is_active', true)->first();
        $this->page['game'] = $game;

        // Создание клеток
        if ($game) {
            $totalCells = $game->total_cells;
            $numbers = GameNumber::where('game_id', $game->id)->get()->pluck('number')->toArray();

            $cells = [];
            for ($i = 1; $i <= $totalCells; $i++) {
                $cells[] = [
                    'number' => $i,
                    'isChosen' => in_array($i, $numbers),
                ];
            }

            $this->page['cells'] = $cells;
        } else {
            $this->page['cells'] = [];
        }
    }
    
    public function onSaveNumber()
    {
        $user = Auth::getUser();
        if (!$user || !$user->is_activated) {
            return ['error' => 'Unauthorized'];
        }

        $number = post('number');
        GameNumber::create([
            'number' => $number,
            'game_id' => post('game_id'),
            'user_id' => $user->id
        ]);

        return ['success' => true];
    }
    
    public function onCheckNumber()
{
     \Log::info('onCheckNumber called');
    $user = Auth::getUser();
    if (!$user || !$user->is_activated) {
        return ['error' => 'Unauthorized'];
    }

    $number = post('number');
    $gameId = post('game_id');
    $game = Game::find($gameId);

    if ($game && $game->is_active) {
        if ($number == $game->secret_number) {
            return ['result' => 'success'];
        } else {
            // Сохранение выбранного числа
            GameNumber::create([
                'number' => $number,
                'game_id' => $game->id,
                'user_id' => $user->id
            ]);
            return ['result' => 'failure'];
        }
    }

    return ['result' => 'error'];
}
}