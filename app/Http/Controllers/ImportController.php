<?php

namespace App\Http\Controllers;

use App\Imports\CustomerImport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    //
    use Importable;
    public function import()
    {
        Excel::import(new CustomerImport, request()->file('file'));
        return redirect()->back()->with('success','Data Imported Successfully');
    }

    public function store(Request $request)
    {
        if ($request->file('file')){
            $fileName = time().'_'.request()->file->getClientOriginalName();
            $request->file('file')->storeAs('reports', $fileName, 'public');
            $this->import(new CustomerImport)->queue($request->file('file'));
            return redirect()->back()->with('success','Data Imported Successfully');
        }
    }

    public function show(){

        $customers  = Customer::paginate(25);
        return view('welcome', compact('customers'));
    }

    public function showSearchResult(Request $request){
        $query = Customer::query();
        if ($request->filled('branch_id')){
            $query = $query->where('branch_id', $request->branch_id);
        }

        if ($request->filled('gender')){
            $query = $query->where('gender', $request->gender);
        }

        $customers  = $query->paginate(25);
        if ($query){
            $payload = [
                'code' => 200,
                'message' => 'success',
                'data' => $customers,
            ];
            return response()->json($payload, 200);
        }

        $payload = [
            'code' => 500,
            'message' => 'success',
            'data' => [],
        ];
        return response()->json($payload, 200);



    }
}
