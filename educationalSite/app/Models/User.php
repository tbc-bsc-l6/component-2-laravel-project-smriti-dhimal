<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_role_id',
    ];

    protected $guarded = ['id', 'remembre_token', 'email_verified_at'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class)
        ->withPivot('start_date', 'completed_at', 'result')
        ->withTimestamps();
    }

    public function activeModules()
    {
        return $this->modules()->wherePivotNull('completed_at');
    }

    public function completedModules()
    {
        return $this->modules()->wherePivotNotNull('completed_at');
    }

    public function assignedModules()
    {
        return $this->hasMany(Module::class, 'teacher_id');
    }
    // Helper methods for role checking
    public function isAdmin()
    {
        return $this->user_role_id === 1;
    }
    public function isTeacher()
    {
        return $this->user_role_id === 2;
    }
    public function isCurrentStudent()
    {
        return $this->user_role_id === 3;
    }
    public function isOldStudent()
    {
        return $this->user_role_id === 4;
    }
}
