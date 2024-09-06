<?php namespace Dmitry\Game\Models;

use Model;
use RainLab\User\Models\User;

/**
 * Model
 */
class GameNumber extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var bool timestamps are disabled.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'dmitry_game_number';
    
    public $fillable = ['number', 'game_id', 'user_id', 'status'];

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];
    
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
    
    public $belongsTo = [
    'user' => User::class
];

}
