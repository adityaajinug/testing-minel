<?php

namespace App\Services;

use App\Contracts\BlogContract;
use App\Dtos\BlogDto;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BlogServices implements BlogContract
{
    public function getAll($request)
    {
        // TODO: Implement getAll() method.
        $search = $request->search;
        $blogs = Blog::query()
            ->when($search, function (Builder $query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
                $query->orWhere('author', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return $blogs;
    }
    public function store(BlogDto $dto): Blog
    {
        // TODO: Implement store() method.
        return Blog::create([
            'title' => $dto->title,
            'author' => $dto->author,
            'slug' => Str::slug($dto->title),
            'description' => $dto->description,
        ]);
    }
    public function update(Blog $blog, BlogDto $dto)
    {
        // TODO: Implement update() method.
        return $blog->update([
            'title' => $dto->title,
            'author' => $dto->author,
            'slug' => Str::slug($dto->title),
            'description' => $dto->description,
        ]);
    }
    public function destroy(Blog $blog)
    {
        // TODO: Implement delete() method.
        return $blog->delete();
    }
}
