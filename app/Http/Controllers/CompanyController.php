<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\SaveCompanyRequest;
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
        $companies = Company::paginate(10);

        return view('admin.companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store company to database
     *
     * @param SaveCompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveCompanyRequest $request)
    {
        $company = Company::create($request->all());
        if ($request->logo) {
            $destinationName = $company->id . '_' . $request->logo->getClientOriginalName();
            $request->logo->storeAs('public/logos', $destinationName);
            $company->logo = $destinationName;
            $company->save();
        }

        return redirect()->route('companies.index');
    }

    /**
     * Display form to update company
     *
     * @param Company $company
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', ['company' => $company]);
    }

    /**
     * Update company in the database
     *
     * @param Request $request
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Company $company)
    {
        $company->update($request->all());
        if ($request->logo) {
            $destinationName = $company->id . '_' . $request->logo->getClientOriginalName();
            $request->logo->storeAs('public/logos', $destinationName);
            $company->logo = $destinationName;
            $company->save();
        }

        return redirect()->route('companies.index');
    }

    /**
     * Delete specified company
     *
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Company $company)
    {
        try {
            $company->delete();
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->withErrors('The company could not be deleted because there are employees associated to it.');
        }

        return redirect()->route('companies.index');
    }
}
