@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
          <h5 class="card-header">{{ $action === "add" ? 'Add Data' : 'Edit' }}</h5>
          <form method="POST" action="{{ $action === 'add' ? route('admin.blog.store') : route('admin.blog.update', ['uuid' => $blogs->uuid]) }}">
            @if ($action === 'edit')
              @method('PUT')
            @endif
            @csrf

            <div class="card-body demo-vertical-spacing demo-only-element">
               <div class="form-group">
                    <label class="form-label" for="title">Title</label>
                    <div class="input-group input-group-merge">
                    <input
                        type="text"
                        class="form-control"
                        id="title"
                        name="title"
                        placeholder="Title"
                        value="{{ old('title', $blogs->title ?? '') }}"
                    />
                    </div>
               </div>
               <div class="form-group">
                    <label class="form-label" for="author">Author</label>
                    <div class="input-group input-group-merge">
                    <input
                        type="text"
                        class="form-control"
                        id="author"
                        name="author"
                        placeholder="Author"
                        value="{{ old('author', $blogs->author ?? '') }}"
                    />
                    </div>
               </div>
    
               <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <div class="input-group input-group-merge">
                  <textarea class="form-control" id="description" name="description" aria-label="With textarea" placeholder="Description">{{ old('description', $blogs->description ?? '') }}</textarea>
                </div>
               </div>

              </div>
              <div class="form-group px-4 py-2">
                <button type="submit" class="btn btn-dark">{{ $action === 'add' ? "Submit" : "Update" }}</button>
              </div>
          </form>
        </div>
      </div>
</div>
@endsection
