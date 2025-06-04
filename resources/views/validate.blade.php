<!DOCTYPE html>
<html>
<head>
    <title>Validate Italian VAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">

<div class="bg-white shadow p-4 rounded w-100" style="max-width: 400px;">
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

</body>
</html>
