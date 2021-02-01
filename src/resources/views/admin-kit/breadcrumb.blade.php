@hasSection('breadcrumb')
    <div class="col-auto ms-auto text-right mt-n1">
        @yield('breadcrumb')
    </div>
@else
    @isset($siteBreadcrumb)
        <div class="col-auto ms-auto text-right mt-n1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @if (Route::has('admin.dashboard'))
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Главная</a>
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
    @endisset
@endif