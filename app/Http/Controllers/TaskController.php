<?php

namespace App\Http\Controllers;

use App\TodoTable;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getTasks()
    {
        // return response()->json(TodoTable::orderBy('id')->get());
        $todo = TodoTable::orderBy('id')->get();
        if ($todo) {
            return response()->json($todo);
        }
        return response()->json(['status' => 'failed. No data available'], 404);
    }

    public function getTaskById($id)
    {
        // return response()->json(TodoTable::find($id));
        $todo = TodoTable::orderBy('id')->find($id);
        if ($todo) {
            return response()->json($todo);
        }
        return response()->json(['status' => 'failed. No data available'], 404);
    }

    public function setTask(Request $request)
    {
        $todo = TodoTable::create($request->all());
        return response()->json([$todo, $request->all()], 201);
    }

    public function updateTask(Request $request, $id)
    {
        $todo = TodoTable::findOrFail($id);
        if ($todo) {
            $todo->update($request->all());
            $todo->save();
            return response()->json($todo, 201);
        }
        return response(['status' => 'failed. No data found'], 404);
    }

    public function deleteTask($id)
    {
        $todo = TodoTable::find($id);
        if ($todo) {
            $todo->delete();
            return response()->json(['status' => 'task with ' . $id . ' deleted'], 201);
        }
        return response()->json(['status' => 'no task found'], 404);
    }
}
