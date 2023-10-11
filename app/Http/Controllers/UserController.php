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
        $book = Book::where('userId',$id)->get();
        foreach($book as $b){
            if($b->status == 1 ){
                $b->status = 'True';
            }else{
                $b->status = 'False';
            }
        }
        return response()->json([
            'status' => true,
            'data' => $data,
            'book' => $book,
            'auth' => Auth::user(),
            'message' => "successful get data"
        ]);
    }


}
