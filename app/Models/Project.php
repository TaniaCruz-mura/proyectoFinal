<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Project extends Model
{
    use HasFactory, SoftDeletes;
 
    protected $fillable = ['name', 'description', 'status', 'owner_id'];
 
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
 
    public function members()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('project_role')
            ->withTimestamps();
    }
 
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
 
    public function isMember(User $user): bool
    {
        return $this->members()->where('user_id', $user->id)->exists();
    }
 
    public function roleOf(User $user): ?string
    {
        $member = $this->members()->where('user_id', $user->id)->first();
 
        return $member?->pivot->project_role;
    }
}
