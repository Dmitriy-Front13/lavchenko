<?php namespace Dmitry\Game\Components;

use Cms\Classes\ComponentBase;
use Dmitry\Game\Models\GameNumber;
use Dmitry\Game\Models\Game; // Подключаем модель Game
use RainLab\User\Models\User;

class GameWinner extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Game Winner',
            'description' => 'Finds the winner of the last updated game.'
        ];
    }

    public function onRun()
    {
        // Находим предпоследнее значение game_id, пропуская последнее
        $secondLastGame = GameNumber::orderBy('game_id', 'desc')
            ->skip(1) // Пропускаем последнюю запись, чтобы получить предпоследнюю
            ->first();

        // Проверяем, что запись существует
        if ($secondLastGame) {
            // Получаем запись игры из модели Game для получения даты обновления
            $game = Game::find($secondLastGame->game_id);
            $winGameUpdatedAt = $game ? $game->updated_at : null;

            // Ищем победителя в предпоследней игре
            $lastGameWinner = GameNumber::where('game_id', $secondLastGame->game_id)
                ->where('status', 'win')
                ->first();

            // Передаем данные в шаблон
            $this->page['winner'] = $lastGameWinner ? $lastGameWinner->user : null;
            $this->page['winGameUpdatedAt'] = $winGameUpdatedAt;
        } else {
            // Если нет предпоследней игры, передаем пустые значения
            $this->page['winner'] = null;
            $this->page['winGameUpdatedAt'] = null;
        }
    }
}
