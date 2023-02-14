
<style>
.col-6.collapse-brand a img {
    display: none;
}
form.mt-4.mb-3.d-md-none {
    display: none;
}

.navbar-nav {

    font-size: 14px !important;
}

.navbar-nav .dropdown-menu {

    font-size: 14px !important;
}

.navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus{

    border-bottom: 1px solid #1d2b46;
    transition: .2s;
}
.bg-blinkswag {

    display: none;
}

.text-default {
    color: #172b4d !important;
    letter-spacing: 2px;
}
.form-control {

    border-radius: 5px;
}
.table .thead-light th {
    color: #172b4d !important;
    background-color: #ffffff;
    font-weight: bold !important;
    font-size: 12px !important;
}

nav#sidenav-main {
    margin-bottom: 0px !important;
}
ul li {


    font-size: 14px!important;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light" id="sidenav-main"style="box-shadow: 0px 0px 10px 2px lightgrey;padding-top: 30px;padding-bottom: 30px;position: fixed;z-index: 555;background: white;    width: 100%;">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            {{-- naseer --}}
            <img src="{{ ('public/assets/img/brand/dashboard-swag.png') }}"style="max-width:200px;"
            class="navbar-brand-img" alt="...">
            {{-- <img src="https://dashboard.blinkswag.com/public/assets/img/brand/dashboard-swag.png"style="max-width:200px;"
                class="navbar-brand-img" alt="..."> --}}
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <i class="ni ni-single-02"></i>
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            {{-- naseer --}}
                            <img src="{{ ('public/assets/img/brand/swag.png') }}" >
                            {{-- <img src="https://dashboard.blinkswag.com/public/assets/img/brand/swag.png" > --}}
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">

            <div class="dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover="dropdown">
  Transactions
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

  <li class="nav-item">
        <a class="nav-link" href="{{ route('salesorders') }}">
            {{ __('Orders') }}
        </a>
    </li>

  <li class="nav-item">
                    <a class="nav-link" href="{{ route('estimates') }}">
                       {{ __('Estimates') }}
                    </a>
                </li>



                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('packages') }}">
                         {{ __('Shipments') }}
                    </a>
                </li>



  <li class="nav-item">
                    <a class="nav-link" href="{{ route('invoices') }}">

                        <span class="nav-link-text">Invoices</span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('payments') }}">
                        {{ __('Payments') }}
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shareorders') }}">
                        {{ __('Gift Urls') }}
                    </a>
                </li>
  </div>
</div>






                {{-- <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Laravel Examples') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('User profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                @auth()
                    @if (Auth::user()->id_category != null)
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('inventory') }}">
                              {{ __('Inventory') }}
                            </a>
                        </li>
                    @endif
                @endauth


                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('redeem_page') }}">
                    {{ __('Redeem Page') }}
                    </a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('redeem_page_updated') }}">
                        {{ __('Redeem Page') }}
                    </a>
                </li>

                <div class="dropdown">

                        <a class="nav-link dropdown-toggle" href="{{ route('warehouse') }}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover="dropdown">
                        Services</a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" id="drpmenu">
                <li class="nav-item">
                            <a class="nav-link" href="{{ route('warehouse') }}">

                                <span class="nav-link-text">Warehouse</span>
                            </a>
                        </li>
                <li class="nav-item">
                            <a class="nav-link" href="/createinventory">

                                <span class="nav-link-text">Create Inventory</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/storagecalculator">
                                {{ __('Storage Calculator') }}
                            </a>
                        </li>


                </div>
                </div>




                <div class="dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover="dropdown">
  Resources
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('addresses') }}">
                        {{ __('Addresses') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer"
                        href="{{ route('reviews')}}" >
                      {{ __('Design Reviews') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer"
                        href="{{route('get_token')}}">
                        {{ __('Access Token') }}
                    </a>
                </li>
  </div>
</div>


                @auth()
                    @if (Auth::user()->id_category != null)

					@if (Auth::user()->order_new == 1)
						 <li class="nav-item">
                        <a class="nav-link" href="{{ url('products') }}">
                               {{ __('Create Order') }}
                        </a>
                        </li>
					@else
                        <li class="nav-item">
                            <a class="nav-link btn btn-default" href="{{ url('products') }}" style="color: white !important;">
                                {{ __('Create Order') }}
                            </a>
                        </li>
					@endif
                    @endif
                @endauth




            </ul>

            <form action="https://blinkswag.com/modules/RFQ/sitelogin.php" method="POST" id="loginform">
                <button type="submit" style="display:none" id="logincustomersubmit">submit</button>
            </form>
            <form action="https://blinkswag.com/modules/crello/sitelogin.php" method="POST" id="loginform2">
                <input type="hidden" name="redirect" value="https://dashboard.blinkswag.com/my-project">
                <button type="submit" style="display:none" id="logincustomersubmit2">submit</button>
            </form>
        </div>
        <ul class="navbar-nav align-items-center d-none d-md-flex"style="margin-left: 5%;">
            <li class="nav-item dropdown">
                <a class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <div class="media-body d-none d-lg-block">
                            <span class=" text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="https://blinkswag.com/module/customsignin/signout" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
            <li>
                <a class="nav-link" href="https://dashboard.blinkswag.com/cart">
                    <?php \Cart::session(Auth::user()->id); ?>
                    <i class="ni ni-cart"></i>
                    <span class="icon-button__badge"
                        style="top: 30px;">{{ Cart::getTotalQuantity() }}</span>
                    </span>
                </a>
            </li>
            @php
                $not_count = 0;
            @endphp
            @foreach ($notifications as $notification)
                @if ($notification->readed == 0)
                    @php
                        $not_count++;
                    @endphp
                @endif
            @endforeach

            <li class="nav-item dropdown">
                <a class="nav-link pr-0 notification-badges" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold"><i style="font-size: 16px;left: -10px;"
                                    class="ni ni-bell-55"></i>
                                @if ($not_count != 0)<span
                                        class="icon-button__badge">{{ $not_count }}</span> @endif
                            </span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" id="notifications">
                    @if ($not_count == 0)
                        <div class="dropdown-item">No new notifications</div>
                    @else
                        <a style="float: right;margin-right: 10px;font-size: 12px;cursor: pointer;"
                            onclick="markallasread()">Mark all as read</a>
                        @include('store::layouts.navbars.navs.notifications')
                    @endif
                </div>
            </li>
        </ul>
    </div>
</nav>
