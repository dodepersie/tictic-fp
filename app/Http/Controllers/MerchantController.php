<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMerchantRequest;
use App\Http\Requests\UpdateMerchantRequest;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\User;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merchants = Merchant::paginate(8);
        $pending_merchants = Merchant::where('merchant_status', '=', 'Pending')->get();

        $titleSwal = 'Delete Merchant!';
        $text = 'Are you sure you want to delete this merchant? (It will also delete all Events associated with this Merchant)';
        confirmDelete($titleSwal, $text);

        return view('dashboard.merchant.index', [
            'title' => 'Pending Merchants',
            'merchants' => $merchants,
            'pending_merchants' => $pending_merchants,
        ]);
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
        $title = 'Now Editing: '.$merchant->user->name;
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
    public function update(UpdateMerchantRequest $request, Merchant $merchant)
    {
        $merchant->user->update($request->validated());

        return redirect()->route('dashboard_merchants.index')->withSuccess('Merchant updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::where('merchant_id', $id)->delete();
        $user = User::find($id);
        $user->delete();

        return back()->withSuccess('Merchant deleted successfully!');
    }
}
