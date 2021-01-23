<?php

namespace App\Http\Controllers;

use App\TodoTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getTasks()
    {
        return response()->json(TodoTable::all());
    }

    public function getTaskById($id)
    {
        return response()->json(TodoTable::find($id));
    }

    public function setTask(Request $request)
    {
        $todo = TodoTable::create($request->all());
        return response()->json([$todo, $request->all()], 201);
    }

    public function updateTask(Request $request, $id)
    {   
        $todo = TodoTable::findOrFail($id);
        $todo->update($request->all());
        $todo->save();
        return response()->json([$todo, $request->all()], 201);
    }

    public function deleteTask($id)
    {
        $todo = TodoTable::find($id);
        $todo->delete();

        return response()->json(['status' => 'task with $id deleted'], 201);
    }
}
