<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('home')}}">
        <i class=" fas fa-building"></i><span>{{trans('validation.home')}}</span></a>
</li>

@can('roles')
    <li class="{{ Request::is('roles*') ? 'active' : '' }}">
        <a href="{{ route('roles.index') }}"><i
                class="fa fa-user-circle"></i><span> @lang('models/roles.plural')</span></a>
    </li>
@endcan


@can('admins,clients')
<li class="side-menus">
    <a data-toggle="collapse" href="#collapseExample1">
        <i class="fa fa-users"></i> <span> {{__('validation.users_menu')}} </span>
    </a>
    <ul class="collapse {{ Request::is('drivers*') ||  Request::is('users*') ||  Request::is('clients*') ? 'show' : '' }} collapse-body"
        id="collapseExample1">

        @can('admins')
            <li class="side-menus {{ Request::is('users*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}"><i class="fa fa-users"></i><span>{{__('validation.users')}}</span></a>
            </li>
        @endcan

        @can('clients')
            <li class="{{ Request::is('clients*') ? 'active' : '' }}">
                <a href="{{ route('clients.index') }}"><i
                        class="fa fa-users"></i><span>@lang('models/clients.plural')</span></a>
            </li>
        @endcan



    </ul>
</li>
@endcan

@can('ContactUs')
<li class="side-menus">
    <a data-toggle="collapse" href="#collapseExample3">
        <i class="fa fa-spinner"></i> <span> @lang('models/settings.plural') </span>
    </a>

    <ul class="collapse {{ Request::is('get-terms-conditions') || Request::is('get-about_app')

         ||  Request::is('contactus') ||  Request::is('get-setting') ||
          Request::is('policies*')  ? 'show' : '' }}  collapse-body" id="collapseExample3">


          <li class="{{ Request::is('get-about_app') ? 'active' : '' }}">
            <a href="{{ route('show_about_app') }}"><i
                    class="fa fa-spinner"></i><span>@lang('models/aboutapp.plural')</span></a>
        </li>

        <li class="{{ Request::is('contactus*') ? 'active' : '' }}">
            <a href="{{ route('show_contactus') }}"><i
                    class="fa fa-spinner"></i><span>@lang('models/contactuses.plural')</span></a>
        </li>


        <li class="{{ Request::is('get-terms-conditions') ? 'active' : '' }}">
            <a href="{{ route('show_Terms_condition') }}"><i
                    class="fa fa-spinner"></i><span>@lang('models/termsConditions.plural')</span></a>
        </li>

        <li class="{{ Request::is('get-policies') ? 'active' : '' }}">
            <a href="{{ route('show_policies') }}"><i
                    class="fa fa-spinner"></i><span>@lang('models/policies.plural')</span></a>
        </li>
    </ul>
</li>
@endcan

@can('regions')
<li class="{{ Request::is('regions*') ? 'active' : '' }}">
    <a href="{{ route('regions.index') }}"><i
            class="fa fa-globe"></i><span> @lang('models/regions.plural')</span></a>
</li>
@endcan

@can('cities')
<li class="{{ Request::is('cities*') ? 'active' : '' }}">
    <a href="{{ route('cities.index') }}"><i
            class="fa fa-city"></i><span> @lang('models/cities.plural')</span></a>
</li>
@endcan

@can('districts')
<li class="{{ Request::is('districts*') ? 'active' : '' }}">
    <a href="{{ route('districts.index') }}"><i
            class="fa fa-building"></i><span> @lang('models/districts.plural')</span></a>
</li>
@endcan

@can('bike_types')
<li class="{{ Request::is('bike_types*') ? 'active' : '' }}">
    <a href="{{ route('bike_types.index') }}"><i
            class="fa fa-bicycle"></i><span> @lang('models/bike_types.plural')</span></a>
</li>
@endcan

@can('bikes')
<li class="{{ Request::is('bikes*') ? 'active' : '' }}">
    <a href="{{ route('bikes.index') }}"><i
            class="fa fa-motorcycle"></i><span> @lang('models/bikes.plural')</span></a>
</li>
@endcan

@can('contact_messages')
<li class="{{ Request::is('contacts*') ? 'active' : '' }}">
    <a href="{{ route('contacts.index') }}"><i
            class="fa fa-comment"></i><span> @lang('models/contacts.plural')</span></a>
</li>
@endcan

@can('discoundCodes')
<li class="{{ Request::is('discount_codes*') ? 'active' : '' }}">
    <a href="{{ route('discount_codes.index') }}"><i
            class="fa fa-tag"></i><span> @lang('models/discount_codes.plural')</span></a>
</li>
@endcan

@can('offers')
<li class="{{ Request::is('offers*') ? 'active' : '' }}">
    <a href="{{ route('offers.index') }}"><i
            class="fa fa-tags"></i><span> @lang('models/offers.plural')</span></a>
</li>
@endcan

@can('general_settings')
<li class="{{ Request::is('general_setting*') ? 'active' : '' }}">
    <a href="{{ route('general_setting.edit') }}">
        <i class="fa fa-spinner"></i>
        <span> @lang('models/general_settings.plural')</span></a>
</li>
@endcan

<li class="side-menus">
    <a data-toggle="collapse" href="#collapseExample5">
        <i class="fa fa-bell"></i> <span> {{__('validation.notifications')}} </span>
    </a>
    <ul class="collapse {{ Request::is('notifications') || Request::is('get-send-notification') ? 'show' : '' }}  collapse-body"
        id="collapseExample5">
        <li class="{{ Request::is('notifications*') ? 'active' : '' }}">
            <a href="{{ route('notifications.index') }}"><i
                    class="fa fa-bell"></i><span>@lang('validation.receive')</span></a>
        </li>

        <li class="{{ Request::is('get-send-notification') ? 'active' : '' }}">
            <a href="{{ route('notification.get-notification-sended') }}"><i
                    class="fa fa-bell"></i><span>@lang('validation.sended')</span></a>
        </li>

    </ul>
</li>





@section('scripts')

    <script>
        $(document).click(function (e) {
            if (!$(e.target).is('.collapse-body')) {
                $('.collapse').collapse('hide');
            }
        });
    </script>
@endsection
