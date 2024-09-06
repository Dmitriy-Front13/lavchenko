<?php namespace Dmitry\Game\Components;

use Cms\Classes\ComponentBase;
use Dmitry\Game\Models\GameNumber;
use Dmitry\Game\Models\Game;
use Auth;

class GameStats extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Game Stats',
            'description' => 'Отображает количество игр пользователя, а также количество побед и поражений.'
        ];
    }

    public function onRun()
    {
        $user = Auth::getUser();

        if ($user) {
            // Подсчитываем общее количество игр пользователя
            $totalGames = GameNumber::where('user_id', $user->id)
                ->distinct('game_id')
                ->count('game_id');

            // Подсчитываем количество побед пользователя
            $wonGames = GameNumber::where('user_id', $user->id)
                ->where('status', 'win')
                ->count();

            // Подсчитываем количество поражений пользователя
            $lostGames = GameNumber::where('user_id', $user->id)
                ->where('status', 'lose')
                ->count();
                
           $lastGameId = GameNumber::where('user_id', $user->id)
    ->orderBy('game_id', 'desc')
    ->value('game_id'); // Получаем только значение поля 'game_id'

if ($lastGameId) {
    // Получаем все номера клеток, выбранных в последней игре по ID игры
    $selectedNumbers = GameNumber::where('user_id', $user->id)
        ->where('game_id', $lastGameId)
        ->pluck('number')
        ->toArray();

    // Ищем запись со статусом 'win' или 'lose' и получаем номер и дату
    $gameStatusRecord = GameNumber::where('user_id', $user->id)
        ->where('game_id', $lastGameId)
        ->whereIn('status', ['win', 'lose']) // Проверяем наличие статусов 'win' или 'lose'
        ->first(); // Получаем первую подходящую запись

    // Проверяем, что запись существует и получаем необходимые данные
    $winningNumber = $gameStatusRecord ? $gameStatusRecord->number : null;
    $isWin = $gameStatusRecord && $gameStatusRecord->status === 'win';
    $gameUpdatedAt = $gameStatusRecord ? $gameStatusRecord->created_at : null; // Получаем дату создания записи

    // Передаем данные в шаблон
    $this->page['selectedNumbers'] = $selectedNumbers;
    $this->page['isWin'] = $isWin;
    $this->page['winningNumber'] = $winningNumber;
    $this->page['gameUpdatedAt'] = $gameUpdatedAt;
} else {
   
    $this->page['selectedNumbers'] = [];
    $this->page['isWin'] = false;
    $this->page['winningNumber'] = null;
    $this->page['gameUpdatedAt'] = null;
}

            // Передаем данные в шаблон
            $this->page['totalGames'] = $totalGames;
            $this->page['wonGames'] = $wonGames;
            $this->page['lostGames'] = $lostGames;
        } else {
            // Если пользователь не авторизован, устанавливаем значения в 0
            $this->page['totalGames'] = 0;
            $this->page['wonGames'] = 0;
            $this->page['lostGames'] = 0;
        }
    }
}
