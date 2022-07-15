<?php

namespace App\Http\Resources\Exceptions;

class ValidationFailedResource extends CommonErrorResource
{
    /**
     * Create a new resource instance.
     *
     * @param  array  $validationResource
     */
    public function __construct($validationResource = [])
    {
        parent::__construct(
            'Ваши данные не прошли проверку',
            422,
            count($validationResource) ? ['errors' => $validationResource] : []
        );
    }
}
