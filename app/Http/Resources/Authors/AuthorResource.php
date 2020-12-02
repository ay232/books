<?php

namespace App\Http\Resources\Authors;

use App\Http\Resources\Books\BookCollectionResource;
use App\Http\Resources\Books\BookResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'id'          => $this->id,
            'first_name'  => $this->first_name,
            'second_name' => $this->second_name,
            'last_name'   => $this->last_name,
            'birth_date'  => $this->birth_date,
            'death_date'  => $this->death_date,
            'books_count' => $this->books->count(),
            'books'       => $this->when(
                ($request->route()->getName() == "authors.list") or
                ($request->route()->getName() == "authors.show"),
                BookResource::collection($this->books)),
        ];
    }
}
