<?php

namespace App\Http\Controllers;

use App\Http\Requests\SingleValidationVatNumberRequest;
use App\Logic\VatProcessingLogic;

class SingleVatNumberProcessingController extends Controller
{
    public function validate(SingleValidationVatNumberRequest $request, VatProcessingLogic $logic)
    {
        $result = $logic->processSingleVat(
            $request->validated('vat_number'),
            $request->validated('country_code', 'IT') // Default to IT if not provided
        );

        return view('validate',
            [
                'custom_message' => $result['operation'] ?? null,
                'number' => $result['number'],
                'status' => $result['status']
            ]
        );
    }
}
