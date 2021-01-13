@hasSection('breadcrumb')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                @yield('breadcrumb')
            </div>
        </div>
    </section>
@else
    @isset($siteBreadcrumb)
        <section class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @if (Route::has('home'))
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}">Главная</a>
                                    </li>
                                @endif
                                @foreach ($siteBreadcrumb as $item)
                                    <li class="breadcrumb-item{{ $item->active ? ' active' : '' }}">
                                        @if ($item->active)
                                            {{ $item->title }}
                                        @else
                                            <a href="{{ $item->url }}">
                                                {{ $item->title }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    @endisset
@endif