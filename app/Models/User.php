<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
class User extends Authenticatable
{
    use HasFactory, Notifiable;
 
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
 
    protected $hidden = [
        'password',
        'remember_token',
    ];
 
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
 
    public function projects()
    {
        return $this->belongsToMany(Project::class)
            ->withPivot('project_role')
            ->withTimestamps();
    }
 
    public function ownedProjects()
    {
        return $this->hasMany(Project::class, 'owner_id');
    }
 
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assignee_id');
    }
 
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
