<?php 
namespace App\Http\Controllers\User\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Product;
class ProductController extends Controller{


    public function index()
    {
        $categories = Category::all();
        // Chỉ lấy sản phẩm đang hoạt động (status = 0)
        $featuredProducts = Product::where('status', 0)->take(3)->get();
    
        // Hoặc lấy tất cả sản phẩm hoạt động
        $products = Product::where('status', 0)->get();
    
       return view('home', compact('products', 'categories', 'featuredProducts'));
    }
    
    function show($id)
    {
        $product = Product::findOrFail($id);
        return view('user.ProductsUser.show', compact('product'));
    }
    public function list()
    {
        $product = Product::all(); // hoặc phân trang: Product::paginate(12);
        return view('user.ProductUset.list', compact('products'));
    }

}
?>