<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CompaniesController extends Controller
{
    public function __invoke($value='')
    {
        dd("here");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
            // dump(Auth::User()->id);
            $companies = Company::where('user_id',Auth::User()->id)->get();
            return view('pages.companies.index',compact('companies'));
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.companies.create'); 
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
        if(Auth::check())
        {
            $company = Company::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'user_id' => Auth::user()->id
            ]); 
            // 
            if($company){
                return redirect()->route('companies.show', ['company'=> $company->id])
                ->with('success' , 'Company created successfully');
            }
        }
        return back()->withInput()->with('errors', 'Error creating new company');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {

        //
        $company = Company::find($company->id);
        // dd($company->projects);
        // dd($company->users);
        // dd('kk');
        return view('pages.companies.show',compact('company')); //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(company $company)
    {
        //
        $company = Company::find($company->id);
        return view('pages.companies.edit',compact('company')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, company $company)
    {
        // dd($request);
        $companyUpdate = Company::where('id',$company->id)
                            ->update([
                                'name' => $request->name,
                                'description' => $request->description
                            ]);
        if($companyUpdate)
        {
            return redirect()->action('CompaniesController@show',['company' => $company->id])->with('success','Updated Successfully!');
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(company $company)
    {
        //
        $findcompany = Company::find($company->id);
        if($findcompany->delete())
        {
            return redirect()->action('CompaniesController@index')->with('success','Company deleted Successfully!');
        }

        return back()->withInput()->with('error','Company could not be deleted.');
    }
}
