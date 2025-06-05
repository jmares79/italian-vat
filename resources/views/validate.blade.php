@extends('app')

@section('title', 'Upload file Number')

@section('content')

<div class="bg-white shadow p-4 rounded w-100" style="max-width: 600px; margin: auto;">
    <h2 class="mb-4 text-center">Validate VAT</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (isset($custom_message))
        <div class="alert alert-info">{{ $number }} is {{ $status }}</div>
        <div class="alert alert-info">{{ $custom_message }}</div>
    @endif

    <form method="POST" action="{{ route('vat.processing.validate') }}">
        @csrf
        <div class="mb-3">
            <label for="vat_number" class="form-label">Enter VAT</label>
            <input type="text" name="vat_number" id="vat_number" class="form-control" value="{{ old('vat_number') }}">
        </div>
        <button class="btn btn-primary w-100">Validate</button>
    </form>
</div>

@endsection
