<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Models\TodoProject;
use App\Models\TodoPersonal;
use App\Models\ProjectMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TodoPersonalController extends Controller
{
    public function insert_todo_personal(Request $request)
    {
        $todo = TodoPersonal::create($request->all());
        
        return setJson(true, 'Berhasil menambahkan todo-list!', $todo, 200, []);
    }
    
    public function get_todo_personal()
    {
        $todos = TodoPersonal::with('user')->where('user_id', Auth::user()->id)->get();
        
        return response()->json(['success' => true, 'data' => $todos], 200);
        
    }
    
    public function get_todo_personal_done()
    {
        $todos = TodoPersonal::with('user')->where('user_id', Auth::user()->id)->where('status', 1)->get();
        
        return response()->json(['success' => true, 'data' => $todos], 200);
        
    }
    
    public function get_todo_personal_undone()
    {
        $todos = TodoPersonal::with('user')->where('user_id', Auth::user()->id)->where('status', 0)->get();
        
        return response()->json(['success' => true, 'data' => $todos], 200);
        
    }
    
    public function update_todo_personal(Request $request)
    {
        $todo = TodoPersonal::where('id', $request->id)->update($request->all());
        
        return setJson(true, 'Berhasil mengupdate todo-list!', $todo, 200, []);
    }
    
    public function update_status_done(Request $request)
    {
        $todo = TodoPersonal::where('id', $request->id)->update(['status' => 1]);
        
        return setJson(true, 'Berhasil mengupdate todo-list!', $todo, 200, []);
    }
    
    public function update_status_undone(Request $request)
    {
        $todo = TodoPersonal::where('id', $request->id)->update(['status' => 0]);
        
        return setJson(true, 'Berhasil mengupdate todo-list!', $todo, 200, []);
    }
    
    public function delete_todo_personal(Request $request)
    {
        $todo = TodoPersonal::where('id', $request->id)->delete();
        
        return setJson(true, 'Berhasil menghapus todo-list!', $todo, 200, []);
    }
}
