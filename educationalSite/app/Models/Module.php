<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    use HasFactory;
    protected $fillable=[
        'module',
        'available',
        'teacher_id',
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
        ->withPivot('start_date', 'completed_at', 'result')
        ->withTimestamps();
    }

    public function activeStudents()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['start_date', 'completed_at', 'result'])
            ->whereNull('module_user.completed_at');
    }

    public function completedStudents()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['start_date', 'completed_at', 'result'])
            ->whereNotNull('module_user.completed_at');
        
    }

}
