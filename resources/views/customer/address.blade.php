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
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Addresses</li>
                </ol>
            </nav>
        </div> --}}
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-light mb-0">My addresses</h1>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container pb-5 mb-2 mb-md-3">
    <div class="row">
        <!-- Sidebar-->
        <aside class="col-lg-4 pt-4 pt-lg-0">
            <div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0">
                <div class="px-4 mb-4">
                    <div class="media align-items-center">
                        <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;"><span class="badge badge-warning" data-toggle="tooltip" title="Reward points">384</span><img class="rounded-circle" src="img/shop/account/avatar.jpg" alt="Susan Gardner"></div>
                        <div class="media-body pl-3">
                            <h3 class="font-size-base mb-0">Susan Gardner</h3><span class="text-accent font-size-sm">s.gardner@example.com</span>
                        </div>
                    </div>
                </div>
                <div class="bg-secondary px-4 py-3">
                    <h3 class="font-size-sm mb-0 text-muted">Dashboard</h3>
                </div>
                <ul class="list-unstyled mb-0">
                    <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-orders.html"><i class="czi-bag opacity-60 mr-2"></i>Orders<span class="font-size-sm text-muted ml-auto">1</span></a></li>
                    <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-wishlist.html"><i class="czi-heart opacity-60 mr-2"></i>Wishlist<span class="font-size-sm text-muted ml-auto">3</span></a></li>
                    <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-tickets.html"><i class="czi-help opacity-60 mr-2"></i>Support tickets<span class="font-size-sm text-muted ml-auto">1</span></a></li>
                </ul>
                <div class="bg-secondary px-4 py-3">
                    <h3 class="font-size-sm mb-0 text-muted">Account settings</h3>
                </div>
                <ul class="list-unstyled mb-0">
                    <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-profile.html"><i class="czi-user opacity-60 mr-2"></i>Profile info</a></li>
                    <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 active" href="account-address.html"><i class="czi-location opacity-60 mr-2"></i>Addresses</a></li>
                    <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-payment.html"><i class="czi-card opacity-60 mr-2"></i>Payment methods</a></li>
                    <li class="d-lg-none border-top mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-signin.html"><i class="czi-sign-out opacity-60 mr-2"></i>Sign out</a></li>
                </ul>
            </div>
        </aside>
        <!-- Content  -->
        <section class="col-lg-8">
            <!-- Toolbar-->
            <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-4">
                <h6 class="font-size-base text-light mb-0">List of your registered addresses:</h6><a class="btn btn-primary btn-sm" href="account-signin.html"><i class="czi-sign-out mr-2"></i>Sign out</a>
            </div>
            <!-- Addresses list-->
            <div class="table-responsive font-size-md">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-3 align-middle">396 Lillian Blvd, Holbrook, NY 11741, USA<span class="align-middle badge badge-info ml-2">Primary</span></td>
                            <td class="py-3 align-middle"><a class="nav-link-style mr-2" href="#" data-toggle="tooltip" title="Edit"><i class="czi-edit"></i></a><a class="nav-link-style text-danger" href="#" data-toggle="tooltip" title="Remove">
                                    <div class="czi-trash"></div>
                                </a></td>
                        </tr>
                        <tr>
                            <td class="py-3 align-middle">769, Industrial, West Chicago, IL 60185, USA</td>
                            <td class="py-3 align-middle"><a class="nav-link-style mr-2" href="#" data-toggle="tooltip" title="Edit"><i class="czi-edit"></i></a><a class="nav-link-style text-danger" href="#" data-toggle="tooltip" title="Remove">
                                    <div class="czi-trash"></div>
                                </a></td>
                        </tr>
                        <tr>
                            <td class="py-3 align-middle">514 S. Magnolia St. Orlando, FL 32806, USA</td>
                            <td class="py-3 align-middle"><a class="nav-link-style mr-2" href="#" data-toggle="tooltip" title="Edit"><i class="czi-edit"></i></a><a class="nav-link-style text-danger" href="#" data-toggle="tooltip" title="Remove">
                                    <div class="czi-trash"></div>
                                </a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr class="pb-4">
            <div class="text-sm-right"><a class="btn btn-primary" href="#add-address" data-toggle="modal">Add new address</a></div>
        </section>
    </div>
</div>
@endsection
