<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function get_users(Request $request): JsonResponse
    {
        $data = User::find(Auth::user()->id);
        $book = Book::where('userId', $data->id)->get();

        return response()->json([
            'status' => true,
            'data' => $data,
            'book' => $book,
            'auth' => Auth::user(),
            'message' => "successful get data"
        ]);
    }

    public function changePassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string', 'min:6'],
            'password' => ['required', 'string', 'min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/'],
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->get('current_password'), $user->password)) {

            $user->update([
                'password' => Hash::make($request->get('password'))
            ]);

            return response()->json([
                'status' => true,
                'message' => "Successful Change Password"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => array('current_password' => ["0"=>"Current Password Is Not Matched"] )
            ]);
        }
    }
}
