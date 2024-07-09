<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Statuses;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description'
    ];

    protected $dates = 
    [
    'opened_at', 
    'deadline', 
    'finished_at'
    ];

    public function user() 
    {
    return $this->belongsTo(User::class);
    }

    protected $dispatchesEvents = [
      'created_at' => \App\Events\TaskCompleted::class,
  ]; 
}

