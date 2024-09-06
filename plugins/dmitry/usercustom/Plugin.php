<?php namespace Dmitry\Usercustom;

use System\Classes\PluginBase;
use Event;
use Redirect;
use Session;
use RainLab\User\Models\User;

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
         Event::listen('rainlab.user.beforeRegister', function ($component, &$input) {
                return User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'password_confirmation' => $input['password_confirmation'],
            'phone' => $input['phone'],
            'country_id' => $input['country_id'],
            ]);
                
                
             });
             
             Event::listen('rainlab.user.register', function ($component, $user) {
                $user->setUrlForEmailVerification('lavchenko');
                $user->sendEmailVerificationNotification();
                Session::put('registerModal', true);
                
                $email = $user->email;
        
                $emailLink = $this->generateEmailLink($email);
                
                
                Session::put('emailLink', $emailLink);
                
                
                return Redirect::to('/'); 
             });
             Event::listen('rainlab.user.authenticate', function ($component) {
                return Redirect::to('/');
              });
    }
    protected function generateEmailLink($email)
    {
    // Создаем ссылку на почтовый сервис в зависимости от домена
    $emailDomain = explode('@', $email)[1];
    $mailProviders = [
        'gmail.com' => 'https://mail.google.com',
        'yahoo.com' => 'https://mail.yahoo.com',
        'outlook.com' => 'https://outlook.live.com',
        'hotmail.com' => 'https://outlook.live.com',
        'aol.com' => 'https://mail.aol.com',
        'icloud.com' => 'https://www.icloud.com/mail',
        'mail.com' => 'https://www.mail.com',
        'zoho.com' => 'https://mail.zoho.com',
        'protonmail.com' => 'https://protonmail.com',
        'tutanota.com' => 'https://tutanota.com',
        'yandex.com' => 'https://mail.yandex.com',
        'fastmail.com' => 'https://www.fastmail.com',
        'gm.com' => 'https://mail.google.com', // GMX Mail
        'gmx.com' => 'https://www.gmx.com',
        'inbox.com' => 'https://www.inbox.com',
        'mail.ru' => 'https://mail.ru'
    ];

    return $mailProviders[$emailDomain] ?? 'https://mail.google.com'; // По умолчанию Gmail
    }
    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
    }

    /**
     * registerSettings used by the backend.
     */
    public function registerSettings()
    {
    }
}
