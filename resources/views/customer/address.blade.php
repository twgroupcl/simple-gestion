@extends('layouts.base')

@section('content')
<!-- Add New Address-->
<form class="needs-validation modal fade" method="POST" action="{{ route('address.update', ['customer' => $customer]) }}" id="add-address" tabindex="-1" novalidate>
    @method('PUT')
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añade una nueva dirección</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="street">Calle <span class="text-danger">*</span></label>
                            <input class="form-control" name="street" type="text" id="street" required>
                            <div class="invalid-feedback">Escriba la calle</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="number">Número <span class="text-danger">*</span></label>
                            <input class="form-control" name="number" type="text" id="number" required>
                            <div class="invalid-feedback">Escriba el número!</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address-company">Casa/Dpto/Oficina</label>
                            <input class="form-control" type="text" name="subnumber" id="address-company">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="commune_id">Comuna <span class="text-danger">*</span></label>
                            <select class="custom-select" name="commune_id" id="commune_id" required>
                                @foreach ($communes as $id => $commune)
                                    <option value="{{ $id }}">{{ $commune }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Seleccione la comuna</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="uid">RUT</label>
                            <input class="form-control" name="uid" type="text" id="uid">
                            <div class="invalid-feedback">Escriba el Rut</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="first_name">Nombre</label>
                            <input class="form-control" name="first_name" type="text" id="first_name">
                            <div class="invalid-feedback">Escriba el nombre</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="last_name">Apellido</label>
                            <input class="form-control" name="last_name" type="text" id="last_name">
                            <div class="invalid-feedback">Escriba el apellido</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" name="email" type="text" id="email">
                            <div class="invalid-feedback">Escriba el email</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input class="form-control" name="phone" type="text" id="phone">
                            <div class="invalid-feedback">Escriba el teléfono</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cellphone">Teléfono móvil</label>
                            <input class="form-control" name="cellphone" type="text" id="cellphone">
                            <div class="invalid-feedback">Escriba el teléfono móvil</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="extra">Detalles</label>
                            <textarea class="form-control" name="extra" id="extra"></textarea>                            <div class="invalid-feedback">Escriba el teléfono móvil</div>
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
            <h1 class="h3 text-light mb-0">Mis direcciones</h1>
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
                <h6 class="font-size-base text-light mb-0">Lista de tus direcciones registradas:</h6>
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
                            <th>Direcciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $addresses_data = is_array($customer->addresses_data)
                                ? $customer->addresses_data
                                : json_decode($customer->addresses_data, true) ?? [];
                        @endphp
                        @forelse ($addresses_data as $address)
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
