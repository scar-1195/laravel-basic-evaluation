<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function todoList()
    {
        return $this->belongsTo(Todolist::class);
    }

    public function step()
    {
        return $this->hasMany(Step::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class)->using(TaskUser::class);
    }
}
