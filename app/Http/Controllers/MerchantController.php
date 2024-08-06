<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMerchantRequest;
use App\Http\Requests\UpdateMerchantRequest;
use App\Models\Merchant;
use App\Models\User;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMerchantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Merchant $merchant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Merchant $merchant)
    {
        $this->authorize('admin');

        $title =  'Now Editing: ' . $merchant->user->name;
        $selected_merchant = $merchant->user;

        return view('dashboard.merchant.edit', [
            'merchant' => $merchant,
            'selected_merchant' => $selected_merchant,
            'title' => $title,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMerchantRequest $request, Merchant $merchant, User $user)
    {
        $this->authorize('admin');
        
        // Update merchant attributes
        $merchant->user->update($request->validated());

        // Redirect or return a response
        return redirect()->route('dashboard.merchant_all')->with('success', 'Merchant updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('admin');

        $user = User::find($id);
        $user->delete();

        return back()->with('success', 'Merchant deleted successfully!');
    }
}
