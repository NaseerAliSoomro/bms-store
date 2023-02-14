@auth()
    @include('store::layouts.navbars.navs.auth')
@endauth

@guest()
    @include('store::layouts.navbars.navs.guest')
@endguest
