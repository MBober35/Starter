@yield("raw-header-title")

@hasSection('header-title')
    <section class="header-title">
        <div class="container">
            <div class="row @yield('header-title-cover-class', 'header-title-cover')">
                <div class="col-12">
                    <h1>@yield('header-title')</h1>
                </div>
            </div>
        </div>
    </section>
@endif

@hasSection("content")
    <section class="content-section">
        <div class="container">
            @yield('content')
        </div>
    </section>
@endif

@yield("contents")

@hasSection("links")
    <section class="links-section">
        <div class="container">
            @yield('links')
        </div>
    </section>
@endif

@yield("main-bottom")