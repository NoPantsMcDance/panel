@section('unix::notice')
    @if (config('app.debug', false))
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger">
                    Your Panel has debug mode enabled. You should disable it by setting <code>APP_DEBUG=false</code> in your
                    environment file. Debug mode should only be enabled when needed as it can be a potential security risk
                </div>
            </div>
        </div>
    @endif
@endsection

