<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon fa fa-cog'></i> Settings</a></li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
	<ul class="nav-dropdown-items">
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
	</ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('country') }}'><i class='nav-icon la la-question'></i> Countries</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('region') }}'><i class='nav-icon la la-question'></i> Regions</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('province') }}'><i class='nav-icon la la-question'></i> Provinces</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('commune') }}'><i class='nav-icon la la-question'></i> Communes</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('currency') }}'><i class='nav-icon la la-question'></i> Currencies</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('businessactivity') }}'><i class='nav-icon la la-question'></i> BusinessActivities</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tax') }}'><i class='nav-icon la la-question'></i> Taxes</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('invoicetype') }}'><i class='nav-icon la la-question'></i> InvoiceTypes</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('unit') }}'><i class='nav-icon la la-question'></i> Units</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('company') }}'><i class='nav-icon la la-question'></i> Companies</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('branch') }}'><i class='nav-icon la la-question'></i> Branches</a></li>
