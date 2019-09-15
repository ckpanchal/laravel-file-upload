@extends('layout')

@section('content')
<div class="title">
  <h1>Add Document</h1>
</div>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
  </div>
  <div class="form-group">
    <label for="file">Choose File:</label>
    <input type="file" class="form-control-file" id="file" name="file">
  </div>
  @csrf
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="{{ route('document.index') }}" class="btn btn-danger">Back</a>
</form>
@endsection