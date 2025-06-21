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
        $featuredProducts = Product::where('status', 0)->take(3)->get();
    

        $products = Product::where('status', 0)->get();
    
       return view('home', compact('products', 'categories', 'featuredProducts'));
    }
     // Phương thức để hiển thị danh sách sản phẩm theo danh mục
     public function productsByCategory($id) // Hoặc $id nếu bạn dùng ID thay vì id
     {
         // Tìm danh mục theo id
         $category = Category::where('id', $id)->firstOrFail();
         // Hoặc: $category = Category::findOrFail($id); nếu dùng ID
 
         // Lấy sản phẩm của danh mục đó có status = 0 và phân trang
         $products = Product::where('status', 0)
                            ->where('id_categories', $category->id) // ĐÃ SỬA TỪ 'category_id' SANG 'id_categories'
                            ->paginate(12);
 
         $categories = Category::all();
 
         return view('user.Products.list', compact('products', 'category', 'categories'));
     }
    
    function show($id)
    {
        
        $product = Product::findOrFail($id);
        return view('user.Products.show', compact('product'));
    }
    public function list()
    {
        $categories = Category::all(); // Lấy danh mục nếu bạn muốn hiển thị trên trang danh sách
        $products = Product::where('status', 0)->paginate(12); // Lấy tất cả sản phẩm hoạt động, phân trang 12 sản phẩm/trang

        // Trả về view để hiển thị danh sách sản phẩm
        // Đảm bảo bạn có file view 'user.Products.list.blade.php'
        return view('user.Products.list', compact('products', 'categories'));
    }
    public function showContactForm()
    {
        return view('user.contact'); // Sẽ render file resources/views/contact.blade.php
    }
    public function submitContactForm(Request $request)
    {
        // Chỉ validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255', // Tiêu đề có thể không bắt buộc
            'message' => 'required|string',
        ]);

        // Nếu validation thành công, chuyển hướng người dùng về lại trang liên hệ
        // và gửi thông báo thành công qua session flash data.
        return redirect()->route('contact.show')->with('success', 'Thông tin của bạn đã được gửi thành công!');
        // Bạn có thể thay đổi thông báo hoặc chuyển hướng đến một trang khác nếu muốn.
    }
    public function showAboutPage()
    {
        return view('user.about'); // Sẽ render file resources/views/about.blade.php
    }
    

}
