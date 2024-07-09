<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;

class DeleteCompletedTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $task;
    /**
     * Create a new job instance.
     */
    public function __construct(Task $task)
    {
       $this->$task = $task;
    }

    /**
     * Execute the job.
     */

//   public function handleWithDelay(Task $task)
//   {
//     sleep(30);

//     $this->handle($task);
//   }
    public function handle(Task $task)
    {  
        $this->$task->delete();
    }
}
