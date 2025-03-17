 
 @extends('layouts.auth')
 @section('register')
 @section('title','Register')
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div style="background:url('{{asset('dashboard/assets/img/bg-404.jpeg')}}')"
                     class="col-lg-5  d-lg-block bg-register-image">  </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center" style=" ">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="{{'users'}}" method="POST" class="user">
                                @csrf
                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                                <div class="form-group">                           
                                        <input value="{{old('name')}}" name="name" type="text" class="form-control  form-control-user" id="exampleFirstName"
                                            placeholder="UserName">
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                    {{-- <div class="col-sm-6">
                                        <input name="last_name" type="text" class="form-control  form-control-user" id="exampleLastName"
                                            placeholder="Last Name">
                                    </div> --}}
                                </div>
                                <div class="form-group">
                                    <input value="{{old('email')}}" name="email" type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input value="{{old('password')}}" name="password" type="password" class="form-control  form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input value="{{old('password_confirmation')}}" name="password_confirmation" type="password" class="form-control  form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                            @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input value="{{old('phone')}}" name="phone" type="text" class="form-control form-control-user" id="exampleInputMobile"
                                        placeholder="Phone No.">
                                        @error('phone')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                                <a href="index.php" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.php" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{('login')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection


   