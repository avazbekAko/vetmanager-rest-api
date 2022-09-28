<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
   
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $companies = Company::orderBy('id','desc')->paginate(5);
        return view('companies.index', compact('companies'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('companies.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required',
            'key' => 'required',
        ]);

        $user_id = auth()->id();

        $conn = Company::create([
            "url" => $request->url,
            "key" => $request->key,
            "user_id" => $user_id
            ]
        );
        $user = User::find($user_id);
        $user->id_conn = $conn->id;
        $user->save();
        return redirect()->route('clients-all', $conn->id)->with('success','Your data has been successfully saved.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'url' => 'required',
            'key' => 'required',
        ]);

        $user_id = auth()->id();

        $company->fill(
            [
                'url' => $request->url,
                'key' => $request->key,
                'user_id' => $user_id
            ]
        )->save();
        $user = User::find($user_id);
        $user->id_conn = $company->id;
        $user->save();
        return redirect()->route('clients-all', $company->id)->with('success','Your data has been successfully saved.');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company has been deleted successfully');
    }
}
