@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Book</h3>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

{{-- SEARCH & FILTER --}}
<form method="GET" class="row mb-4">

    <div class="col-md-4">
        <input type="text" 
               name="search" 
               class="form-control"
               placeholder="Cari Judul..."
               value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="category" class="form-select">
            <option value="">-- Semua Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary">Filter</button>
    </div>

    <div class="col-md-2">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            Reset
        </a>
    </div>

</form>

{{-- TOTAL DATA --}}
<div class="mb-2">
    <strong>Total Buku (sesuai filter):</strong> {{ $totalBooks }}
</div>

<div class="mb-3">
    @foreach($totalPerCategory as $cat)
        <span class="badge bg-secondary">
            {{ $cat->nama_kategori }} : {{ $cat->books_count }}
        </span>
    @endforeach
</div>

{{-- TABLE --}}
<div class="card">
<div class="card-body">

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>

        @forelse($books as $key => $book)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $book->category->nama_kategori ?? '-' }}</td>
            <td>{{ $book->judul }}</td>
            <td>{{ $book->penulis }}</td>
            <td>{{ $book->tahun_terbit }}</td>
            <td>
                <span class="badge bg-info">
                    {{ $book->stok }}
                </span>
            </td>
            <td>
                <a href="{{ route('books.edit',$book->id) }}" 
                   class="btn btn-warning btn-sm">
                   Edit
                </a>

                <form action="{{ route('books.destroy',$book->id) }}" 
                      method="POST" 
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus data?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">
                Tidak ada data ditemukan
            </td>
        </tr>
        @endforelse

    </tbody>
</table>

</div>
</div>

@endsection