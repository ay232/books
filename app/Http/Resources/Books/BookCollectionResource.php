<?php

namespace App\Http\Resources\Books;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollectionResource extends ResourceCollection
{

    /**
     * @var null
     */
    static $wrap = null;
    /**
     * @var string
     */
    public $collects = 'App\Http\Resources\Books\BookResource';

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'pagination' => [
                'total'        => $this->total(),
                'count'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages'  => $this->lastPage(),
            ],
            'books'      => $this->collection,
        ];
    }
}
