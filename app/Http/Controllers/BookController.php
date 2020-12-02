<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\Authors\AuthorResource;
use App\Http\Resources\Books\BookCollectionResource;
use App\Http\Resources\Books\BookResource;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->has('per_page') ? $request->get('per_page') : 10;
        $books = Book::paginate($perPage);
        return $this->sendResponse(BookCollectionResource::make($books));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(BookRequest $request)
    {
        $data = $this->filterRequest($request);
        $book = Book::create($data);
        return $this->sendResponse(BookResource::make($book));
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if ($book) {
            return $this->sendResponse(BookResource::make($book));
        } else {
            return $this->sendError(null, 'No such book');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $book)
    {
        $data = $this->filterRequest($request);
        $book = Book::fill($data);
        $book->save();
        return $this->sendResponse(BookResource::make($book));

    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $book = Book::find($id);
        $deleted = BookResource::make($book);
        if ($book) {
            $book->delete($id);
            return $this->sendResponse($deleted, 'Book was deleted');
        }
        return $this->sendError(null, 'Book ID not found');
    }

    private function filterRequest($request)
    {
        return $request->only(['id', 'name', 'description', 'published_at']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $perPage = $request->has('per_page') ? $request->get('per_page') : 10;

        $books = Book::when($request->has('name'), function ($q) use ($request) {
            return $q->where('name', 'like', "%{$request->name}%");
        })
            ->when($request->has('description'), function ($q) use ($request) {
                return $q->orwhere('description', 'like', "%{$request->description}%");
            })->paginate($perPage);

        return $this->sendResponse(BookCollectionResource::make($books));
    }
}
