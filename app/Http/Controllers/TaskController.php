<?php

namespace App\Http\Controllers;

use App\TodoTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function getTasks()
    {
        // return response()->json(TodoTable::orderBy('id')->get());
        $todo = TodoTable::where('Person_id', auth()->user()['id'])->get();
        if ($todo) {
            return response()->json($todo);
        }
        return response()->json(['status' => 'failed. No data available'], 404);
    }

    public function getTaskById($id)
    {
        // return response()->json(TodoTable::find($id));
        $todo = TodoTable::orderBy('id')->where('Person_id', auth()->user()['id'])->find($id);
        if ($todo) {
            return response()->json($todo);
        }
        return response()->json(['status' => 'failed. No data available'], 404);
    }

    public function setTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activity' => ['required'],
            'description' => ['required']
            ]
        );
        $activity = $request->input('activity');
        $description = $request->input('description');
        $person_id = auth()->user()['id'];
        if (!$validator->failed()){
            $todo = TodoTable::create([
                'activity' => $activity,
                'description' => $description,
                'Person_id' => $person_id
            ]);
            return response()->json([$todo], 201);
        }
        return response()->json(['status'=> 'failed', 404]);
    }

    public function updateTask(Request $request, $id)
    {
        $todo = TodoTable::orderBy('id')->where('Person_id', auth()->user()['id'])->find($id);
        $activity = $request->input('activity');
        $description = $request->input('description');
        $person_id = auth()->user()['id'];
        if ($todo) {
            $todo->update([
                'activity' => $activity,
                'description' => $description,
                'Person_id' => $person_id
            ]);
            $todo->save();
            return response()->json($todo, 201);
        }
        return response(['status' => 'failed. No data found'], 404);
    }

    public function deleteTask($id)
    {
        $todo = TodoTable::orderBy('id')->where('Person_id', auth()->user()['id'])->find($id);
        if ($todo) {
            $todo->delete();
            return response()->json(['status' => 'task with ' . $id . ' deleted'], 201);
        }
        return response()->json(['status' => 'no task found'], 404);
    }
}
