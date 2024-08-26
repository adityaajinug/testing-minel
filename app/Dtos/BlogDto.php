<?php

namespace App\Dtos;

use App\Http\Requests\BlogRequest;

class BlogDto
{
    public function __construct(
        public readonly string $title,
        public readonly string $author,
        public readonly string $description,

    ) {
    }
    public static function formRequest(BlogRequest $request)
    {
        return new self(
            title: $request->validated('title'),
            author: $request->validated('author'),
            description: $request->validated('description'),
        );
    }
}
