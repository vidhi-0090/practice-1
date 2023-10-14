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
    public function index(Request $request): JsonResponse
    {
        $data = Task::query();
        if ($request->get('type') != "") {
            $type = $request->get('type');
            switch ($type) {

                case Task::ACTIVE:
                    $filtered = $data->where('completed', false);
                    break;
                case Task::COMPLETED:
                    $filtered = $data->where('completed', true);
                    break;
                default:
                    $filtered = $data;
            }
        }
        $filtered = $data;
        $filteredTask = $filtered->get();

        return response()->json([
            'status' => true,
            'data' => $filteredTask,
            'count' => count($filteredTask),
            'message' => "Get Data Successful"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id): JsonResponse
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
    public function store(Request $request): JsonResponse
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
    public function update(Request $request, $id): JsonResponse
    {
        $data = Task::where('id', $id)
            ->update([
                'completed' => $request->get('completed'),
                'name' => $request->get('name'),
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
    public function destroy($id): JsonResponse
    {
        $data = Task::find($id)->delete();
        return response()->json([
            'status' => true,
            'message' => "Success"
        ]);
    }
}
