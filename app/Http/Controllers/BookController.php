<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use DataTables;

class BookController extends Controller
{
    public function addBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'no_of_page' => ['required'],
            'author' => ['required'],
            'category' => ['required'],
            'price' => ['required'],
            'released_year' => ['required'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $bookData = new Book();
        $bookData->name = $request->get('name');
        $bookData->description = $request->get('description');
        $bookData->no_of_page = $request->get('no_of_page');
        $bookData->author = $request->get('author');
        $bookData->category = $request->get('category');
        $bookData->price = $request->get('price');
        $bookData->released_year = $request->get('released_year');
        $bookData->userId = Auth::user()->id;
        if($request->get('status') === "false"){
            $bookData->status = 0;
        }else if($request->get('status') === "true"){
            $bookData->status = 1;
        }
        $bookData->save();

        return response()->json([
            'status' => true,
            'data' => $bookData,
            'message' => "Success"
        ]);
    }

    public function getBookData($id)
    {
        $data = Book::find($id);
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

    public function editBook(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'no_of_page' => ['required'],
            'author' => ['required'],
            'category' => ['required'],
            'price' => ['required'],
            'released_year' => ['required'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        if($request->get('status') === "false" || $request->get('status') === 0 || $request->get('status') === false){
            $status = 0;
        }else if($request->get('status') === "true" || $request->get('status') === 1 || $request->get('status') === true){
            $status = 1;
        }

        $data = Book::where('id', $request->get('bookId'))
            ->update([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'no_of_page' => $request->get('no_of_page'),
                'author' => $request->get('author'),
                'category' => $request->get('category'),
                'price' => $request->get('price'),
                'released_year' => $request->get('released_year'),
                'status' => $status
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

    public function deleteData($id)
    {
        $data = Book::find($id)->delete();

        return response()->json([
            'status' => true,
            'message' => "Success"
        ]);
    }

    public function searchData(Request $request)
    {

        // dd($request->get('search'));
        // $validator = Validator::make($request->all(), [
        //     'search' => ['required']
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $validator->errors()
        //     ]);
        // }

        $data = Book::orWhere('name', 'like', '%' . $_GET['search'] . '%')
            ->orWhere('description', 'like', '%' . $_GET['search'] . '%')
            ->orWhere('no_of_page', 'like', '%' . $_GET['search'] . '%')
            ->orWhere('author', 'like', '%' . $_GET['search'] . '%')
            ->orWhere('category', 'like', '%' . $_GET['search'] . '%')
            ->orWhere('price', 'like', '%' . $_GET['search'] . '%')
            ->orWhere('released_year', 'like', '%' . $_GET['search'] . '%')
            ->orWhere('status', 'like', '%' . $_GET['search'] . '%')
            ->get();

        if (count($data) > 0) {
            return response()->json([
                'status' => true,
                'book' => $data,
                'message' => "Success"
            ]);
        } else if (count($data) == 0) {
            return response()->json([
                'status' => true,
                'book' => $data,
                'message' => "Data Not Found"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Failed"
            ]);
        }
    }

    public function serverBooks(Request $request): JsonResponse
    {
        $query = Book::query()->where('userId', Auth::user()->id);

        return datatables()->eloquent($query)
            ->addColumn('status', function ($book) {
                if ($book->status == 1) {
                    return 'True';
                } else {
                    return 'False';
                }
            })

            ->addColumn('action', function ($book) {
                return '
                <button style="margin-top:2px;" data-book-id="' . $book->id . '"
                    class="edit-button bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                    Edit
                </button>

                <button style="margin-top:2px;" data-book-id="' . $book->id . '"
                        class="delete-button bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                        Delete
                </button>';
            })
            ->toJson();
    }

    public function booksFilter(Request $request): JsonResponse
    {

        $value = $request->get('value');
        $query = Book::query()->where('userId', Auth::user()->id);

        if ($value == Book::More_Than_100_Pages) {
            $query->Where('no_of_page', '>', 100);
        } else if ($value == Book::Less_Than_90_And_More_Than_25_Pages) {
            $query->whereBetween('no_of_page', [25, 90]);
        } else if ($value == Book::Less_Than_90_And_More_Than_25_But_Not_80_Pages) {
            $query->whereBetween('no_of_page', [25, 90])->Where('no_of_page', '!=', 80);
        } else if ($value == Book::Not_Pages_Books) {
            $query->Where('no_of_page', 0);
        } else if ($value == Book::Released_Year_2015_And_2001) {
            $query->whereIn('released_year', [2001, 2015]);
        } else if ($value == Book::Sort_By_Category) {
            $query->orderBy('category','asc');
        } else if ($value == Book::Sort_By_Released_Year) {
            $query->orderBy('released_year','asc');
        } else if ($value == Book::Sort_By_Book_Author) {
            $query->orderBy('author','asc');
        } else if ($value == Book::Sort_By_Book_Price) {
            $query->orderBy('price','asc');
        }

        $filteredBooks = $query->get();

        return response()->json([
            'status' => true,
            'book' => $filteredBooks,
            'message' => "successful get data"
        ]);
    }

    public function serverBooksFilter(Request $request): JsonResponse
    {
        $value = $request->get('value');
        $query = Book::query()->where('userId', Auth::user()->id);

        if ($value == Book::More_Than_100_Pages) {
            $query->Where('no_of_page', '>', 100);
        } else if ($value == Book::Less_Than_90_And_More_Than_25_Pages) {
            $query->whereBetween('no_of_page', [25, 90]);
        } else if ($value == Book::Less_Than_90_And_More_Than_25_But_Not_80_Pages) {
            $query->whereBetween('no_of_page', [25, 90])->Where('no_of_page', '!=', 80);
        } else if ($value == Book::Not_Pages_Books) {
            $query->Where('no_of_page', 0);
        } else if ($value == Book::Released_Year_2015_And_2001) {
            $query->whereIn('released_year', [2001, 2015]);
        } else if ($value == Book::Sort_By_Released_Year) {
            $query->orderBy('released_year','asc');
        } else if ($value == Book::Sort_By_Book_Author) {
            $query->orderBy('author','asc');
        } else if ($value == Book::Sort_By_Book_Price) {
            $query->orderBy('price','asc');
        }

        if ($query) {
            return datatables()->eloquent($query)
                ->addColumn('status', function ($book) {
                    if ($book->status == 1) {
                        return '<span class="badge">True</span>';
                    } else {
                        return '<span class="badge">False</span>';
                    }
                })
                ->addColumn('action', function ($book) {
                    return '
                    <button style="margin-top:2px;" data-book-id="' . $book->id . '"
                        class="edit-button bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                        Edit
                    </button>

                    <button style="margin-top:2px;" data-book-id="' . $book->id . '"
                            class="delete-button bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                            Delete
                    </button>';
                })
                ->toJson();
        }
    }
}
