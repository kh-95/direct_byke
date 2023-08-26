<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
{{--            <form role="search" class="navbar-form-custom" action="">--}}

{{--                <div class="form-group">--}}
{{--                    <input type="text" placeholder="Search for transaction..." class="form-control" name="top_search"--}}
{{--                           id="top-search">--}}
{{--                </div>--}}
{{--            </form>--}}
        </div>

        <ul class="nav navbar-top-links navbar-right">

{{--            <li>--}}
{{--                <span class="m-r-sm text-muted welcome-message">Welcome to Services center management {{auth()->user()->name}}.</span>--}}
{{--            </li>--}}
            <li>

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form1').submit();">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
                <form id="logout-form1" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>

    </nav>
</div>


