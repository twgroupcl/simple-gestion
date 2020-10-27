<!-- Sidebar-->
<aside class="col-lg-4 pt-4 pt-lg-0">
    <div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0">
        <div class="px-4 mb-4">
            <div class="media align-items-center">
                <div class="media-body pl-3">
                    <h3 class="font-size-base mb-0">{{ $customer->first_name }}</h3><span class="text-accent font-size-sm">{{ $customer->email }}</span>
                </div>
            </div>
        </div>
        <div class="bg-secondary px-4 py-3">
            <h3 class="font-size-sm mb-0 text-muted">Panel</h3>
        </div>
        <ul class="list-unstyled mb-0">
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ route('customer.order') }}"><i class="czi-bag opacity-60 mr-2"></i>Órdenes<span class="font-size-sm text-muted ml-auto"></span></a></li>
            {{-- <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-wishlist.html"><i class="czi-heart opacity-60 mr-2"></i>Wishlist<span class="font-size-sm text-muted ml-auto">3</span></a></li>
            <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-tickets.html"><i class="czi-help opacity-60 mr-2"></i>Support tickets<span class="font-size-sm text-muted ml-auto">1</span></a></li> --}}
        </ul>
        <div class="bg-secondary px-4 py-3">
            <h3 class="font-size-sm mb-0 text-muted">Configuraciones de la cuenta</h3>
        </div>
        <ul class="list-unstyled mb-0">
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 {{ route('customer.profile') == url()->current() ? 'active' : '' }}" href="{{ route('customer.profile') }}"><i class="czi-user opacity-60 mr-2"></i>Perfil</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 {{ route('customer.address') == url()->current() ? 'active' : '' }}" href="{{ route('customer.address') }}"><i class="czi-location opacity-60 mr-2"></i>Direcciones</a></li>
            {{-- <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-payment.html"><i class="czi-card opacity-60 mr-2"></i>Payment methods</a></li> --}}
            <li class="d-lg-none border-top mb-0">
                <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="czi-sign-out opacity-60 mr-2"></i> Cerrar sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>
