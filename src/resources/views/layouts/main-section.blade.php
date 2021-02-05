@if (View::hasSection("content") || View::hasSection("contents"))
    <main class="main-section @yield('main-section-class')">
        @hasSection('sidebar')
            <div class="container">
                <div class="row">
                    @hasSection('header-upper-title')
                        <section class="col-12 under-content-section">
                            <div class="row @yield('header-upper-title-cover-class', 'header-upper-title-cover')">
                                <div class="col-12">
                                    <h1>@yield('header-upper-title')</h1>
                                </div>
                            </div>
                        </section>
                    @endif

                    @yield("raw-header-upper-title")

                    <aside class="d-none d-lg-block col-lg-3 sidebar-section @yield('aside-class')">
                        @yield('sidebar')
                    </aside>

                    <section class="col-12 col-lg-9 content-section @yield('page-class')">
                        @yield('content')
                    </section>
                </div>
            </div>
        @else
            @include('mbober-starter::layouts.content')
        @endif
    </main>
@endif