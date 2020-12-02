<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Resources\Authors\AuthorCollectionResource;
use App\Http\Resources\Authors\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->has('per_page') ? $request->get('per_page') : 10;
        $authors = Author::paginate($perPage);
        return $this->sendResponse(AuthorCollectionResource::make($authors));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AuthorRequest $request)
    {
        $uniqueAuthors = Author::where('first_name',$request->get('first_name'))
            ->where('last_name',$request->get('last_name'))
            ->where('birth_date',$request->get('birth_date'))
            ->get()->count();
        if ($uniqueAuthors>0){
            return $this->sendError('The same author is exists in base, you have to user update method');
        }

        $author = Author::create($request->except('Key'));

        return $this->sendResponse(AuthorResource::make($author));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $author = Author::find($id);
        return $this->sendResponse(AuthorResource::make($author));
    }

    /**
     * @param AuthorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AuthorRequest $request,$id)
    {
        $author = Author::find($id);
        $author->fill($request->except('Key'));
        $author->save();

        return $this->sendResponse(AuthorResource::make($author));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $author = Author::find($id);
        $deleted = AuthorResource::make($author);
        if ($author){
            $author->delete($id);
            return $this->sendResponse($deleted,'Author was deleted');
        }
        return  $this->sendError(null,'Author ID not found');

    }

    public function search(Request $request)
    {
        $perPage = $request->has('per_page') ? $request->get('per_page') : 10;

        $authors = Author::when($request->has('first_name'),function ($q) use($request){
            return $q->where('first_name','like',"%{$request->first_name}%");
        })
            ->when($request->has('last_name'),function ($q) use($request){
            return $q->orwhere('last_name','like',"%{$request->last_name}%");
        })->paginate($perPage);

        return $this->sendResponse(AuthorCollectionResource::make($authors));
    }
}


