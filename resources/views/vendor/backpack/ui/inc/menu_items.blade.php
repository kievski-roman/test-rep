{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Car brands" icon="la la-question" :link="backpack_url('car-brand')" />

<x-backpack::menu-item title="Drivers" icon="la la-question" :link="backpack_url('driver')" />
<x-backpack::menu-item title="Buses" icon="la la-question" :link="backpack_url('bus')" />
