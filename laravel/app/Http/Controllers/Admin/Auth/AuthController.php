<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
  public function showRegisterForm()
  {
    return view('admin.auth.register');
  }

  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect()->route('admin.dashboard')->with('success', 'Đăng ký thành công!');
  }

  public function showLoginForm()
  {
    return view('admin.auth.login');
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
      return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
    }

    return back()->withErrors([
      'email' => 'Thông tin đăng nhập không chính xác.',
    ]);
  }

  public function logout(){
    Auth::logout();
    return redirect()->route('home')->with('success', 'Đăng xuất thành công!');
  }

}