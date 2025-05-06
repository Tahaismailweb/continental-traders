<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::latest()->get();
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        Vendor::create($request->all());
        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vendor = Vendor::findOrFail($id);
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'contact' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $vendor->update($request->all());
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vendor = Vendor::findOrFail($id);        
        // Delete the vendor        
        $vendor->delete();
        return redirect()->route('vendors.index')->with('success', 'Vendor deleted.');
    
    }
}
