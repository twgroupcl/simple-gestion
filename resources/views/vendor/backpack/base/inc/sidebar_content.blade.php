<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

@hasanyrole('Super admin|Administrador')
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-lock"></i> Seguridad</a>
	<ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Usuarios</span></a></li>
        @can('permission.role')
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permisos</span></a></li>
        @endcan
	</ul>
</li>
@endhasanyrole

@hasanyrole('Super admin')
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-gear"></i> Configuración</a>
	<ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-gear'></i> Configuración</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('country') }}'><i class='nav-icon la la-globe'></i> Países</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('region') }}'><i class='nav-icon la la-globe'></i> Regiones</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('province') }}'><i class='nav-icon la la-globe'></i> Provincias</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('commune') }}'><i class='nav-icon la la-globe'></i> Comunas</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('currency') }}'><i class='nav-icon la la-dollar'></i> Monedas</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('businessactivity') }}'><i class='nav-icon la la-cubes'></i> Giros</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('tax') }}'><i class='nav-icon la la-calculator'></i> Impuestos</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('invoicetype') }}'><i class='nav-icon la la-exchange'></i> Documentos electrónicos</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('unit') }}'><i class='nav-icon la la-arrows-h'></i> Unidades</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('company') }}'><i class='nav-icon la la-building'></i> Empresas</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('branch') }}'><i class='nav-icon la la-sitemap'></i> Sucursales</a></li>
	</ul>
</li>

<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-lightbulb-o"></i> Atributos</a>
	<ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('attributemodule') }}'><i class='nav-icon la la-plus-square'></i> Módulos</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('attributefamily') }}'><i class='nav-icon la la-th-large'></i> Familiar</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('attribute') }}'><i class='nav-icon la la-check-square'></i> Atributos</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('attributegroup') }}'><i class='nav-icon la la-table'></i> Grupos</a></li>
	</ul>
</li>
@endhasanyrole

@canany(['customer.list'])
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-user"></i> Clientes</a>
	<ul class="nav-dropdown-items">
        @can('customer.list')
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customer') }}'><i class='nav-icon la la-user'></i> Clientes</a></li>
        @endcan
	</ul>
</li>
@endcanany
