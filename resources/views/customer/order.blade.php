@extends('layouts.base')

@section('content')
<!-- Order Details Modal-->
<div class="modal fade" id="order-details">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order No - 34VB5540K83</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body pb-0">
                <!-- Item-->
                <div class="d-sm-flex justify-content-between mb-4 pb-3 pb-sm-2 border-bottom">
                    <div class="media d-block d-sm-flex text-center text-sm-left"><a class="d-inline-block mx-auto mr-sm-4" href="shop-single-v1.html" style="width: 10rem;"><img src="img/shop/cart/01.jpg" alt="Product"></a>
                        <div class="media-body pt-2">
                            <h3 class="product-title font-size-base mb-2"><a href="shop-single-v1.html">Women Colorblock Sneakers</a></h3>
                            <div class="font-size-sm"><span class="text-muted mr-2">Size:</span>8.5</div>
                            <div class="font-size-sm"><span class="text-muted mr-2">Color:</span>White &amp; Blue</div>
                            <div class="font-size-lg text-accent pt-2">$154.<small>00</small></div>
                        </div>
                    </div>
                    <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                        <div class="text-muted mb-2">Quantity:</div>1
                    </div>
                    <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                        <div class="text-muted mb-2">Subtotal</div>$154.<small>00</small>
                    </div>
                </div>
                <!-- Item-->
                <div class="d-sm-flex justify-content-between my-4 pb-3 pb-sm-2 border-bottom">
                    <div class="media d-block d-sm-flex text-center text-sm-left"><a class="d-inline-block mx-auto mr-sm-4" href="shop-single-v1.html" style="width: 10rem;"><img src="img/shop/cart/02.jpg" alt="Product"></a>
                        <div class="media-body pt-2">
                            <h3 class="product-title font-size-base mb-2"><a href="shop-single-v1.html">TH Jeans City Backpack</a></h3>
                            <div class="font-size-sm"><span class="text-muted mr-2">Brand:</span>Tommy Hilfiger</div>
                            <div class="font-size-sm"><span class="text-muted mr-2">Color:</span>Khaki</div>
                            <div class="font-size-lg text-accent pt-2">$79.<small>50</small></div>
                        </div>
                    </div>
                    <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                        <div class="text-muted mb-2">Quantity:</div>1
                    </div>
                    <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                        <div class="text-muted mb-2">Subtotal</div>$79.<small>50</small>
                    </div>
                </div>
                <!-- Item-->
                <div class="d-sm-flex justify-content-between my-4 pb-3 pb-sm-2 border-bottom">
                    <div class="media d-block d-sm-flex text-center text-sm-left"><a class="d-inline-block mx-auto mr-sm-4" href="shop-single-v1.html" style="width: 10rem;"><img src="img/shop/cart/03.jpg" alt="Product"></a>
                        <div class="media-body pt-2">
                            <h3 class="product-title font-size-base mb-2"><a href="shop-single-v1.html">3-Color Sun Stash Hat</a></h3>
                            <div class="font-size-sm"><span class="text-muted mr-2">Brand:</span>The North Face</div>
                            <div class="font-size-sm"><span class="text-muted mr-2">Color:</span>Pink / Beige / Dark blue</div>
                            <div class="font-size-lg text-accent pt-2">$22.<small>50</small></div>
                        </div>
                    </div>
                    <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                        <div class="text-muted mb-2">Quantity:</div>1
                    </div>
                    <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                        <div class="text-muted mb-2">Subtotal</div>$22.<small>50</small>
                    </div>
                </div>
                <!-- Item-->
                <div class="d-sm-flex justify-content-between my-4">
                    <div class="media d-block d-sm-flex text-center text-sm-left"><a class="d-inline-block mx-auto mr-sm-4" href="shop-single-v1.html" style="width: 10rem;"><img src="img/shop/cart/04.jpg" alt="Product"></a>
                        <div class="media-body pt-2">
                            <h3 class="product-title font-size-base mb-2"><a href="shop-single-v1.html">Cotton Polo Regular Fit</a></h3>
                            <div class="font-size-sm"><span class="text-muted mr-2">Size:</span>42</div>
                            <div class="font-size-sm"><span class="text-muted mr-2">Color:</span>Light blue</div>
                            <div class="font-size-lg text-accent pt-2">$9.<small>00</small></div>
                        </div>
                    </div>
                    <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                        <div class="text-muted mb-2">Quantity:</div>1
                    </div>
                    <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                        <div class="text-muted mb-2">Subtotal</div>$9.<small>00</small>
                    </div>
                </div>
            </div>
            <!-- Footer-->
            <div class="modal-footer flex-wrap justify-content-between bg-secondary font-size-md">
                <div class="px-2 py-1"><span class="text-muted">Subtotal:&nbsp;</span><span>$265.<small>00</small></span></div>
                <div class="px-2 py-1"><span class="text-muted">Shipping:&nbsp;</span><span>$22.<small>50</small></span></div>
                <div class="px-2 py-1"><span class="text-muted">Tax:&nbsp;</span><span>$9.<small>50</small></span></div>
                <div class="px-2 py-1"><span class="text-muted">Total:&nbsp;</span><span class="font-size-lg">$297.<small>00</small></span></div>
            </div>
        </div>
    </div>
</div>
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
                {{-- <div class="form-inline">
                    <label class="text-light opacity-75 text-nowrap mr-2 d-none d-lg-block" for="order-sort">Sort orders:</label>
                    <select class="form-control custom-select" id="order-sort">
                        <option>All</option>
                        <option>Delivered</option>
                        <option>In Progress</option>
                        <option>Delayed</option>
                        <option>Canceled</option>
                    </select>
                </div> --}}
                <h6 class="font-size-base text-light mb-0">Lista de las órdenes que realizaste:</h6>
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
                        @php
                        $orders = $customer->orders()->paginate(10);
                        $badge = [
                        'Pendiente' => 'warning',
                        'Pagada' => 'info',
                        'Completada' => 'success',
                        ];
                        @endphp
                        {{-- @dd($customer->orders()->paginate()->links()) --}}
                        @forelse ($orders as $order)
                        <tr>
                            <td class="py-3"><a class="nav-link-style font-weight-medium font-size-sm" href="#order-details" data-toggle="modal">{{ $order->id }}</a></td>
                            <td class="py-3">{{ $order->created_at->format('d-m-Y') }}</td>
                            <td class="py-3"><span class="badge badge-{{ array_key_exists($order->order_status, $badge) ? $badge[$order->order_status]: 'secondary' }} m-0">{{ $order->order_status ?? 'Pendiente' }}</span></td>
                            <td class="py-3">{{ currencyFormat($order->total, 'CLP', true) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="py-3"><a class="nav-link-style font-weight-medium font-size-sm">No has ordenado nada aún</a></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <hr class="pb-4">
            <!-- Pagination-->
            {{ $orders->links() }}
        </section>
    </div>
</div>
@endsection
