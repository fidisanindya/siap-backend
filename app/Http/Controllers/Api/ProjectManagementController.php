<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Models\ProjectManagement;
use App\Models\ProjectMember;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProjectManagementController extends Controller
{
    public function get_project()
    {
        $projects = [];
        $datas = ProjectMember::where('user_id', Auth::user()->id)->get();
        foreach ($datas as $key => $data) {
            $data_project = ProjectManagement::where('id', $data->project_id)->first();
            $projects[$key] = $data_project;
            $members = ProjectMember::with('user')->where('project_id', $data_project->id)->get();
            $projects[$key]['members'] = $members;
             
        }
        return response()->json(['success' => true, 'data' => $projects], 200);
        
    }
    
    public function insert_project(Request $request)
    {
        $projectId = ProjectManagement::insertGetId([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);
        
        ProjectMember::create([
           'project_id' => $projectId,
           'user_id' => Auth::user()->id
        ]);
        
        return setJson(true, 'Berhasil menambahkan project!', $projectId, 200, []);
    }
    
    public function update_project(Request $request)
    {
        $update = ProjectManagement::where('id', $request->id)->update($request->all());
        
        return setJson(true, 'Berhasil mengupdate project!', $update, 200, []);
    }
    
    public function delete_project(Request $request)
    {
        ProjectManagement::where('id', $request->project_id)->delete();
        ProjectMember::where('project_id', $request->project_id)->delete();
        return response()->json(['success' => true], 200);
    }
    
    public function insert_member_project(Request $request)
    {
        $project = ProjectManagement::where('id', $request->project_id)->first();
        foreach($request->members as $member){
            ProjectMember::insert([
               'project_id'=> $project->id,
               'user_id' => $member
            ]);
        }
        
        return setJson(true, 'Berhasil menambahkan member!', $project, 200, []);
    }
    
    public function get_member($project_id)
    {
        
        $projectManagement = ProjectMember::with('user')->where('project_id', $project_id)->get();
    
        if ($projectManagement) {
            return response()->json(['success' => true, 'data' => $projectManagement], 200);
        }
        
        return response()->json(['success' => true, 'data' => null], 200);
        
    }
    
    public function getUsersNotInProject(Request $request)
    {
        $project_id = $request->input('project_id');

        // Mengambil daftar user yang tidak ada pada projectmanagement dengan id project_id
        $usersNotInProject = User::whereDoesntHave('projects', function ($query) use ($project_id) {
            $query->where('project_id', $project_id);
        })->get();

        return response()->json(['success' => true, 'data' => $usersNotInProject], 200);
    }
    
    public function delete_member(Request $request)
    {
        ProjectMember::where('project_id', $request->project_id)->where('user_id', $request->user_id)->delete();
        return response()->json(['success' => true], 200);
    }
}
