<?php

namespace App\Listeners;

use App\Events\TaskCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskCompletedEmail;
use Illuminate\Support\Facades\Auth;

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
        $task = $event->task;
        $firstname = $task->user->firstname;
        $task_name = $task->task->name;
        $email = Auth::email();
        Mail::to($email)->send(new TaskCompletedEmail($firstname, $task_name));
    }
}
