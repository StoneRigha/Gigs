<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //index function show all listing
    public function index(){
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->simplePaginate(4)
        ]);
    }

      //show single listing
      public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing
        ]); 
      }

      //create listing form
      public function create(){
        return view('listings.create');
      }

      //store listing
      public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',

        ]); 

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields );

        return redirect('/')->with('message', 'Listing created succesfully!');
      }

      //edit listing
      public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
      }

      //update listing
      public function update(Request $request, Listing $listing){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required', 
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',

        ]); 

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields );

        return back()->with('message', 'Listing updated succesfully!');
      }

      //delete listing
      public function destroy(Listing $listing){
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted succesfully!');
      }
}
