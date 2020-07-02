<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Book;
use App\Http\Resources\BookResource;
use App\Exceptions\CustomException;
use App\Http\Controllers\BaseController;
use Validator;

class BookController extends BaseController //Controller
{
    //client User Book list
    public function clientBookList()
    {
        $id=Auth::user()->id;
        $books = Book::where('client_id', $id)->get();
        $books=(!is_null($books))? $books: [];

        return view('books.index')->with(
            ['books'=>BookResource::collection($books)]
        );
    }

    //Client Book Creation
    public function clientBookCreate()
    {
        return view('books.ownbookcreate');
    }

    //Client Book Store
    public function clientBookStore(Request $request)
    {
        try {
            $input=$request->all();
            $validator = Validator::make($input, Book::$rules);
            if ($validator->fails()) {
                //Ajax method of form submission.
                return $this->sendError('Validation Errors', [$validator->errors()], 201);
            }
            $this->authorization($input);
            $book = Book::create($input);
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage(), [$exception->getMessage()], 201);
        }
        return $this->sendResponse(['id'=>$book->id], 'Book Created Successfully..');
    }

    
    //Try to get common function but fails therefore User Book list only
    public function userBookList()
    {
        $id=Auth::user()->id;
        switch (parent::roleHome()) {
            case 'user':
                $books = Book::where('user_id', $id)->get();
                break;
            case 'clients':
                $books = Book::where('client_id', $id)->get();
                break;
        }
        $books=(!is_null($books))? $books: [];

        return view('books.index')->with(
            ['books'=>BookResource::collection($books)]
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::user()->id;
        switch (parent::roleHome()) {
            case 'user':
                $books = Book::where('user_id', $id)->get();
                break;
            case 'clients':
                $books = Book::where('client_id', $id)->get();
                break;
            case 'admin':
                $books = Book::all();
                break;
        }
        $books=(!is_null($books))? $books: [];

        return view('books.index')
            ->with(['books'=>BookResource::collection($books)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    //Normal User Own Book Creation Form
    public function userBookCreate()
    {
        return view('books.owncreate');
    }

    //Normal User Own Book Store into Db
    public function userBookStore(Request $request)
    {
        try {
            //Form serialization used in Ajax form submission
            $input=$request->all();
            $validator = Validator::make($input, Book::$rules);
            if ($validator->fails()) {
                //Ajax method of form submission.
                return $this->sendError('Validation Errors', [$validator->errors()], 201);
            }
            $this->authorization($input);
            $book = Book::create($input);
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage(), [$exception->getMessage()], 201);
        }
        return $this->sendResponse(['id'=>$book->id], 'Book Created Successfully..');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //Form serialization used in Ajax form submission
            $input=$request->all();
            $validator = Validator::make($input, Book::$rules);
            if ($validator->fails()) {
                //Ajax method of form submission.
                return $this->sendError('Validation Errors', [$validator->errors()], 201);
            }
            $this->authorization($input);
            $book = Book::create($input);
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage(), [$exception->getMessage()], 201);
        }
        return $this->sendResponse(['id'=>$book->id], 'Book Created Successfully..');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book=Book::find($id);
        return view('books.show')->with(['book'=>$book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //Book $book
    {
        $book=Book::find($id);
        return view('books.edit')->with(['book'=>$book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Book                $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        try {
            //Form serialization used in Ajax form submission
            $input=$request->except(['_token', '_method', 'book_primary_id']);
            $validator = Validator::make($input, Book::$rules);
            if ($validator->fails()) {
                //Ajax method of form submission.
                return $this->sendError('Validation Errors', [$validator->errors()], 201);
            }
            $this->authorization($input);
            $book = Book::where('id', $request->book_primary_id)
                    ->update($input);
        } catch (CustomException $exception) {
            return $this->sendError('Errors', [$exception->getMessage()], 201);
        }
        return $this->sendResponse(
            ['id'=>$request->book_primary_id],
            'Book Updated Successfully..'
        );
    }

    public function authorization(&$input)
    {
        $uid=Auth::user()->id;
        (Auth::user()->role==1)?$input['admin_id']=$uid:
        ((Auth::user()->role==2)?
            $input['client_id']=$uid:
        ((Auth::user()->role==3)?
            $input['user_id']=$uid: $input['user_id']=$uid));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Book $book,
    {
        $data = Book::find($id)->delete();
        return $this->sendResponse(
            [
            'data'=>'Book Deleted Based on ID $id Successfully..'
            ],
            'Book Deleted Successfully..'
        );
        /*return redirect()->back()->with([
            'success'=> true,
            'message'=>'Book Deleted Successfully..']);*/
        /*
        But we can forcefully include soft deleted models in query results
        using eloquent’s withTrashed() method on the query. Here some operations that
        can be helpful:
        # Include Soft Deleted Models
        $posts = Post::withTrashed()->get();
        # Retrieve only Soft Deleted Models
        For such cases, onlyTrashed() method is used:
        $posts = Post::onlyTrashed()->get();

        # Restore Soft Deleted Models
        To bring back such models to un-deleted state, restore() method can be used:
        Restore all models:
        Post::restore();

        # Permanently Deleting Models
        $post->forceDelete();

        Restore specific models:
        Post::withTrashed()
        ->where('comments', 100)
        ->restore();

        //delete with primary key
        $post = Post::find(1);
        $post->delete();
        //delete with key (primary key)
        Post::destroy(1);
        //delete specific rows
        $deletedRows = Post::where('comments', 0)->delete();*/
    }
}
