<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Students extends ResourceCollection
{

    public $collects = Student::class;

    // Formato ao serializar os dados
    public $casts = [
        'birth' => 'date:d/m/Y',
        'created_at' => 'date:d/m/Y'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => 'treinaweb'
            ]
        ];
    }
}
