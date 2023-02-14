<style>
.navbar-dark .navbar-nav .nav-link {
    color: #2d415d;
}

.navbar-dark .navbar-nav .nav-link:hover, .navbar-dark .navbar-nav .nav-link:focus{
     color: #2d415d;
}
</style>
<div class="header bg-blinkswag py-6 py-lg-7 text-center">

        <a class="navbar-brand pt-0 p-3" href="{{ route('home') }}">
            <img src="https://dashboard.blinkswag.com/public/assets/img/brand/dashboard-swag.png"style="max-width:200px;"
                class="navbar-brand-img" alt="...">
                {{-- <img src="{{ asset('assets/img/brand/dashboard-swag.png') }}"style="max-width:200px;"
                class="navbar-brand-img" alt="..."> --}}
        </a>

    <div class="container">
        <div class="header-body text-center mb-7">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="text-default">
                        {{ __('Welcome to BLINKSWAG - Dropshipping Swag & Warehousing Services
                        ') }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
            xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</div>
