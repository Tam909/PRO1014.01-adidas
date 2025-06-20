<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Varianti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.Products.product', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Color::where('status', 0)->get();
        $sizes = Size::where('status', 0)->get();
        return view('admin.Products.create', compact('categories', 'colors', 'sizes'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_categories' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'img' => 'nullable|image',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('products', 'public');
        }
        $product = Product::create($data);
        $colors = $request->input('colors', []);
        $sizes = $request->input('sizes', []);

        foreach ($colors as $colorId) {
            foreach ($sizes as $sizeId) {
                Varianti::create([
                    'id_pro' => $product->id,
                    'id_color' => $colorId,
                    'id_size' => $sizeId,
                    'price' => $data['price'],
                    'quantity' => 0,
                    'img' => $data['img'] ?? null,
                ]);
            }
        }
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id); 
        $categories = Category::all();
        return view('admin.Products.edit', compact('product', 'categories'));
    }
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'id_categories' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'img' => 'nullable|image',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('products', 'public');
        }

        $product->update($data);

        // Xóa toàn bộ variant cũ trước khi lưu mới
        Varianti::where('id_pro', $product->id)->delete();

        $colors = $request->input('colors', []);
        $sizes = $request->input('sizes', []);

        foreach ($colors as $colorId) {
            foreach ($sizes as $sizeId) {
                Varianti::create([
                    'id_pro' => $product->id,
                    'id_color' => $colorId,
                    'id_size' => $sizeId,
                    'price' => $product->price,
                    'quantity' => 0,
                    'img' => $product->img,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công');
    }
    public function destroy(Product $product)
    {
        try {
            $product->variants()->delete();
            $product->delete();

            return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công!');
   
        } catch (\Exception $e) {
            // Bây giờ \Log::error() sẽ không còn bị cảnh báo lỗi Undefined type 'Log' nữa
            Log::error("Lỗi khi xóa sản phẩm ID: {$product->id}. Lỗi: " . $e->getMessage());

            return redirect()->route('products.index')->with('error', 'Có lỗi xảy ra khi xóa sản phẩm: ' . $e->getMessage());
        }
    }
}
