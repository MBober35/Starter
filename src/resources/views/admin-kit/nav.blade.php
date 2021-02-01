<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('home') }}">
            <span class="align-middle">
                {{ config('app.name', 'Laravel') }}
            </span>
        </a>

        <ul class="sidebar-nav">
            @includeIf($leftMenu ?? "")
        </ul>
    </div>
</nav>
