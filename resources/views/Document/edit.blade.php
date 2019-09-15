@extends('layout')

@section('content')
<div class="title">
  <h1>Edit Document</h1>
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
    <a href="../../docs/{{ $doc->file_url }}" target="blank">{{ $doc->file_url }}</a> uploaded.
  </div>
  @csrf
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="{{ route('document.index') }}" class="btn btn-danger">Back</a>
</form>
@endsection