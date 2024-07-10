<?php

namespace App\Listeners;

use App\Events\TaskCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskCompletedEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        $task = $event->task;
        $task_name = $task->name;
        $email = ('getter@gmail.com'); ////scha ya pridumay kak poluchit email
        Mail::to($email)->send(new TaskCompletedEmail($task_name));
    }
}
