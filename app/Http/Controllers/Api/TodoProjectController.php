<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Models\TodoProject;
use App\Models\TodoPersonal;
use App\Models\ProjectMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TodoProjectController extends Controller
{
    public function insert_todo_project(Request $request)
    {
        $todo = TodoProject::create([
            'project_id' => $request->project_id,    
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline
        ]);
        
        return setJson(true, 'Berhasil menambahkan todo-list!', $todo, 200, []);
    }
    
    public function get_todo_project_byproject($project_id)
    {
        $todos = TodoProject::with('user')->with('project')->where('project_id', $project_id)->get();
        
        return response()->json(['success' => true, 'data' => $todos], 200);
        
    }
    
    public function get_todo_project_done_byuser(Request $request)
    {
        $todos = TodoProject::with('user')->with('project')->where('user_id', $request->id)->where('project_id', $request->project_id)->where('status', 1)->get();
        
        return response()->json(['success' => true, 'data' => $todos], 200);
        
    }
    
    public function get_todo_project_done(Request $request)
    {
        $todos = TodoProject::with('user')->with('project')->where('project_id', $request->project_id)->where('status', 1)->get();
        
        return response()->json(['success' => true, 'data' => $todos], 200);
        
    }
    
    public function get_todo_project_undone(Request $request)
    {
        $todos = TodoProject::with('user')->with('project')->where('project_id', $request->project_id)->where('status', 0)->get();
        
        return response()->json(['success' => true, 'data' => $todos], 200);
        
    }
    
    public function update_status_done(Request $request)
    {
        $todo = TodoProject::where('id', $request->id)->update(['status' => 1]);
        
        return setJson(true, 'Berhasil mengupdate todo-list!', $todo, 200, []);
    }
    
    public function update_status_undone(Request $request)
    {
        $todo = TodoProject::where('id', $request->id)->update(['status' => 0]);
        
        return setJson(true, 'Berhasil mengupdate todo-list!', $todo, 200, []);
    }
    
    public function update_todo_project(Request $request)
    {
        $todo = TodoProject::where('id', $request->id)->update($request->all());
        
        return setJson(true, 'Berhasil mengupdate todo-list!', $todo, 200, []);
    }
    
    public function delete_todo_project(Request $request)
    {
        $todo = TodoProject::where('id', $request->id)->delete();
        
        return setJson(true, 'Berhasil menghapus todo-list!', $todo, 200, []);
    }

}
