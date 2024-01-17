<?php
namespace App\Services\Notification;

use App\Services\Notification\Providers\Contracts\Provider;

/**
   * @method sendSms(\App\User $user, String $text) 
   * @method sendEmail(\App\User $user, Mailbal $mailable) 
*/

class Notification
{
    public function __call($method, $args)
    {
        $providerPath = __NAMESPACE__ . '\Providers\\' . substr($method, 4) . 'Provider';
        if(!class_exists($providerPath)) {
            throw new \Exception("Error Processing Request | Class does not exist", 1);
        }
        $providerInstancs = new $providerPath(...$args);
        if (!is_subclass_of($providerInstancs, Provider::class)){
            throw new \Exception("Error Processing Request | class must implements App\Services\Notification\Providers\Contracts\Provider", 1);
        }
        return $providerInstancs->send();
    }
}
