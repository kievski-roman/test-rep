
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
    </a>
</li>

<x-backpack::menu-item title="Car brands" icon="la la-industry" :link="backpack_url('car-brand')" />
<x-backpack::menu-item title="Buses" icon="la la-bus" :link="backpack_url('bus')" />


<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('driver') }}">
        <i class="la la-id-card"></i> Водії
    </a>
</li>


<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('driver') }}?former=1">
        <i class="la la-user-times"></i> Колишні водії
    </a>
</li>
