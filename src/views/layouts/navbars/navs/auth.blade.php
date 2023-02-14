<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-default text-uppercase d-none d-lg-inline-block"
            href="{{ route('home') }}">{{ __('Dashboard') }}</a>
        <!-- Form -->
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
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
                <a class="nav-link pr-0" href="https://dashboard.blinkswag.com/cart">
                    <?php \Cart::session(Auth::user()->id); ?>
                    <i class="ni ni-cart"></i>
                    <span class="icon-button__badge"
                        style="top: 15px;right: 6.5%;">{{ Cart::getTotalQuantity() }}</span>
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
<script>
    function markallasread(elem) {
        $.ajax({
            url: "/notifications",
            type: 'POST', // http method
            data: {
                func: 'update_notification',
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')

            },
            success: function(response) {
                location.reload();
            }
        })
    }

</script>
