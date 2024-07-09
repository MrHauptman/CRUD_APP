<?php

namespace App\Services;

use App\Models\Task;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\TaskCompleted;


class TaskService {
    public $queue;

public function getAllTasks()
{
  return Task::all();
}
public function getTaskById($taskId)
{
  return Task::find($taskId);
}
public function createTask(array $data)
{
  return Task::create($data);
}
public function updateTask(Task $task, array $data)
{
  $task->update($data);
}
public function deleteTask(Task $task)
{
  $task->delete();
}
public function completeTask(Task $task)
{
  $task->status = 'completed';
  $task->save();
  
}



}