<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3">
            @yield("raw-header-title")

            @hasSection('header-title')
                <div class="col-auto d-none d-sm-block">
                    <h3>@yield('header-title')</h3>
                </div>
            @endif

            @include("mbober-starter::admin-kit.breadcrumb")
        </div>
    </div>

    @include("mbober-starter::admin-kit.messages")

    @hasSection("content")
        <section class="content-section">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    @endif

    @yield("contents")

    @hasSection("links")
        <section class="links-section">
            <div class="container-fluid">
                @yield('links')
            </div>
        </section>
    @endif

    @yield('rawContent')
</main>
