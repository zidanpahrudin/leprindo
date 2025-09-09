<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Tampilkan semua salary.
     */
    public function index()
    {
        $salaries = Salary::with('history')->get();
        return response()->json($salaries);
    }

    public function show(Salary $salary)
    {
        $salary->load('history');
        return response()->json($salary);
    }


    /**
     * Simpan salary baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'biodata_id'          => 'required|string|max:25',
            'company_id'          => 'required|string|max:25',
            'company_name'        => 'required|string|max:25',
            'dept_name'           => 'required|string|max:25',
            'basic_salary'        => 'required|integer',
            'healthy_allowance'   => 'required|integer',
            'positional_allowance'=> 'required|integer',
            'pic_input'           => 'required|string|max:25',
            'input_time'          => 'required|date',
        ]);

        $salary = Salary::create($request->all());

        return response()->json([
            'message' => 'Data salary berhasil dibuat',
            'data'    => $salary
        ], 201);
    }


    /**
     * Update salary.
     */
    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'company_name'        => 'sometimes|required|string|max:25',
            'dept_name'           => 'sometimes|required|string|max:25',
            'basic_salary'        => 'sometimes|required|integer',
            'healthy_allowance'   => 'sometimes|required|integer',
            'positional_allowance'=> 'sometimes|required|integer',
            'pic_edit'            => 'sometimes|required|string|max:25',
            'edit_time'           => 'sometimes|required|date',
        ]);

        $salary->update($request->all());

        return response()->json([
            'message' => 'Data salary berhasil diupdate',
            'data'    => $salary
        ]);
    }

    /**
     * Hapus salary.
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();

        return response()->json([
            'message' => 'Data salary berhasil dihapus'
        ]);
    }
}
