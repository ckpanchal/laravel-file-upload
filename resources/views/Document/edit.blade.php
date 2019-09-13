@extends('layout')

@section('content')
<div class="title">
  <h1>Edit Document</h1>
</div>
<form action="{{ route('update-document', ['id' => $doc->id]) }}" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ $doc->title }}">
  </div>
  <div class="form-group">
    <label for="file">Choose File:</label>
    <input type="file" class="form-control-file" id="file" name="file">
  </div>
  <div class="form-group">
    <img src="/docs/{{ $doc->file_url }}">
  </div>
  @csrf
  {{-- @method('PUT') --}}
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection