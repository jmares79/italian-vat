<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VAT listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Item List</h2>
        <a href="{{ route('vat.processing.create') }}" class="btn btn-primary">Upload file</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('vat.processing.index') }}" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-auto">
                <select name="status" class="form-select" aria-label="Default select example" onchange="this.form.submit()">>
                    <option selected>Filter by Status</option>
                    <option value="">All</option>
                    <option value="valid" {{ request('status') === 'valid' ? 'selected' : '' }}>Valid</option>
                    <option value="invalid" {{ request('status') === 'invalid' ? 'selected' : '' }}>Invalid</option>
                    <option value="fixed" {{ request('status') === 'fixed' ? 'selected' : '' }}>Fixed</option>
                </select>
            </div>
            <noscript><div class="col-auto"><button class="btn btn-primary">Filter</button></div></noscript>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Custom Id</th>
                    <th>VAT Number</th>
                    <th>VAT Country</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($numbers as $number)
                    <tr>
                        <td>{{ $number->id }}</td>
                        <td>{{ $number->custom_id }}</td>
                        <td>{{ $number->number }}</td>
                        <td>{{ $number->country_code }}</td>
                        <td>{{ ucfirst($number->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No items found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $numbers->links() }}
    </div>
</div>

</body>
</html>

