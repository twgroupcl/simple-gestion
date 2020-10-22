@extends('layouts.base')

@section('content')
<!-- Page Title-->
<div class="page-title-overlap bg-dark pt-4 bg-cp-gradient">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        {{-- <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a></li>
                    <li class="breadcrumb-item text-nowrap"><a href="#">Account</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Profile info</li>
                </ol>
            </nav>
        </div> --}}
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-light mb-0">Profile info</h1>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container pb-5 mb-2 mb-md-3">
    <div class="row">
        @include('customer.sidebar')
        <!-- Content  -->
        <section class="col-lg-8">
            <!-- Toolbar-->
            <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
                <h6 class="font-size-base text-light mb-0">Update you profile details below:</h6>
                <a class="btn btn-primary btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="czi-sign-out mr-2"></i> Cerrar sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <!-- Profile form-->
            <form>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account-fn">First Name</label>
                            <input class="form-control" type="text" id="account-fn" value="Susan">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account-ln">Last Name</label>
                            <input class="form-control" type="text" id="account-ln" value="Gardner">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account-email">Email Address</label>
                            <input class="form-control" type="email" id="account-email" value="s.gardner@example.com" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account-phone">Phone Number</label>
                            <input class="form-control" type="text" id="account-phone" value="+7 (805) 348 95 72" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account-pass">New Password</label>
                            <div class="password-toggle">
                                <input class="form-control" type="password" id="account-pass">
                                <label class="password-toggle-btn">
                                    <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account-confirm-pass">Confirm Password</label>
                            <div class="password-toggle">
                                <input class="form-control" type="password" id="account-confirm-pass">
                                <label class="password-toggle-btn">
                                    <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="mt-2 mb-3">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div class="custom-control custom-checkbox d-block">
                                <input class="custom-control-input" type="checkbox" id="subscribe_me" checked>
                                <label class="custom-control-label" for="subscribe_me">Subscribe me to Newsletter</label>
                            </div>
                            <button class="btn btn-primary mt-3 mt-sm-0" type="button">Update profile</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
