<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function get_user($id):JsonResponse
    {
        $data = User::find($id);
        $book = Book::where('userId',Auth::user()->id)->get();

        return response()->json([
            'status' => true,
            'data' => $data,
            'book' => $book,
            'auth' => Auth::user(),
            'message' => "successful get data"
        ]);
    }

    public function changePassword(Request $request):JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string', 'min:6'],
            'password' => ['required', 'string', 'min:6'],
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }
    }


}
