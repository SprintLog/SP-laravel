<?php

namespace App\Http\Controllers;


use App\Project;
use App\Match;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $projects = DB::table('projects')->get();
      return view('projectlist', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $project = Project::find($id);

      $TypeProjectIsNow = DB::table('type_project')->select('id','type')
        ->where('id',function($query) use ($id){
           $query->select('typeProjectId')
           ->from('projects')
           ->where('id',$id);
        })
        ->first();
      // dd($TypeProjectIsNow);
      $userLeture = DB::table("users")->select('*')
            ->whereIn('id',function($query) use ($id){
               $query->select('userId')
               ->from('matches')
               ->where('ProjectId',$id);
            })->where('typeUser','=',1)
      ->first();

      $userStd  = DB::table("users")->select('*')
            ->whereIn('id',function($query) use ($id){
               $query->select('userId')
               ->from('matches')
               ->where('ProjectId',$id);
            })->where('typeUser','=',0)
      ->get();

      $TypeProject = DB::table('type_project')->get();

      $userStdShow  = DB::table("users")
      ->select('id','name','lastname')
      ->where('typeUser','=',0)
      ->get();

      $userLetureShow = DB::table("users")
      ->select('id','name','lastname')
      ->where('typeUser','=',1)
      ->get();

       // dd($userInfo);
      return view('projectinfo', compact('project',
                                        'userLeture',
                                        'userStd',
                                        'TypeProject',
                                        'TypeProjectIsNow',
                                        'userStdShow',
                                        'userLetureShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         //dd($request);
        //dd($request->developer);
        $thainame = $request->t_project_name;
        $engname = $request->e_project_name;
        $typeProject= $request->typeProjectId;
        $advisors = $request->advisorsId;
        $developer = $request->developer;
        $abstract= $request->abstract;
        $keyword= $request->keyword;


        DB::table("projects")
        ->where('id' , $id)
        ->update(['thai_name' => $thainame ,'eng_name' => $engname ,'typeProjectId'=>$typeProject , 'abstack' =>$abstract ,'keywords' => $keyword] );

        return back()->with('success', 'Update Success');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $project = Project::find($id)->delete();
      return back();
    }
}
// GET     /forums              ->  index    หน้า list
// GET     /forums/new          ->  new      show form html ให้กรอกข้อมูล
// POST    /forums              ->  create   รับจาก form แบบ post
// GET     /forums/:forum       ->  show     แสดงข้อมูลที่ ละ 1
// GET     /forums/:forum/edit  ->  edit     show form edit
// PUT     /forums/:forum       ->  update   update data
// DELETE  /forums/:forum       ->  destroy
