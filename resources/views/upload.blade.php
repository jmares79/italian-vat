<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Excel File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

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

    <form method="POST" action="{{ route('vat.processing.single') }}" class="mb-4">
        @csrf
        <div class="row g-2 align-items-end">
            <div class="col-auto">
                <label for="text_input" class="form-label">Enter Code</label>
                <input type="text" name="text_input" id="text_input" class="form-control" required>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary">Validate</button>
            </div>
        </div>
    </form>
</div>

</body>
</html>
