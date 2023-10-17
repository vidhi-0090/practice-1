<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = Notes::get();
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
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notes' => ['required', 'string'],
            'dateTime' => ['required', 'after:'.date('')]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $notes = new Notes();
        $notes->notes = $request->get('notes');
        $notes->userId = Auth::user()->id;
        $notes->dateTime = $request->get('dateTime');
        $notes->save();

        return response()->json([
            'status' => true,
            'data' => $notes,
            'message' => "Success"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Notes::find($id);
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'notes' => ['required', 'string'],
            'dateTime' => ['required', 'after:'.date('')]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $data = Notes::find($id)
            ->update([
                'notes' => $request->get('notes'),
                'dateTime' => $request->get('dateTime')
            ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => "Success"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Failed"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if($request->get('allDelete') != 0){
            $data = Notes::where('userId', Auth::user()->id)->delete();
        }else{
            $data = Notes::find($id)->delete();
        }

        return response()->json([
            'status' => true,
            'message' => "Success"
        ]);
    }
}
