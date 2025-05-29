<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
        return view('admin.Products.create', compact('categories'));
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
        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công');
    }
    public function edit(Product $product)
    {
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
        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công');
    }

}
