@extends('layouts.BackendMaster')
@section('edit-trending-products')
@section('title','Edit-Trending-Products')

      <div class="container">
        <div class="page-inner">
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
          >
            <div>           
              <h2 class="fw-bold mb-3mb-4">Product Management</h2>
              <h6 class="op-7 mb-2">Food Mart Admin Dashboard</h6>
              <h5>Edit-Trending-Products</h5>
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
    
            <form action="{{ route('dashboard.edit-trending-products.update', $productEdit->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method ('PUT')
              <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Name *" value="{{ $productEdit->name }}">
                @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">   
                <input type="text" class="form-control" name="discount" placeholder="Discount" value="{{ $productEdit->discount }}">
                @error('discount')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">   
                <input type="text" class="form-control" name="description_unit" placeholder="Description/Unit" value="{{ $productEdit->description_unit, $productEdit->description_unit ?? '' }}">
                @error('description_unit')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">   
                <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{ $productEdit->amount }}">
                @error('amount')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">   
                <input type="text" class="form-control" name="price" placeholder="Price *" value="{{ $productEdit->price }}">
                @error('price')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">   
                <input type="text" class="form-control" name="stock" placeholder="Stock" value="{{ $productEdit->stock }}">
                @error('stock')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="mb-3">   
                <input type="file" class="form-control" name="image" placeholder="Product Image *">
                @error('image')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="modal-footer gap-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          
      
  
    <!-- Pagination -->
    <div class="mt-3">
        {{-- {{ $products->links() }} --}}
    </div>
  </div>
        {{-- Main content end --}}
      </div>
@endsection