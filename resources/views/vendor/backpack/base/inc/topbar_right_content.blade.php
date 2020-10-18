<!-- This file is used to store topbar (right) items -->


{{-- <li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-bell"></i><span class="badge badge-pill badge-danger">5</span></a></li>
<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-list"></i></a></li>
<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-map"></i></a></li> --}}

@php
    $roles = backpack_user()->getRoleNames();
@endphp

@if( backpack_user()->branches()->count() > 1 )
<li class="nav-item dropdown pr-4">
    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <strong>{{ backpack_user()->current()->branch->name }}</strong> ({{ $roles[0] }})
    </a>
    <div class="dropdown-menu {{ config('backpack.base.html_direction') == 'rtl' ? 'dropdown-menu-left' : 'dropdown-menu-right' }} mr-4 pb-1 pt-1">
        @php($companies = backpack_user()->branches->groupBy(function ($branch) { return $branch->companies->first()->name; }))

        @foreach ($companies as $key => $branches)
            <h6 class="dropdown-header"><strong>{{ $key }}</strong></h6>

            @foreach ($branches as $branch)
                <a class="dropdown-item" href="{{ route('set_current_branch', $branch->id) }}">{{ $branch->name }}</a>
            @endforeach

            @if($companies->count() > 1 && !$loop->last)
                <div class="dropdown-divider"></div>
            @endif
        @endforeach
    </div>
</li>
@endif
