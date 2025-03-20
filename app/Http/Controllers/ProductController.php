<?php

namespace App\Http\Controllers;
use App\Traits\HandlesImage;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class ProductController extends Controller
{
use HandlesImage;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10); // Fetch products with pagination
        // $products = Product::get();
        return view('dashboard.edit-trending-product', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.trending-products');
    }

    /**
     * Store a newly created resource in storage.
     */
    /*
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description_unit' => 'integer',
            'product_id' => 'required|exists:products,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    // // ✅ Handle Image Upload
    $image = $request->input('product_id');
    $products = Product::findOrFail($image);
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public'); 
        $products->image = $imagePath;
    } 
        Product::create($request->only([
            'name',
            'discount',
            'image',
            'description_unit',
            'price',
            'amount',
            'stock',
            'is_active',
            ]));
        return back()->with('success', 'Product added successfully.');
    }
*/
public function store(Request $request)
{
    
    // Validate the request
    $request->validate([
        'name' => 'required',
        'price' => 'required',
        'stock' => 'required',
        'amount' => 'nullable',
        'description_unit' => 'integer',
        'product_id' => 'nullable|exists:products,id',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle Image Upload
    $imagePath = null;
    if ($request->hasFile('image')) {
       
    $originalName = $request->file('image')->getClientOriginalName();
    $safeName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $request->file('image')->extension();
        // $imagePath = $this->uploadImage($request->file('image'));
        $imagePath = $request->file('image')->storeAs('products', $safeName, 'public');
    }

        // Create new product
        Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'amount' => $request->input('amount'),
            'description_unit' => $request->input('description_unit'),
            'image' => $imagePath,
            // Add other fields as needed
        ]);
    

    return back()->with('success', 'Product processed successfully.');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productEdit = Product::findOrFail($id);
        return view('dashboard.edit-trending-products', compact('productEdit'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'discount' => 'nullable',
            'description_unit' => 'nullable|string|max:255',
            'amount' => 'nullable',
            'price' => 'required',
            'stock' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Find the product
        $productEdit = Product::findOrFail($id);
       
         // Delete the old image if a new one is uploaded
         if ($request->hasFile('image')) {
            $this->deleteImage($productEdit->image); // Delete old image
            $imagePath = $this->uploadImage($request->file('image'));
            $productEdit->image = $imagePath;
        }
        // Update product details
        $productEdit->name = $request->name;
        $productEdit->discount = $request->discount;
        $productEdit->description_unit = $request->description_unit;
        $productEdit->amount = $request->amount;
        $productEdit->price = $request->price;
        $productEdit->stock = $request->stock;
        
     
    
        // Save the updated product
        $productEdit->save();
    
        // Redirect back with a success message
         return redirect('trending-products')->with('success', 'Product updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        
       
        if ($product->image) {
            $this->deleteImage($product->image); // Delete old image
        }
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
        
    }
}
