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
                    <th>Is Valid?</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($numbers as $number)
                    <tr>
                        <td>{{ $number->id }}</td>
                        <td>{{ $number->custom_id }}</td>
                        <td>{{ $number->number }}</td>
                        <td>{{ $number->country_code }}</td>
                        <td>{{ $number->status }}</td>
                        <td>{{ $number->is_valid }}</td>
{{--                        <td>--}}
{{--                            <a href="{{ route('vat.processing.show', $number) }}" class="btn btn-sm btn-info">View</a>--}}
{{--                        </td>--}}
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

