<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::get();
        // return response()->json([
        //     'status' => true,
        //     'data' => $data,
        //     'message' => "Get Data Successful"
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $data = Task::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => "Get Data Successful"
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => "Data NOt Found"
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $task = new Task();
        $task->name = $request->get('name');
        $task->completed = $request->get('completed');
        $task->save();

        return response()->json([
            'status' => true,
            'data' => $task,
            'message' => "Success"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Task::where('id', $id)
            ->update([
                'completed' => $request->get('completed'),
            ]);
        if ($data) {
            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => "Get Data Successful"
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => "Data NOt Found"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Task::find($id)->delete();

        return response()->json([
            'status' => true,
            'message' => "Success"
        ]);
    }
}
