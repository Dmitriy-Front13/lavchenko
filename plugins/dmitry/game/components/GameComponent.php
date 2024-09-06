<?php namespace Dmitry\Game\Components;

use Cms\Classes\ComponentBase;
use Dmitry\Game\Models\Game;
use Dmitry\Game\Models\GameNumber;
use Auth;
use Mail;

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
    $user = Auth::getUser();
    $game = Game::where('is_active', true)->first();

    if (!$game) {
        // Если нет активной игры, получаем последнюю завершенную игру
        $game = Game::where('is_active', false)->orderBy('updated_at', 'desc')->first();
        $this->page['game'] = $game;
        $this->page['isGameOver'] = true;
    } else {
        $this->page['game'] = $game;
        $this->page['isGameOver'] = false;
    }

    if ($game) {
        // Получаем секретное число из текущей игры
        $secretNumber = $game->secret_number;

        // Общее количество клеток
        $totalCells = $game->total_cells;
        // Общее количество открытых клеток
        $cellsCount = GameNumber::where('game_id', $game->id)->count();
        // Номера выбранных клеток
        $numbers = GameNumber::where('game_id', $game->id)->get()->pluck('number')->toArray();
        // Количество попыток пользователя
        $userAttempts = 0;
        $correctAttempt = null;

        // Проверка, авторизован ли пользователь
        if ($user) {
            // Количество попыток пользователя
            $userAttempts = GameNumber::where('game_id', $game->id)
                ->where('user_id', $user->id)
                ->count();
            // Проверка успешных попыток
            $correctAttempt = GameNumber::where('game_id', $game->id)
                ->where('user_id', $user->id)
                ->where('number', $secretNumber)
                ->first();
        }

        // Создание клеток
        $cells = [];
        for ($i = 1; $i <= $totalCells; $i++) {
            $cells[] = [
                'number' => $i,
                'isChosen' => in_array($i, $numbers),
                'isWinner' => !$game->is_active && $i == $secretNumber,
            ];
        }

        // Логгирование для отладки
        \Log::info('Correct attempt: ' . ($correctAttempt ? $correctAttempt->number : 'null'));
        \Log::info('User attempts: ' . $userAttempts);

        // Передача данных в шаблон
        $this->page['cells'] = $cells;
        $this->page['totalCells'] = $totalCells;
        $this->page['cellsCount'] = $cellsCount;
        $this->page['userAttempts'] = $userAttempts;
        $this->page['correctAttempt'] = $correctAttempt ? $correctAttempt->number : null;
        $this->page['gameIsActive'] = $game->is_active;
    } else {
        $this->page['cells'] = [];
        $this->page['totalCells'] = 0;
        $this->page['cellsCount'] = 0;
        $this->page['userAttempts'] = 0;
        $this->page['correctAttempt'] = null;
        $this->page['gameIsActive'] = false;
    }
}
    
public function onCheckNumber()
{
    $user = Auth::getUser();
    if (!$user || !$user->is_activated) {
        return ['error' => 'Unauthorized'];
    }

    $number = post('number');
    $gameId = post('game_id');
    $game = Game::find($gameId);

    if ($game && $game->is_active) {
        $attempts = GameNumber::where('game_id', $gameId)
            ->where('user_id', $user->id)
            ->count();

        if ($attempts >= 3) {
            return ['error' => 'You have reached the maximum number of attempts'];
        }

        // Создаем запись независимо от правильности числа
         $gameNumber = GameNumber::create([
            'number' => $number,
            'game_id' => $game->id,
            'user_id' => $user->id
        ]);

        if ($number == $game->secret_number) {
            $game->is_active = false;
            $game->save();
            
            $gameNumber->status = 'win';
            $gameNumber->save();
            
            $cash = $game->cash;
            
            $data = [
                'user' => $user, // Передаем объект пользователя
                'game' => $game
            ];
            
            Mail::send('winner-user', $data, function($message) use ($user) {
                $message->to($user->email, $user->name);
            });
            $adminData = [
                'user' => $user, // Данные пользователя
                'game' => $game,
                'cash' => $cash // Значение cash из компонента GameInfo
            ];

            Mail::send('winner-admin', $adminData, function($message) {
                $message->to('sanyamak95@gmail.com', 'Administrator'); 
            });

            return [
                'result' => 'success',
                'attempts' => $attempts + 1,
                'cellsCount' => GameNumber::where('game_id', $gameId)->count(),
            ];
        } else {
            if ($attempts + 1 >= 3) {
                // Устанавливаем статус проигравшего
                $gameNumber->status = 'lose';
                $gameNumber->save();
            }
            return ['result' => 'failure', 'attempts' => $attempts + 1, 'cellsCount' => GameNumber::where('game_id', $gameId)->count()];
        }
    }

    return ['result' => 'error'];
}
}