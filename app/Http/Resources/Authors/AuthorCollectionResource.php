<?php

namespace App\Http\Resources\Authors;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollectionResource extends ResourceCollection
{
    /**
     * @var null
     */
    static $wrap = null;
    /**
     * @var string
     */
    public $collects = 'App\Http\Resources\Authors\AuthorResource';

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'authors'    => $this->collection,
                'pagination' => [
                    'total'        => $this->total(),
                    'count'        => $this->count(),
                    'per_page'     => $this->perPage(),
                    'current_page' => $this->currentPage(),
                    'total_pages'  => $this->lastPage(),
                ],
            ];
    }
}
