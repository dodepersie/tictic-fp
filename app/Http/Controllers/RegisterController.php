<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterMerchantRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\RandomPasswordEmail;
use App\Mail\RejectedMerchantEmail;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register-customer', [
            'title' => 'Register',
        ]);
    }

    public function index_merchant()
    {
        return view('auth.register-merchant', [
            'title' => 'Register Merchant',
        ]);
    }

    public function store(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('login');
    }

    public function store_merchant(RegisterMerchantRequest $request)
    {
        $validatedData = $request->validated();
        $randomPassword = Str::random(10);
        $userData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($randomPassword),
            'phone_number' => $validatedData['phone_number'],
            'role' => 'Merchant',
        ];

        $user = User::create($userData);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/merchant_documents', $fileName);
        }

        $merchantData = [
            'user_id' => $user->id,
            'company_description' => $validatedData['company_description'],
            'merchant_document' => $fileName,
        ];

        Merchant::create($merchantData);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Merchant Account Created! You will get your password if Administrator accepts your registration!');
    }

    public function approve_merchant(Merchant $merchant)
    {
        $merchant->merchant_status = 'Approved';
        $merchant->save();

        $user = $merchant->user;
        $randomPassword = Str::random(10);
        $user->password = bcrypt($randomPassword);
        $user->save();

        Mail::to($user->email)->send(new RandomPasswordEmail($randomPassword, $user->name));

        return redirect()->back()->with('success', 'Merchant registration approved!');
    }

    public function reject_merchant(Merchant $merchant)
    {
        $merchant->merchant_status = 'Rejected';
        $merchant->save();

        $user = $merchant->user;
        $randomPassword = Str::random(10);
        $user->password = bcrypt($randomPassword);
        $user->save();

        // If rejected, send email
        Mail::to($user->email)->send(new RejectedMerchantEmail($user->name));

        return redirect()->back()->with('success', 'Merchant registration rejected!');
    }
}
