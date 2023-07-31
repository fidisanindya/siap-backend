<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectManagement extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'projectmembers', 'project_id', 'user_id');
    } 
    
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projectmembers', 'project_id', 'user_id');
    } 
}