<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{
    public function __construct($resource, $message = null, $status = 200)
    {
        // Define os dados da coleção e as informações adicionais
        parent::__construct($resource);
        $this->message = $message;
        $this->status = $status;
    }

    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->collection->transform(function ($customer) {
                return [
                    'id' => $customer->id,
                    'user_id' => $customer->user_id,
                    'points' => $customer->points,
                    'user' => $customer->user,
                ];
            }),
            'meta' => [
                'total' => $this->collection->count(),
            ],
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->status);
    }
}
