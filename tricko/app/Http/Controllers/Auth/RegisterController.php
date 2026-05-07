<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ItemInBasket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // transfer items to basket
        $basket = session('basket', []);

        foreach ($basket as $item) {
            ItemInBasket::create([
                'user_id' => $user->id,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        // clear session data
        session()->forget('basket');
        session()->forget('delivery');
        session()->forget('payment');

        Auth::login($user);

        return redirect('/');
    }
}
