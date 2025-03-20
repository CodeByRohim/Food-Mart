@extends('layouts.BackendMaster')
@section('trending-products')
@section('title','Trending-Products')

      <div class="container">
        <div class="page-inner">
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
          >
            <div>           
              <h2 class="fw-bold mb-3mb-4">Product Management</h2>
              <h6 class="op-7 mb-2">Food Mart Admin Dashboard</h6>
              <h5>Trending-Products</h5>
              @if ($errors->has('name') || $errors->has('description_unit')
               || $errors->has('discount') || $errors->has('price') || $errors->has('image') || $errors->has('stock') || $errors->has('amount'))
                <div class="alert alert-danger">
                    @error('name') {{ $message }} <br> @enderror
                    @error('description_unit') {{ $message }} <br> @enderror
                    @error('discount'){{ $message }} <br> @enderror
                    @error('price'){{ $message }} <br> @enderror
                    @error('image'){{ $message }} <br> @enderror
                    @error('stock'){{ $message }} <br> @enderror
                    @error ('amount'){{ $message }} <br> @enderror
                </div>
            @endif

            </div>
            <div class="ms-md-auto py-2 py-md-0">
              <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
              <a href="#" class="btn btn-primary btn-round">Add Customer</a>
            </div>
          </div>
        
        {{-- Main content start --}}
        {{-- success messsage --}}
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
       @endif
    <!-- Add Product Button -->
    <a href="" type="button" 
    class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#editProductModal" data-bs-whatever="@fat">+ Add New Product</a>
    
    <!-- Vertically centered modal for add product -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Trending Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('dashboard.trending-products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Name *" value="{{old('name')}}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">   
                <input type="text" class="form-control" name="discount" placeholder="Discount" value="{{old('discount')}}">
                @error('discount')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">   
                <input type="text" class="form-control" name="description_unit" placeholder="Description/Unit" value="{{old('description_unit')}}">
                @error('description_unit')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">   
                <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{old('amount')}}">
                @error('amount')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">   
                <input type="text" class="form-control" name="price" placeholder="Price *" value="{{old('price')}}">
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">   
                <input type="text" class="form-control" name="stock" placeholder="Stock *" value="{{old('stock')}}">
                @error('stock')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">   
                <input type="hidden" name="product_id" value="">
                <input type="file" class="form-control" name="image" placeholder="Product Image *" value="{{old('image')}}">
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
    <!-- Search & Filter -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Search Product..." id="searchProduct">
        </div>
        <div class="col-md-4">
            <select class="form-control">
                <option value="">Filter by Category</option>
                <option value="electronics">Electronics</option>
                <option value="fashion">Fashion</option>
            </select>
        </div>
    </div>

    <!-- Product List -->
    <div class="table-responsive">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Discount</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
               
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->discount }}%</td>
                    <td>{{ $product->description_unit }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <span class="badge {{ $product->status ? 'badge-success' : 'badge-danger' }}">
                            {{ $product->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                      @if($product->image)
                      <img width="50" src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                  @else
                      <p>No image available.</p>
                  @endif
                </td>
                    
                  <td>
                 {{-- <a href="{{ route('dashboard.edit-trending-product.edit', $product->id) }}" class="btn btn-sm btn-warning">Update</a> --}}
                 <form action="{{ route('dashboard.edit-trending-product.edit', $product->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="btn btn-sm btn-warning">Update</button>
              </form>
                        <form action="{{ route('dashboard.trending-products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete {{ $product->name }}?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                  <td colspan="9">No Data Found!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="mt-3">
        {{-- {{ $products->links() }} --}}
    </div>
  </div>
        {{-- Main content end --}}
      </div>
@endsection