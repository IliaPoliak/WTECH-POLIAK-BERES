<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Product;
use App\Models\ItemInBasket;

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
    $request->validate([
        'item_id' => 'required|exists:sizes,id',
    ]);

    $existingItem = ItemInBasket::where('user_id', auth()->id())
        ->where('item_id', $request->item_id)
        ->first();

    if ($existingItem) {
        $existingItem->quantity += 1;
        $existingItem->save();
    } else {
        ItemInBasket::create([
            'user_id' => auth()->id(),
            'item_id' => $request->item_id,
            'quantity' => 1,
        ]);
    }

    return redirect()->back();
})->middleware('auth')->name('basket.add');

Route::post('/basket/increase/{id}', function ($id) {
    $item = ItemInBasket::where('user_id', auth()->id())->findOrFail($id);
    $item->quantity += 1;
    $item->save();

    return redirect()->back();
})->middleware('auth')->name('basket.increase');

Route::post('/basket/decrease/{id}', function ($id) {
    $item = ItemInBasket::where('user_id', auth()->id())->findOrFail($id);

    if ($item->quantity > 1) {
        $item->quantity -= 1;
        $item->save();
    } else {
        $item->delete();
    }

    return redirect()->back();
})->middleware('auth')->name('basket.decrease');

Route::post('/basket/remove/{id}', function ($id) {
    $item = ItemInBasket::where('user_id', auth()->id())->findOrFail($id);
    $item->delete();

    return redirect()->back();
})->middleware('auth')->name('basket.remove');

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
    $basketItems = ItemInBasket::with('size.product')
        ->where('user_id', auth()->id())
        ->get();

    $total = $basketItems->sum(function ($item) {
        return $item->size->product->price * $item->quantity;
    });

    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();

    return view('basket.basket', compact('basketItems', 'total', 'recommendedProducts'));
})->middleware('auth');

Route::get('/basket/basket_delivery_and_payment', function () {
    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();

    return view('basket/basket_delivery_and_payment', compact('recommendedProducts'));
});

Route::get('/basket/basket_address', function () {
    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();

    return view('basket/basket_address', compact('recommendedProducts'));
});

Route::get('/basket/basket_payment_details', function () {
    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();

    return view('basket/basket_payment_details', compact('recommendedProducts'));
});

Route::get('/basket/basket_thank_you', function () {
    $recommendedProducts = Product::inRandomOrder()->limit(4)->get();

    return view('basket/basket_thank_you', compact('recommendedProducts'));
});
