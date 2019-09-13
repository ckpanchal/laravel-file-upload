@extends('layout')

@section('content')
<div class="control-btn float-right">
  <a href="{{ route('document.create') }}" class="btn btn-primary">Add File</a>
</div>
<div class="title">
  <h1>Documents</h1>
</div>
@if (session('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
@endif
@if (session('error'))
  <div class="alert alert-danger" role="alert">
    {{ session('error') }}
  </div>
@endif
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Title</th>
      <th>File Path</th>
      <th>Actions</th>
    </tr>
  </thead>
    <tbody>
      @forelse ($docs as $doc)
      <tr>
        <td>{{ $doc->title }}</td>
        <td>{{ $doc->file_url }}</td>
        <td>
          <div class="action_btn">
            <div class="action_btn">
              <a href="{{ route('document.edit', $doc->id)}}" class="btn btn-warning btn-sm">Edit</a>
            </div>
            <div class="action_btn margin-left-10">
              <form action="{{ route('document.destroy', $doc->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
              </form>
            </div>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="3">
          <center>
            No data found
          </center>
        </td>
      </tr>
      @endforelse
  </tbody>
</table>
@endsection