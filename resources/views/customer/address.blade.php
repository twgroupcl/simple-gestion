@extends('layouts.base')

@section('content')
<!-- Add New Address-->
<form class="needs-validation modal fade" method="post" id="add-address" tabindex="-1" novalidate>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new address</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address-fn">First name</label>
                            <input class="form-control" type="text" id="address-fn" required>
                            <div class="invalid-feedback">Please fill in you first name!</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address-ln">Last name</label>
                            <input class="form-control" type="text" id="address-ln" required>
                            <div class="invalid-feedback">Please fill in you last name!</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address-company">Company</label>
                            <input class="form-control" type="text" id="address-company">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address-country">Country</label>
                            <select class="custom-select" id="address-country" required>
                                <option value>Select country</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Belgium">Belgium</option>
                                <option value="France">France</option>
                                <option value="Germany">Germany</option>
                                <option value="Spain">Spain</option>
                                <option value="UK">United Kingdom</option>
                                <option value="USA">USA</option>
                            </select>
                            <div class="invalid-feedback">Please select your country!</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address-city">City</label>
                            <input class="form-control" type="text" id="address-city" required>
                            <div class="invalid-feedback">Please fill in your city!</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address-line1">Line 1</label>
                            <input class="form-control" type="text" id="address-line1" required>
                            <div class="invalid-feedback">Please fill in your address!</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address-line2">Line 2</label>
                            <input class="form-control" type="text" id="address-line2">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address-zip">ZIP code</label>
                            <input class="form-control" type="text" id="address-zip" required>
                            <div class="invalid-feedback">Please add your ZIP code!</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="address-primary">
                            <label class="custom-control-label" for="address-primary">Make this address primary</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary btn-shadow" type="submit">Add address</button>
            </div>
        </div>
    </div>
</form>
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
                        @forelse ($customer->addresses_data as $address)
                            <tr>
                                <td class="py-3 align-middle">{{ $address['street'] }} - {{ $address['number']}}</td>
                                <td class="py-3 align-middle"><a class="nav-link-style mr-2" href="#" data-toggle="tooltip" title="Edit"><i class="czi-edit"></i></a><a class="nav-link-style text-danger" href="#" data-toggle="tooltip" title="Remove">
                                        <div class="czi-trash"></div>
                                    </a></td>
                            </tr>
                        @empty
                            No se encontraron direcciones
                        @endforelse
                    </tbody>
                </table>
            </div>
            <hr class="pb-4">
            <div class="text-sm-right"><a class="btn btn-primary" href="#add-address" data-toggle="modal">Add new address</a></div>
        </section>
    </div>
</div>
@endsection
