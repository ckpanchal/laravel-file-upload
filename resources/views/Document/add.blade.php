@extends('layout')

@section('content')
<div class="title">
  <h1>Add Document</h1>
</div>
<form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
  <div class="form-group">
    <label for="file">Choose File:</label>
    <input type="file" class="form-control-file" id="file" name="file">
  </div>
  @csrf
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection