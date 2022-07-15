<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class CommonCollection extends ResourceCollection
{
    /**
     * The response code.
     *
     * @var int
     */
    protected int $httpResponseCode;

    /**
     * The "data" wrapper key.
     *
     * @var string
     */
    public static $wrap = 'data';

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     */
    public function __construct(mixed $resource = null)
    {
        parent::__construct($resource);
    }

    /**
     * Set status code into the response data.
     *
     * @param  Request  $request
     * @return array
     */
    public function with($request): array
    {
        return [
            'code' => $this->getStatusCode(),
        ];
    }

    /**
     * Set status code as HTTP status code.
     *
     * @param  Request       $request
     * @param  JsonResponse  $response
     * @return void
     */
    public function withResponse($request, $response): void
    {
        $response->setStatusCode($this->getStatusCode());
    }

    /**
     * Get applied status code.
     *
     * @return int
     */
    private function getStatusCode(): int
    {
        return $this->httpResponseCode ?? 200;
    }
}
