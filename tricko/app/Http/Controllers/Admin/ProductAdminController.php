<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ProductImg;

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

        $products = Product::with(['sizes', 'imgs'])
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
            'image' => 'required',
            'image.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $imagePaths = [];

        if ($request->hasFile('image')) {
            $folderPath = public_path('images/products');

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            foreach ($request->file('image') as $index => $file) {
                $fileName = time() . '_' . $index . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

                $file->move($folderPath, $fileName);

                $imagePaths[] = 'images/products/' . $fileName;
            }
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'gender' => $request->gender,
            'price' => $request->price,
            'color' => $request->color,
            'image' => $imagePaths[0],
        ]);

        foreach ($request->sizes as $size) {
            $product->sizes()->create([
                'size' => $size,
            ]);
        }

        foreach ($imagePaths as $index => $path) {
            DB::table('product_imgs')->insert([
                'product_id' => $product->id,
                'image' => $path,
                'order_number' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect('/admin/products')->with('success', 'Produkt bol úspešne pridaný.');
    }

    public function edit($id)
    {
        $this->checkAdmin();

        $product = Product::with(['sizes', 'imgs'])->findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin();

        $product = Product::with(['sizes', 'imgs'])->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:Tricka,Mikiny,Ciapky',
            'gender' => 'required|in:men,women,unisex',
            'price' => 'required|numeric|min:0',
            'color' => 'required|in:blue,red,green,yellow,black,white',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'required|string|in:S,M,L,XL,UNI',
            'imgsToDelete' => 'nullable|array',
            'imgsToDelete.*' => 'integer',            
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->filled('imgsToDelete')) {
            foreach ($request->imgsToDelete as $imgId) {
                $img = ProductImg::find($imgId);

                if ($img) {
                    $filePath = public_path($img->image);

                    if ($img && file_exists(public_path($img->image))) {
                        unlink(public_path($img->image));
                    }

                    $img->delete();
                }
            }
        }

        if ($request->hasFile('image')) {
            $folderPath = public_path('images/products');

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            foreach ($request->file('image') as $file) {
                $fileName = time() . '_' . Str::random(5) . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

                $file->move($folderPath, $fileName);

                ProductImg::create([
                    'product_id' => $product->id,
                    'image' => 'images/products/' . $fileName,
                    'order_number' => ProductImg::where('product_id', $product->id)->max('order_number') + 1 ?? 1,
                ]);
            }
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'gender' => $request->gender,
            'price' => $request->price,
            'color' => $request->color,
        ]);

        $product->sizes()->delete();

        foreach ($request->sizes as $size) {
            $product->sizes()->create(['size' => $size]);
        }

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
