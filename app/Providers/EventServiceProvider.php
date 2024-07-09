<?php

use App\Events\TaskCompleted;
use App\Listeners\SendCongratsEmail;
use App\Listeners\TaskCompletedNotification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
class EventServiceProvider extends ServiceProvider{


    protected $listen = [
    Registered::class => [
        SendEmailVerificationNotification::class,
    ],
    TaskCompleted::class => [
        TaskCompletedNotification::class
    ]
];
}