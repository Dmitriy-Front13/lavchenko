<?php namespace Dmitry\AdsBanner\Components;

use Cms\Classes\ComponentBase;
use Dmitry\AdsBanner\Models\Images;

class BannerList extends ComponentBase
{
   
    public function componentDetails()
    {
        return [
            'name' => 'Banner List',
            'description' => 'Displays a list of photos'
        ];
    }

    public function onRun()
    {
        $this->page['photos'] = $this->loadPhotos();
    }

    protected function loadPhotos()
    {
        return Images::all();
    }
    
     public $photos;
}

