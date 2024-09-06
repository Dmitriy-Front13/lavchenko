<?php namespace Dmitry\Game\Models;

use Model;

/**
 * Model
 */
class Game extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'dmitry_game_';
    
    
    public $attachOne = [
        'icon' => \System\Models\File::class
        ];

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];
    
     public function numbers()
    {
        return $this->hasMany(GameNumber::class);
    }

}
