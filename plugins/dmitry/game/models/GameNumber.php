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
    public $timestamps = false;

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'dmitry_game_number';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];
    
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
