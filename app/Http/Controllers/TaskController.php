<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class TaskController extends Controller
{
    public function insert(Request $request){
      // dd($request);
      $task = new Task;
      $task->nametask   = $request->nametask;
      $task->complexity = $request->complexity;
      // $task->projectId  = $request->projectId; WAIT MAKE PROJECT & USER
      $task->projectId  = 1;
      $task->save();
      echo "sucess";
      return back();
    }
}
