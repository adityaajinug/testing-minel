<?php

namespace App\Http\Controllers;

use App\Dtos\BlogDto;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Services\BlogServices;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(public BlogServices $services)
    {
    }
    public function index(Request $request)
    {
        $datas = $this->services->getAll($request);
        return view('admin.blog.index', [
            'datas' => $datas
        ]);
    }
    public function add()
    {
        return view('admin.blog.form', [
            'action' => 'add',
            'blogs' => null
        ]);
    }
    public function store(BlogRequest $request)
    {
        // dd($request->all());
        $this->services->store(
            BlogDto::formRequest($request)
        );
        return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully');
    }
    public function edit(Blog $blog, $uuid)
    {
        // dd($blog::findByUuid($uuid));
        return view('admin.blog.form', [
            'action' => 'edit',
            'blogs' => $blog::findByUuid($uuid)
        ]);
    }
    public function update(BlogRequest $request, Blog $blog, $uuid)
    {
        $this->services->update(
            $blog::findByUuid($uuid),
            BlogDto::formRequest($request)
        );
        return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully');
    }
    public function destroy(Blog $blog, $uuid)
    {
        $this->services->destroy(
            $blog::findByUuid($uuid),
        );
        return redirect()->route('admin.blog.index')->with('success', 'Blog deleted successfully');
    }
}
