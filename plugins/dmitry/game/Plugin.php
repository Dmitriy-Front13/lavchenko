<?php namespace Dmitry\Game;

use System\Classes\PluginBase;

/**
 * Plugin class
 */
class Plugin extends PluginBase
{
    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
          return [
            \Dmitry\Game\Components\GameComponent::class => 'gameComponent',
            \Dmitry\Game\Components\Timer::class => 'Timer',
            \Dmitry\Game\Components\GameStats::class => 'GameStats',
            \Dmitry\Game\Components\GameInfo::class => 'GameInfo',
            \Dmitry\Game\Components\GameWinner::class => 'GameWinner',
        ];
    }

    /**
     * registerSettings used by the backend.
     */
    public function registerSettings()
    {
    }
}
