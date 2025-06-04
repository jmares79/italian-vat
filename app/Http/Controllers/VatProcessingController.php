<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Logic\VatProcessingLogic;
use App\Models\Vat;
use Illuminate\Http\Request;

class VatProcessingController extends Controller
{
    public function __construct(protected readonly VatProcessingLogic $logic) {}

    public function index()
    {
        $numbers = Vat::latest()->paginate(10);

        return view('index', compact('numbers'));
    }

    public function create(Request $request)
    {
        return view('upload');
    }

    public function store(FileUploadRequest $request)
    {
        $this->logic->process($request->file('file'), $request->validated('country_code'));

        // After processing the file, redirect to the index page
        return redirect()->route('vat.processing.index');
    }

    public function show(string $id)
    {
        dump('SHOW');
    }
}
