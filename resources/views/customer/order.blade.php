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
            <li class="breadcrumb-item text-nowrap active" aria-current="page">Orders history</li>
          </ol>
        </nav>
      </div> --}}
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-light mb-0">Mis órdenes</h1>
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
            <div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3">
                <div class="form-inline">
                    <label class="text-light opacity-75 text-nowrap mr-2 d-none d-lg-block" for="order-sort">Sort orders:</label>
                    <select class="form-control custom-select" id="order-sort">
                        <option>All</option>
                        <option>Delivered</option>
                        <option>In Progress</option>
                        <option>Delayed</option>
                        <option>Canceled</option>
                    </select>
                </div>
                <a class="btn btn-primary btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="czi-sign-out mr-2"></i> Cerrar sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <!-- Orders list-->
            <div class="table-responsive font-size-md">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Número #</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-3"><a class="nav-link-style font-weight-medium font-size-sm" href="#order-details" data-toggle="modal">34VB5540K83</a></td>
                            <td class="py-3">May 21, 2019</td>
                            <td class="py-3"><span class="badge badge-info m-0">In Progress</span></td>
                            <td class="py-3">$358.75</td>
                        </tr>
                        <tr>
                            <td class="py-3"><a class="nav-link-style font-weight-medium font-size-sm" href="#order-details" data-toggle="modal">78A643CD409</a></td>
                            <td class="py-3">December 09, 2018</td>
                            <td class="py-3"><span class="badge badge-danger m-0">Canceled</span></td>
                            <td class="py-3"><span>$760.50</span></td>
                        </tr>
                        <tr>
                            <td class="py-3"><a class="nav-link-style font-weight-medium font-size-sm" href="#order-details" data-toggle="modal">112P45A90V2</a></td>
                            <td class="py-3">October 15, 2018</td>
                            <td class="py-3"><span class="badge badge-warning m-0">Delayed</span></td>
                            <td class="py-3">$1,264.00</td>
                        </tr>
                        <tr>
                            <td class="py-3"><a class="nav-link-style font-weight-medium font-size-sm" href="#order-details" data-toggle="modal">28BA67U0981</a></td>
                            <td class="py-3">July 19, 2018</td>
                            <td class="py-3"><span class="badge badge-success m-0">Delivered</span></td>
                            <td class="py-3">$198.35</td>
                        </tr>
                        <tr>
                            <td class="py-3"><a class="nav-link-style font-weight-medium font-size-sm" href="#order-details" data-toggle="modal">502TR872W2</a></td>
                            <td class="py-3">April 04, 2018</td>
                            <td class="py-3"><span class="badge badge-success m-0">Delivered</span></td>
                            <td class="py-3">$2,133.90</td>
                        </tr>
                        <tr>
                            <td class="py-3"><a class="nav-link-style font-weight-medium font-size-sm" href="#order-details" data-toggle="modal">47H76G09F33</a></td>
                            <td class="py-3">March 30, 2018</td>
                            <td class="py-3"><span class="badge badge-success m-0">Delivered</span></td>
                            <td class="py-3">$86.40</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr class="pb-4">
            <!-- Pagination-->
            <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#"><i class="czi-arrow-left mr-2"></i>Anterior</a></li>
                </ul>
                <ul class="pagination">
                    <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span></li>
                    <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">1<span class="sr-only">(current)</span></span></li>
                    <li class="page-item d-none d-sm-block"><a class="page-link" href="#">2</a></li>
                    <li class="page-item d-none d-sm-block"><a class="page-link" href="#">3</a></li>
                    <li class="page-item d-none d-sm-block"><a class="page-link" href="#">4</a></li>
                    <li class="page-item d-none d-sm-block"><a class="page-link" href="#">5</a></li>
                </ul>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#" aria-label="Next">Siguiente<i class="czi-arrow-right ml-2"></i></a></li>
                </ul>
            </nav>
        </section>
    </div>
</div>
@endsection
