<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    //serverBooks -> index : http://127.0.0.1:8000/api/books  :: get
    public function index(Request $request): JsonResponse
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

    // addBook -> store : http://127.0.0.1:8000/api/books  :: post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'no_of_page' => ['numeric', 'max:800'],
            'author' => ['required'],
            'category' => ['required'],
            'price' => ['required', 'numeric'],
            'released_year' => ['required','numeric','before:'.date('Y')],
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
        if ($request->get('status') === "false") {
            $bookData->status = 0;
        } else if ($request->get('status') === "true") {
            $bookData->status = 1;
        }
        $bookData->save();

        return response()->json([
            'status' => true,
            'data' => $bookData,
            'message' => "Success"
        ]);
    }

    //getBookData -> show : http://127.0.0.1:8000/api/books/1  ::  get
    public function show($id)
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

    // editBook -> update : http://127.0.0.1:8000/api/books/1  :: put/patch
    public function update(Request $request, $id)
    {
        // print_r($request->get('name'));
        // exit();
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'no_of_page' => ['required', 'max:800'],
            'author' => ['required'],
            'category' => ['required'],
            'price' => ['required', 'numeric'],
            'released_year' => ['required','numeric','before:'.date('Y')],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }
        if ($request->get('status') == false) {
            $status = 0;
        } else if ($request->get('status') == true) {
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

    //deleteData -> destroy  : http://127.0.0.1:8000/api/books/1  :: delete
    public function destroy($id)
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

    public function booksFilter(Request $request): JsonResponse
    {
        $value = $request->get('value');
        $query = Book::query()->where('userId', Auth::user()->id);

        switch ($value) {
            case Book::MORE_THAN_100_PAGES:
                $filtered = $query->where('no_of_page', '>', 100);
                break;
            case Book::LESS_THAN_90_AND_MORE_THAN_25_PAGES:
                $filtered = $query->whereBetween('no_of_page', [25, 90]);
                break;
            case Book::LESS_THAN_90_AND_MORE_THAN_25_BUT_NOT_80_PAGES:
                $filtered = $query->whereBetween('no_of_page', [25, 90])->where('no_of_page', '!=', 80);
                break;
            case Book::EMPTY_PAGES_BOOK:
                $filtered = $query->where('no_of_page', 0);
                break;
            case Book::RELEASED_YEAR_2015_AND_2001:
                $filtered = $query->whereIn('released_year', [2001, 2015]);
                break;
            case Book::SORT_BY_CATEGORY:
                $filtered = $query->orderBy('category', 'asc');
                break;
            case Book::SORT_BY_RELEASED_YEAR:
                $filtered = $query->orderBy('released_year', 'asc');
                break;
            case Book::SORT_BY_BOOK_AUTHOR:
                $filtered = $query->orderBy('author', 'asc');
                break;
            case Book::SORT_BY_BOOK_PRICE:
                $filtered = $query->orderBy('price', 'asc');
                break;
            case Book::SHOW_ALL_DATA:
                $filtered = $query;
                break;
            default:
                $filtered = "";
        }

        $filteredBooks = $filtered->get();

        return response()->json([
            'status' => true,
            'book' => $filteredBooks,
            'message' => "Successfully retrieved data"
        ]);
    }

    public function serverBooksFilter(Request $request): JsonResponse
    {
        $value = $request->get('value');
        $query = Book::query()->where('userId', Auth::user()->id);

        switch ($value) {
            case Book::MORE_THAN_100_PAGES:
                $filtered = $query->where('no_of_page', '>', 100);
                break;
            case Book::LESS_THAN_90_AND_MORE_THAN_25_PAGES:
                $filtered = $query->whereBetween('no_of_page', [25, 90]);
                break;
            case Book::LESS_THAN_90_AND_MORE_THAN_25_BUT_NOT_80_PAGES:
                $filtered = $query->whereBetween('no_of_page', [25, 90])->where('no_of_page', '!=', 80);
                break;
            case Book::EMPTY_PAGES_BOOK:
                $filtered = $query->where('no_of_page', 0);
                break;
            case Book::RELEASED_YEAR_2015_AND_2001:
                $filtered = $query->whereIn('released_year', [2001, 2015]);
                break;
            case Book::SORT_BY_CATEGORY:
                $filtered = $query->orderBy('category', 'asc');
                break;
            case Book::SORT_BY_RELEASED_YEAR:
                $filtered = $query->orderBy('released_year', 'asc');
                break;
            case Book::SORT_BY_BOOK_AUTHOR:
                $filtered = $query->orderBy('author', 'asc');
                break;
            case Book::SORT_BY_BOOK_PRICE:
                $filtered = $query->orderBy('price', 'asc');
                break;
            case Book::SHOW_ALL_DATA:
                $filtered = $query;
                break;
            default:
                $filtered = "";
        }

        return datatables()->eloquent($filtered)
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
}
