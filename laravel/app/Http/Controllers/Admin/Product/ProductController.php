<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Varianti;
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
       $variants = $request->input('variants', []);
foreach ($variants as $colorVariants) {
    foreach ($colorVariants as $variant) {
        if ($variant['quantity'] > 0) {
            Varianti::create([
                'id_pro' => $product->id,
                'id_color' => $variant['color_id'],
                'id_size' => $variant['size_id'],
                'price' => $data['price'],
                'quantity' => $variant['quantity'],
                'img' => $data['img'] ?? null,
            ]);
        }
    }
}
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công');
    }
  public function edit(Product $product)
{
    $categories = Category::all();
    $colors = Color::where('status', 0)->get();
    $sizes = Size::where('status', 0)->get();

    return view('admin.Products.edit', compact('product', 'categories', 'colors', 'sizes'));
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

    // Nếu có ảnh mới thì lưu và cập nhật
    if ($request->hasFile('img')) {
        $data['img'] = $request->file('img')->store('products', 'public');
    }

    // Cập nhật sản phẩm
    $product->update($data);

    // Xóa tất cả biến thể cũ
    $product->variants()->delete();

    // Lấy danh sách biến thể mới từ form
    $variants = $request->input('variants', []);

    foreach ($variants as $colorId => $sizes) {
        foreach ($sizes as $sizeId => $variant) {
            // Kiểm tra hợp lệ trước khi tạo
            if (!empty($variant['quantity']) && $variant['quantity'] > 0) {
                Varianti::create([
                    'id_pro'    => $product->id,
                    'id_color'  => $variant['color'] ?? $colorId,
                    'id_size'   => $variant['size'] ?? $sizeId,
                    'price'     => $variant['price'] ?? $product->price,
                    'quantity'  => $variant['quantity'],
                    'img'       => $product->img ?? null,
                ]);
            }
        }
    }

    return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công');
}

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công');
    }
  

}
