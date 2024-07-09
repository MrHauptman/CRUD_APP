<?php

namespace App\Http\Controllers;

use App\Events\TaskCompleted;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\DeleteCompletedTask;
use App\Models\Task;
use App\Services\TaskService;
use Inertia\Inertia;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\DatabaseQueue;

use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{

  private TaskService $taskService;
 
  public function __construct(TaskService $taskService)
  {
      $this->taskService = $taskService;
  }


    public function index()
    {
      $taskService = new TaskService;
      $tasks = $taskService->getAllTasks();
    
      return Inertia::render('Tasks/Index', [
        'tasks' => $tasks
      ]);
      
    }

    public function create() 
    { return Inertia::render('Tasks/Create');
    }
   
    public function store (Request $request)
    { 
      // Validator::make($request->all(), [
      //      'name' => ['required'],
      //     /  'description' => ['required'],
      //      ])->validate();
        
      //   /Task::create($request->all());
      //   return redirect()->route('tasks.index');
    
    
        $validateData = $this->validate($request);
        $this->taskService->createTask($validateData);
        return redirect()->route('tasks.index');
      }
    public function Edit(Task $task)
    {
      return Inertia::render('Tasks/Edit', [
        'task' => $task
    ]);
    }

    public function Update($id, Request $request)
  {
    //   Validator::make($request->all(), [
    //     'name' => ['required'],
    //     'description' => ['required'],
    //     ])->validate();

    // Task::find($id)->update($request->all());
    // return redirect()->route('tasks.index');
  $task = Task::find($id);
  $this->validate($request);
  $this->taskService->updateTask($task, $request->all());
  return redirect()->route('tasks.index');
  }

    public function Destroy($id)
    {
      // Task::find($id)->delete();
      // return redirect()->route('tasks.index');

    $task = Task::find($id);
    $this->taskService->deleteTask($task);
    return redirect()->route('tasks.index');
    }
    
    protected function validate(Request $request)
  {
  return Validator::make($request->all(), [
    
    'name' => ['required'],
    'description' => ['required'],
  ])->validate();
  }

  public function complete($id) {
    $task = Task::find($id);
    $this->taskService->completeTask($task);
    event(new TaskCompleted($task));

    $job = new DeleteCompletedTask($task);
    ///dd($job); 
  //   $connection = DB::connection();
  //   $queue  = new DatabaseQueue($connection, 'default');
  //  // dd($queue);
  //   $queue->push($job)->delay(30);
   Queue::push($job);
   $job->delay(10);
  return redirect()->route('tasks.index');

  }
        
}
