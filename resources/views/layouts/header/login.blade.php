<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            @auth
                @php
                    $route = Request::path();
                    $path = explode("/",$route);
                @endphp

                @if($path[0] == 'customer')
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <span class="m-2 text-white">Ir a la web</span>
                    </a>
                @else
                    <a href="{{ route('customer.dashboard', Auth::user()->id) }}" class="text-decoration-none">
                        <span class="m-2 text-white">Ir al panel</span>
                    </a>
                @endif

                <a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-decoration-none">
                    <span class="m-2 text-white">Salir</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <a href="{{ route('customer.index') }}" class="text-decoration-none">
                    <span class="m-2 text-white">Crea tu cuenta</span>
                </a>
                <a href="{{ route('login') }}" class="text-decoration-none">
                    <span class="m-2 text-white">Ingresa</span>
                </a>
            @endauth
        </div>
    </div>
</div>
