<?php 
namespace App\Http\Controllers\User\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
class ProductController extends Controller{


    public function index()
    {
        // Chỉ lấy sản phẩm đang hoạt động (status = 0)
        $featuredProducts = Product::where('status', 0)->take(3)->get();
    
        // Hoặc lấy tất cả sản phẩm hoạt động
        $products = Product::where('status', 0)->get();
    
        return view('home', compact('products', 'featuredProducts'));
    }
    
    function show($id)
    {
        $product = Product::findOrFail($id);
        return view('user.ProductsUser.show', compact('product'));
    }

}
?>