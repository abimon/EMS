<?php

namespace App\Http\Controllers;

use App\Imports\UnitImport;
use App\Models\SemUnits;
use App\Models\Unit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class semUnitsController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        request()->validate([
            'units' => 'required|mimes:xlsx,xls',
        ]);
        $file = request()->file('units');
        if ($file) {
            $data = Excel::toCollection(new UnitImport, $file);
            foreach ($data[0] as $da) {
                if ($da[0] != null) {
                    $unit_id=(Unit::where('unit_code',$da[0])->first())->id;
                    SemUnits::create([
                        'sem_id'=>request()->sem_id,
                        'unit_id' => $unit_id,
                        'year' => $da[1],
                    ]);
                }
            }
            return back()->with('message', 'Units uploaded successfully.');
        }
        return back()->with('message', 'Please Check your file, Something is wrong there.');
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
