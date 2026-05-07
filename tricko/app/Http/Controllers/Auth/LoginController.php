<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ItemInBasket;

class LoginController extends Controller
{
    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // transfer items to basket
            $basket = session('basket', []);

            foreach ($basket as $item) {
                            
                $existingItem = ItemInBasket::where('user_id', auth()->id())
                    ->where('item_id', $item['item_id'])
                    ->first();

                // if item is already in the db -> update quantity
                if ($existingItem) {
                    $existingItem->quantity += $item['quantity'];
                    $existingItem->save();
                } 
                // else -> create a new record 
                else {
                    ItemInBasket::create([
                        'user_id' => auth()->id(),
                        'item_id' => $item['item_id'],
                        'quantity' => $item['quantity'],
                    ]);
                }
            }

            // clear session data
            session()->forget('basket');
            session()->forget('delivery');
            session()->forget('payment');

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/login');
    }

}
