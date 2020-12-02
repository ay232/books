<?php

namespace App\Http\Resources\Books;

use App\Http\Resources\Authors\AuthorCollectionResource;
use App\Http\Resources\Authors\AuthorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'published_at'  => $this->published_at,
            'authors'       => $this->when(
                ($request->route()->getName() == 'books.list') or
                        ($request->route()->getName() == 'books.show') or
                        ($request->route()->getName() == 'books.search'),
                                AuthorResource::collection($this->authors)),
            'authors_count' => $this->authors->count(),
        ];
    }
}
