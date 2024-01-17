<?php

namespace App\Services\Notification\Constants;

use App\Mail\UserRegistered;
use App\Mail\TopicCreated;
use App\Mail\ForgetPassword;

class EmailTypes
{
    const USER_REGISTERED = 1;
    const TOPIC_CREATED = 2;
    const FORGET_PASSWORD = 3;

    public static function toString()
    {
        return [
            self::USER_REGISTERED => __('notification.userRegistered'),
            self::TOPIC_CREATED => __('notification.topicCreated'),
            self::FORGET_PASSWORD => __('notification.forgetPassword')
        ];
    }

    public static function toMail($type)
    {
        try {
            return [
                self::USER_REGISTERED => UserRegistered::class,
                self::TOPIC_CREATED => TopicCreated::class,
                self::FORGET_PASSWORD => ForgetPassword::class
            ][$type];
        } catch (\Throwable $th) {
            throw new \InvalidArgumentException("Mailable class does not exist", 1);
        }
    }
}