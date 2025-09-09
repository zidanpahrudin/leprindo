<?php

namespace App\Http\Controllers;

use App\Models\SalaryHistory;
use Illuminate\Http\Request;

class SalaryHistoryController extends Controller
{
    public function index()
    {
        return response()->json(SalaryHistory::with('salaries')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'biodata_id' => 'required|string|max:25',
            'old_value'  => 'required|numeric',
            'new_value'  => 'required|numeric',
            'effect_date'=> 'required|date',
            'pic_input'  => 'required|string|max:25',
            'input_time' => 'required|date',
        ]);

        $history = SalaryHistory::create($request->all());

        return response()->json([
            'message' => 'Salary history berhasil dibuat',
            'data'    => $history
        ], 201);
    }

    public function show(SalaryHistory $salaryHistory)
    {
        $salaryHistory->load('salaries');
        return response()->json($salaryHistory);
    }

    public function update(Request $request, SalaryHistory $salaryHistory)
    {
        $request->validate([
            'old_value'   => 'sometimes|required|numeric',
            'new_value'   => 'sometimes|required|numeric',
            'effect_date' => 'sometimes|required|date',
        ]);

        $salaryHistory->update($request->all());

        return response()->json([
            'message' => 'Salary history berhasil diupdate',
            'data'    => $salaryHistory
        ]);
    }

    public function destroy(SalaryHistory $salaryHistory)
    {
        $salaryHistory->delete();

        return response()->json([
            'message' => 'Salary history berhasil dihapus'
        ]);
    }
}
