<?php

namespace App\Listeners;

use App\Events\TaskCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskCompletedEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
class TaskCompletedNotification implements ShouldQueue

{
    /**
     * Create the event listener.
     */
    

    /**
     * Handle the event.
     */
    public function handle(TaskCompleted $event): void
    {
        Log::debug('Job started');
        $task_name = $event->task;
        $first_name = $event->user->name;
       /// $email = $event->email;
        ////$email = 'test@gmail.com';
        $email = $event->user->email;
        Mail::to($email)->send(new TaskCompletedEmail($first_name));
    }
}
