<?php

namespace App\Http\Controllers;

use App\Imports\UnitImport;
use App\Models\Unit;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        
    }

    public function store()
    {
        request()->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        $file = request()->file('file');
        if ($file) {
            $data = Excel::toCollection(new UnitImport, $file);
            foreach ($data[0] as $da) {
                if ($da[0] != null) {

                    Unit::create([
                        'course_id' => request()->id,
                        'unit_code' => $da[0],
                        'unit_title' => $da[1],
                        'yearG' => $da[2],
                        'sem' => $da[3],
                    ]);
                }
            }
            return back()->with('message', 'Results recorded successfully.');
        }
        return back()->with('message', 'Please Check your file, Something is wrong there.');
    }

    public function show(Unit $unit)
    {
        //
    }

    public function edit(Unit $unit)
    {
        //
    }

    public function update(Request $request, Unit $unit)
    {
        //
    }

    public function destroy(Unit $unit)
    {
        //
    }
}
