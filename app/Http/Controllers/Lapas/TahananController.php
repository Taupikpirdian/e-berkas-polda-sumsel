<?php

namespace App\Http\Controllers\Lapas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\TahananImport;
use Maatwebsite\Excel\Facades\Excel;

class TahananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lapas.tahanan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function import(Request $request)
    {
        try {
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx',
            ]);
    
            $file = $request->file('file');
    
            Excel::import(new TahananImport, request()->file('file'));
    
            return redirect()->route('tahanan.index')->with(['success' => 'Berhasil melakukan import data']);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            dd($e->failures());
            // return redirect()->back()->withErrors(["msq"=>$e->getMessage()]);
        }
    }
}
