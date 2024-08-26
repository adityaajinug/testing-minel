<?php

namespace App\Contracts;

use App\Dtos\BlogDto;
use App\Models\Blog;

interface BlogContract
{
    /**
     * Get all blogs.
     *
     * @return mixed
     */
    public function getAll($request);

    /**
     * Store a new blog.
     *
     * @param BlogDto $dto
     * @return mixed
     */
    public function store(BlogDto $dto);

    /**
     * Update an existing blog.
     *
     * @param Blog $blog
     * @param BlogDto $dto
     * @return mixed
     */
    public function update(Blog $blog, BlogDto $dto);

    /**
     * Delete a blog.
     *
     * @param Blog $blog
     * @return mixed
     */
    public function destroy(Blog $blog);
}
