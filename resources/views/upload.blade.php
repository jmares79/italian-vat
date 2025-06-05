@extends('app')

@section('title', 'Upload file Number')

@section('content')

<div class="container">
    <h1 class="mb-4 text-center">Upload Vat numbers file</h1>

    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <form action="{{ route('vat.processing.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="file" class="form-label">Choose an Excel File (.xlsx or .xls)</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file">
                    @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Upload</button>
                <div class="form-group">
                    <label for="exampleInputEmail1">File must be a CSV file</label>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
</div>

@endsection
