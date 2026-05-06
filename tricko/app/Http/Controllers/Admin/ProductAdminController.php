<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductAdminController extends Controller
{
    private function checkAdmin()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }
    }

    public function index()
    {
        $this->checkAdmin();

        $products = Product::with('sizes')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $this->checkAdmin();

        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:Tricka,Mikiny,Ciapky',
            'gender' => 'required|in:men,women,unisex',
            'price' => 'required|numeric|min:0',
            'color' => 'required|in:blue,red,green,yellow,black,white',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'required|string|in:S,M,L,XL,UNI',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $folderPath = public_path('images/products');

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

            $file->move($folderPath, $fileName);

            $imagePath = 'images/products/' . $fileName;
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'gender' => $request->gender,
            'price' => $request->price,
            'color' => $request->color,
            'image' => $imagePath,
        ]);

        foreach ($request->sizes as $size) {
            $product->sizes()->create([
                'size' => $size,
            ]);
        }

        DB::table('product_imgs')->insert([
            'product_id' => $product->id,
            'image' => $imagePath,
            'order_number' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin/products')->with('success', 'Produkt bol úspešne pridaný.');
    }

    public function edit($id)
    {
        $this->checkAdmin();

        $product = Product::with('sizes')->findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin();

        $product = Product::with('sizes')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:Tricka,Mikiny,Ciapky',
            'gender' => 'required|in:men,women,unisex',
            'price' => 'required|numeric|min:0',
            'color' => 'required|in:blue,red,green,yellow,black,white',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'required|string|in:S,M,L,XL,UNI',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldImagePath = public_path($product->image);

                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $folderPath = public_path('images/products');

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

            $file->move($folderPath, $fileName);

            $imagePath = 'images/products/' . $fileName;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'gender' => $request->gender,
            'price' => $request->price,
            'color' => $request->color,
            'image' => $imagePath,
        ]);

        $product->sizes()->delete();

        foreach ($request->sizes as $size) {
            $product->sizes()->create([
                'size' => $size,
            ]);
        }

        DB::table('product_imgs')->updateOrInsert(
            [
                'product_id' => $product->id,
                'order_number' => 1,
            ],
            [
                'image' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return redirect('/admin/products')->with('success', 'Produkt bol úspešne upravený.');
    }

    public function destroy($id)
    {
        $this->checkAdmin();

        $product = Product::with('sizes')->findOrFail($id);

        if ($product->image) {
            $imageFullPath = public_path($product->image);

            if (file_exists($imageFullPath)) {
                unlink($imageFullPath);
            }
        }

        $productImages = DB::table('product_imgs')
            ->where('product_id', $product->id)
            ->get();

        foreach ($productImages as $productImage) {
            if ($productImage->image && $productImage->image !== $product->image) {
                $extraImagePath = public_path($productImage->image);

                if (file_exists($extraImagePath)) {
                    unlink($extraImagePath);
                }
            }
        }

        $product->delete();

        return redirect('/admin/products')->with('success', 'Produkt bol úspešne vymazaný.');
    }
}
