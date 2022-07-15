<?php

namespace App\Http\Resources\Exceptions;

use App\Http\Resources\CommonResource;

abstract class CommonErrorResource extends CommonResource
{
    /**
     * The "data" wrapper key.
     *
     * @var string
     */
    public static $wrap = 'error';

    /**
     * The error message.
     *
     * @var string
     */
    protected string $message;

    /**
     * The error metadata that should be injected into the response data.
     *
     * @var array
     */
    protected array $metadata;

    /**
     * Create a new resource instance.
     *
     * @param  string  $message
     * @param  int     $httpResponseCode
     * @param  array   $metadata
     */
    public function __construct(string $message, int $httpResponseCode, array $metadata = [])
    {
        $this->httpResponseCode = $httpResponseCode;
        $this->message = $message;
        $this->metadata = $metadata;

        parent::__construct(null);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    {
        return array_merge([
            'message' => $this->message
        ], $this->metadata);
    }
}
