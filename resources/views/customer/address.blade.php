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
        @include('customer.sidebar')
        <!-- Content  -->
        <section class="col-lg-8">
            <!-- Toolbar-->
            <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-4">
                <h6 class="font-size-base text-light mb-0">List of your registered addresses:</h6>
                <a class="btn btn-primary btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="czi-sign-out mr-2"></i> Cerrar sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
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
