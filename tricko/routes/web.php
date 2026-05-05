<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Product;
use App\Models\ItemInBasket;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use App\Models\Order;
use App\Models\ItemInOrder;
use App\Models\Size;

// TODO: debug
Route::get('/test', function () {
    dd(session()->all());
});


Route::get('/', function () {
    $products = Product::all();
    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();

    return view('index', compact('products', 'recommendedProducts'));
});

Route::get('/search_results', function () {
    $q = request('q');

    $products = Product::with('sizes')
        ->when($q, function ($query) use ($q) {
            $query->where(function ($subQuery) use ($q) {
                $subQuery->where('name', 'ILIKE', "%{$q}%")
                    ->orWhere('description', 'ILIKE', "%{$q}%")
                    ->orWhere('category', 'ILIKE', "%{$q}%")
                    ->orWhere('color', 'ILIKE', "%{$q}%");
            });
        })
        ->paginate(6)
        ->appends(request()->query());

    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();

    return view('search_results', compact('products', 'q', 'recommendedProducts'));
});

Route::get('/product_detail/{id}', function ($id) {
    $product = Product::with('sizes')->findOrFail($id);
    $recommendedProducts = Product::where('id', '!=', $id)->inRandomOrder()->limit(4)->get();

    return view('product_detail', compact('product', 'recommendedProducts'));
});

Route::post('/basket/add', function (Request $request) {
    // Check if item is provided
    $request->validate([
        'item_id' => 'required|exists:sizes,id',
    ]);

    // Authanticated user
    if (auth()->check()) {
        // Find item in basket if it is already in it
        $existingItem = ItemInBasket::where('user_id', auth()->id())
            ->where('item_id', $request->item_id)
            ->first();

        // If item is already in the basket -> increase quantity by 1
        if ($existingItem) {
            $existingItem->quantity += 1;
            $existingItem->save();
        } 
        // If item is not in the basket add item to the basket
        else {
            ItemInBasket::create([
                'user_id' => auth()->id(),
                'item_id' => $request->item_id,
                'quantity' => 1,
            ]);
        }
    }
    // Guest user
    else {
        $basket = session('basket', []);

        // Find item in basket if it is already in it
        $found = false;
        foreach ($basket as $index => $item_in_basket) {
            // If item is already in the basket -> increase quantity by 1
            if ($item_in_basket['item_id'] == $request->item_id) {
                $basket[$index]['quantity']++;
                $found = true;
                break;
            }
        }

        // If item is not in the basket add item to the basket
        if (!$found) {
            $basket[] = [
                'item_id' => $request->item_id,
                'quantity' => 1,
            ];
        }

        // Save the changes to the session
        session(['basket' => $basket]);

    }

    return redirect()->back();
})->name('basket.add');

Route::post('/basket/increase/{id}', function ($id) {

    // Logged in user
    if (auth()->check()) {
        $item = ItemInBasket::where('user_id', auth()->id())->findOrFail($id);
        $item->quantity += 1;
        $item->save();
    } 
    // Guest
    else {
        $basket = session('basket', []);

        // Find item in basket
        foreach ($basket as $index => $item_in_basket) {
            // when found -> increase quantity by 1
            if ($item_in_basket['item_id'] == $id) {
                $basket[$index]['quantity']++;
                break;
            }
        }

        // Save the changes to the session
        session(['basket' => $basket]);

    }

    return redirect()->back();

})->name('basket.increase');

Route::post('/basket/decrease/{id}', function ($id) {    

    // Logged in user
    if (auth()->check()) {
        $item = ItemInBasket::where('user_id', auth()->id())->findOrFail($id);

        if ($item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        } else {
            $item->delete();
        }
    }
    // Guest
    else {
        $basket = session('basket', []);

        // Find item in basket
        foreach ($basket as $index => $item_in_basket) {
            // when found -> decrease quantity by 1 or delete
            if ($item_in_basket['item_id'] == $id) {

                if ($item_in_basket['quantity'] > 1) {
                    // decrease quantity
                    $basket[$index]['quantity']--;
                }
                else {
                    // delete item
                    unset($basket[$index]);
                }
                
                break;
            }
        }

        // Save the changes to the session
        session(['basket' => $basket]);
    }

    return redirect()->back();

})->name('basket.decrease');

Route::post('/basket/remove/{id}', function ($id) {

    // Logged in user
    if (auth()->check()) {
        $item = ItemInBasket::where('user_id', auth()->id())->findOrFail($id);
        $item->delete();
    } 
    // Guest
    else {
        $basket = session('basket', []);

        // Find item in basket
        foreach ($basket as $index => $item_in_basket) {
            // when found -> delete item
            if ($item_in_basket['item_id'] == $id) {
                unset($basket[$index]);                
                break;
            }
        }

        // Save the changes to the session
        session(['basket' => $basket]);
    }

    return redirect()->back();
})->name('basket.remove');

Route::post('/basket/step1', function (Request $request) {

    // Check payment and delivery types are selected
    $request->validate([
        'payment' => 'required',
        'delivery' => 'required',
    ]);

    // Logged in user
    if (auth()->check()) {

        // If there are no saved methods create them
        if (auth()->user()->delivery_method_id == null && auth()->user()->payment_method_id == null) {
            // Create new payment method
            $payment = PaymentMethod::create([
                'type' => $request->payment,
            ]);

            // Create new delivery method
            $delivery = DeliveryMethod::create([
                'type' => $request->delivery,
            ]);

            // Attach to logged-in user
            if (auth()->check()) {
                $user = auth()->user();

                $user->payment_method_id = $payment->id;
                $user->delivery_method_id = $delivery->id;
                $user->save();
            }    
        }
        // If there are saved methods update existing ones instead of creating new ones
        else {
            // Get payment method of logged in user
            $paymentMethod = auth()->user()->paymentMethod;

            // Update the payment method
            if ($paymentMethod) {
                $paymentMethod->update([
                    'type' => $request->payment,
                ]);
            }

            // Get delivery method of logged in user
            $deliveryMethod = auth()->user()->deliveryMethod;

            // Update the delivery method
            if ($deliveryMethod) {
                $deliveryMethod->update([
                    'type' => $request->delivery,
                ]);
            }
        }
    }
    // Guest
    else {
        $delivery = session('delivery', []);
        $payment = session('payment', []);
    
        $payment['type'] = $request->payment;
        session(['payment' => $payment]);

        $delivery['type'] = $request->delivery;
        session(['delivery' => $delivery]);
    }

    return redirect('/basket/basket_address');

})->name('basket.step1.store');

Route::post('/basket/step2', function (Request $request) {

    // Check all address fields are filled
    $request->validate([
        'country' => 'required',
        'city' => 'required',
        'postal_code' => 'required',
        'address' => 'required',
        'phone_number' => 'required',
    ]);

    // Logged in user
    if (auth()->check()) {
        // Get delivery method of logged in user
        $deliveryMethod = auth()->user()->deliveryMethod;

        // Update the delivary method to include all the fields
        if ($deliveryMethod) {
            $deliveryMethod->update([
                'country' => $request->country,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
            ]);
        }


    } 
    // Guest
    else {
        $delivery = session('delivery', []);

        $delivery['country'] = $request->country;
        $delivery['city'] = $request->city;
        $delivery['postal_code'] = $request->postal_code;
        $delivery['address'] = $request->address;
        $delivery['phone_number'] = $request->phone_number;

        session(['delivery' => $delivery]);
    }

    return redirect('/basket/basket_payment_details');

})->name('basket.step2.store');

Route::post('/basket/step3', function (Request $request) {

    // Check all payment fields are filled
    $request->validate([
        'card_number' => 'required',
        'expiration_date_month' => 'required',
        'expiration_date_year' => 'required',
        'cvv' => 'required',
    ]);

    // Logged in user
    if (auth()->check()) {
        // Get payment method of logged in user
        $paymentMethod = auth()->user()->paymentMethod;

        // Update the payment method to include all the fields
        if ($paymentMethod) {
            $paymentMethod->update([
                'card_number' => $request->card_number,
                'expiration_date_month' => $request->expiration_date_month,
                'expiration_date_year' => $request->expiration_date_year,
                'cvv' => $request->cvv,
            ]);
        }

        // RECORD ORDER

        // copy saved payment method for record
        $payment = PaymentMethod::create([
            'type' => $paymentMethod->type,
            'card_number' => $paymentMethod->card_number, 
            'expiration_date_month' => $paymentMethod->expiration_date_month,
            'expiration_date_year' => $paymentMethod->expiration_date_year,
            'cvv' => $paymentMethod->cvv,
        ]);

        // copy saved delivery method for record
        $deliveryMethod = auth()->user()->deliveryMethod;
        $delivery = DeliveryMethod::create([
            'type' => $deliveryMethod->type,
            'country' => $deliveryMethod->country,
            'city' => $deliveryMethod->city,
            'postal_code' => $deliveryMethod->postal_code,
            'address' => $deliveryMethod->address,
            'phone_number' => $deliveryMethod->phone_number,
        ]);

        // create an order record
        $user = auth()->user();
        $ItemsInBasket = $user->itemsInBasket; 
        
        $price = 0;
        foreach ($ItemsInBasket as $item) {
            $price += $item->size->product->price * $item->quantity;
        }

        $order = Order::create([
            'user_id' => $user->id,
            'delivery_method_id' => $delivery->id,
            'payment_method_id' => $payment->id,
            'price' => $price,
        ]);

        foreach ($ItemsInBasket as $item) {
            $item_in_order = ItemInOrder::create([
                'order_id' => $order->id,
                'item_id' => $item->size->id,
                'quantity' => $item->quantity,
                
            ]);
        }

        // clear basket
        ItemInBasket::where('user_id', auth()->id())->delete();
    }
    // Guest
    else {
        // Update payment method
        $payment = session('payment', []);

        $payment['card_number'] = $request->card_number;
        $payment['expiration_date_month'] = $request->expiration_date_month;
        $payment['expiration_date_year'] = $request->expiration_date_year;
        $payment['cvv'] = $request->cvv;

        session(['payment' => $payment]);

        // RECORD ORDER

        // copy saved payment method for record
        $payment_db_record = PaymentMethod::create([
            'type' => $payment['type'],
            'card_number' => $payment['card_number'], 
            'expiration_date_month' => $payment['expiration_date_month'],
            'expiration_date_year' => $payment['expiration_date_year'],
            'cvv' => $payment['cvv'],
        ]);

        // copy saved delivery method for record
        $delivery = session('delivery', []);
        $delivery_db_record = DeliveryMethod::create([
            'type' => $delivery['type'],
            'country' => $delivery['country'],
            'city' => $delivery['city'],
            'postal_code' => $delivery['postal_code'],
            'address' => $delivery['address'],
            'phone_number' => $delivery['phone_number'],
        ]);

        // create an order record
        $basket = session('basket', []); 
        $price = 0;

        foreach ($basket as $item) {
            $price += Size::where('id', $item['item_id'])->first()->product->price * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => null,
            'delivery_method_id' => $delivery_db_record->id,
            'payment_method_id' => $payment_db_record->id,
            'price' => $price,
        ]);

        foreach ($basket as $item) {
            $item_in_order = ItemInOrder::create([
                'order_id' => $order->id,
                'item_id' => Size::where('id', $item['item_id'])->first()->id,
                'quantity' => $item['quantity'],        
            ]);
        }

        // clear basket
        session()->forget('basket');
    }

    return redirect('/basket/basket_thank_you');

})->name('basket.step3.store');


// AUTH
Route::middleware('guest')->group(function () {
    Route::get('/auth/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/auth/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/auth/login', [LoginController::class, 'login'])->name('login');
});

Route::post('/auth/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

function categoryProducts($category)
{
    $query = Product::with('sizes')->where('category', $category);

    if (request('color')) {
        $query->where('color', request('color'));
    }

    if (request('size')) {
        $query->whereHas('sizes', function ($q) {
            $q->where('size', request('size'));
        });
    }

    if (request('price_min')) {
        $query->where('price', '>=', request('price_min'));
    }

    if (request('price_max')) {
        $query->where('price', '<=', request('price_max'));
    }

    if (request('sort') === 'asc') {
        $query->orderBy('price', 'asc');
    } elseif (request('sort') === 'desc') {
        $query->orderBy('price', 'desc');
    }

    return $query->paginate(6)->appends(request()->query());
}

// CATEGORY PAGES
Route::get('/tricka', function () {
    $products = categoryProducts('Tricka');
    $recommendedProducts = Product::where('category', '!=', 'Tricka')->inRandomOrder()->limit(4)->get();

    return view('category_pages/category(Tricka)', compact('products', 'recommendedProducts'));
});

Route::get('/mikiny', function () {
    $products = categoryProducts('Mikiny');
    $recommendedProducts = Product::where('category', '!=', 'Mikiny')->inRandomOrder()->limit(4)->get();

    return view('category_pages/category(Mikiny)', compact('products', 'recommendedProducts'));
});

Route::get('/ciapky', function () {
    $products = categoryProducts('Ciapky');
    $recommendedProducts = Product::where('category', '!=', 'Ciapky')->inRandomOrder()->limit(4)->get();

    return view('category_pages/category(Ciapky)', compact('products', 'recommendedProducts'));
});

// staré URL nech ešte stále fungujú
Route::get('/category_pages/category(Tricka)', function () {
    return redirect('/tricka');
});

Route::get('/category_pages/category(Mikiny)', function () {
    return redirect('/mikiny');
});

Route::get('/category_pages/category(Ciapky)', function () {
    return redirect('/ciapky');
});

// BASKET
Route::get('/basket', function () {

    // Logged in user
    if (auth()->check()) {
        // Get basket items from DB
        $basketItems = ItemInBasket::with('size.product')
            ->where('user_id', auth()->id())
            ->get();

        $total = $basketItems->sum(function ($item) {
            return $item->size->product->price * $item->quantity;
        });
    }
    // Guest
    else {
        $basket = session('basket', []);

        $basketItems = collect();
        $total = 0;

        foreach ($basket as $item) {

            $size = Size::with('product')->find($item['item_id']);

            // attach quantity dynamically
            $size->quantity = $item['quantity'];

            $basketItems->push((object)[
                'size' => $size,
                'quantity' => $item['quantity'],
                'id' => $item['item_id'], // the same as size->id but added here for consistancy in blade
            ]);

            $total += $size->product->price * $item['quantity'];
        }
    }

    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();

    return view('basket.basket', compact('basketItems', 'total', 'recommendedProducts'));
});

Route::get('/basket/basket_delivery_and_payment', function () {
    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();

    // Logged in user
    if (auth()->check()) {        
        $deliveryMethod = auth()->user()->deliveryMethod;
        $paymentMethod = auth()->user()->paymentMethod;
    } 
    // Guest
    else {
        $delivery = session('delivery', []);
        $deliveryMethod = (object)[
            'type' => $delivery['type'] ?? null,
            'country' => $delivery['country'] ?? null,
            'city' => $delivery['city'] ?? null,
            'postal_code' => $delivery['postal_code'] ?? null,
            'address' => $delivery['address'] ?? null,
            'phone_number' => $delivery['phone_number'] ?? null,
        ];

        $payment = session('payment');
        $paymentMethod = (object)[
            'type' => $payment['type'] ?? null,
            'card_number' => $payment['card_number'] ?? null,
            'expiration_date_month' => $payment['expiration_date_month'] ?? null,
            'expiration_date_year' => $payment['expiration_date_year'] ?? null,
            'cvv' => $payment['cvv'] ?? null,
        ];
    }

    return view('basket/basket_delivery_and_payment', compact('recommendedProducts', 'deliveryMethod', 'paymentMethod'));
});

Route::get('/basket/basket_address', function () {
    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();
    
    // Logged in user
    if (auth()->check()) {        
        $deliveryMethod = auth()->user()->deliveryMethod;
    } 
    // Guest
    else {
        $delivery = session('delivery', []);
        $deliveryMethod = (object)[
            'type' => $delivery['type'] ?? null,
            'country' => $delivery['country'] ?? null,
            'city' => $delivery['city'] ?? null,
            'postal_code' => $delivery['postal_code'] ?? null,
            'address' => $delivery['address'] ?? null,
            'phone_number' => $delivery['phone_number'] ?? null,
        ];
    }

    return view('basket/basket_address', compact('recommendedProducts', 'deliveryMethod'));
});

Route::get('/basket/basket_payment_details', function () {
    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();

    // Logged in user
    if (auth()->check()) {        
        $paymentMethod = auth()->user()->paymentMethod;
    } 
    // Guest
    else {
        $payment = session('payment');
        $paymentMethod = (object)[
            'type' => $payment['type'] ?? null,
            'card_number' => $payment['card_number'] ?? null,
            'expiration_date_month' => $payment['expiration_date_month'] ?? null,
            'expiration_date_year' => $payment['expiration_date_year'] ?? null,
            'cvv' => $payment['cvv'] ?? null,
        ];
    }

    return view('basket/basket_payment_details', compact('recommendedProducts', 'paymentMethod'));
});

Route::get('/basket/basket_thank_you', function () {
    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();

    return view('basket/basket_thank_you', compact('recommendedProducts'));
});
