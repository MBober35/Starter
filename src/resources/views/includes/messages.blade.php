@if (session('danger') || session('success') || session('status'))
    <section class="messages-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(session('danger'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('danger') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('status'))
                        <div class="alert alert-primary" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif