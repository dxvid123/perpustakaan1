@extends('layouts.app')

@section('content')

<h3>Edit Kategori</h3>

<div class="card">
<div class="card-body">

<form action="{{ route('categories.update',$category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" 
               value="{{ $category->nama_kategori }}" 
               class="form-control">
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
</form>

</div>
</div>

@endsection