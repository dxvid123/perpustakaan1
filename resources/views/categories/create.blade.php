@extends('layouts.app')

@section('content')

<h3>Tambah Kategori</h3>

<div class="card">
<div class="card-body">

<form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control">
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
</form>

</div>
</div>

@endsection