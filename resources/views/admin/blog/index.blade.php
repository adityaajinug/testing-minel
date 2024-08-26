@extends('layouts.template')
@section('content')
   <!-- Bordered Table -->
   <div class="card">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="d-flex justify-content-between p-4">
      <form method="GET" action="{{ route('admin.blog.index') }}">
        <div class="input-group input-group-merge">
          <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
          <input
            type="text"
             name="search"
            class="form-control"
            placeholder="Search..."
            aria-label="Search..."
            aria-describedby="basic-addon-search31"
            style="width: fit-content" value="{{ request()->search }}"
          />
        </div>
      </form>
      <a href="{{ route('admin.blog.add') }}" class="btn btn-dark">Add</a>
    </div>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Author</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($datas as $index => $data)
            <tr>
                <td>{{ $loop->iteration + ($datas->currentPage() - 1) * $datas->perPage() }}</td>
                <td><strong>{{ $data->title }}</strong></td>
                <td>{{ $data->author }}</td>
                <td>
                  <a href="{{ route('admin.blog.edit', $data->uuid) }}" class="btn btn-primary">Edit</a>
                  <form action="{{ route('admin.blog.destroy', $data->uuid) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</button>
                </form>
                  {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-uuid="{{ $data->uuid }}">
                    Delete
                </button> --}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No Data Found</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <!-- Custom Pagination -->
      <div class="d-flex justify-content-center mt-3">
        <x-pagination :datas="$datas"></x-pagination>
      </div>
      <!--/ Custom Pagination -->
    </div>
  </div>
  <!--/ Bordered Table -->

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              Are you sure you want to delete this blog?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form id="deleteForm" method="POST" action="">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
              </form>
          </div>
      </div>
  </div>
</div>

@endsection
@push('js')
    <script>
       let deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = event.relatedTarget;
        // Extract UUID from data-* attributes
        let uuid = button.getAttribute('data-uuid');
        // Construct the form action URL
        let form = document.getElementById('deleteForm');
        form.action =  route('admin.blog.destroy', uuid);
    });
  </script>
@endpush
