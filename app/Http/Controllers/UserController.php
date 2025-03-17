<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
         // Validate request data
        $request->validate([     
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return view('dashboard.index');

        }
    
        return back()->withErrors(['errors' => "Password and email don't match."]);
  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validate request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|string|digits:11',
       
    ]);

    // Create user
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Hashing password properly
        'phone' => $request->phone,
    ]);

    // Redirect with success message (for web)
    return redirect()->route('users.index')->with('success', 'User created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
            $users = User::all();
            return view('dashboard.index', compact('users'));//working
        
        // View::share('users');
        // return view('dashboard.index', compact('users'));
        // return view('layouts.BackendMaster', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
