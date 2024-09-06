<?php namespace Dmitry\AdsBanner\Models;

use Model;

/**
 * Model
 */
class Images extends Model
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
    public $table = 'dmitry_adsbanner_images';
    
    
    public $attachOne = [
        'ads' => \System\Models\File::class
        ];
        
        

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

}
