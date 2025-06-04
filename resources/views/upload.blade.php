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

    @if (!empty($data))
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-success text-white">
                <strong>Uploaded File:</strong> {{ $data['filename'] }}
            </div>
            <div class="card-body">
                <p><strong>Stored Path:</strong> {{ $data['stored_path'] }}</p>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                        <tr>
                            @foreach ($data['headers'] as $header)
                                <th>{{ $header }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['rows'] as $row)
                            <tr>
                                @foreach ($row as $cell)
                                    <td>{{ $cell }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

</body>
</html>
