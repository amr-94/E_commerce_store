<x-front-layout>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <form class="card login-form" method="POST" action="{{ route('two-factor.enable') }}">
                    @csrf
                    <div class="card-body">
                        <div class="title">
                            <h3>2 Factor Auth</h3>
                            <p>you can enabel/disable 2FA .</p>
                        </div>
                    </div>
                    <div class="button">
                        @if (session('status') == 'two-factor-authentication-enabled')
                            <div class="mb-4 font-medium text-sm">
                                Please finish configuring two factor authentication below.
                            </div>
                        @endif
                        @if (!$user->two_factor_secret)
                            <button class="btn" type="submit">
                                enabel
                            </button>
                        @else
                            {!! $user->twoFactorQrCodeSvg() !!}
                            @method('delete')
                            <button class="btn" type="submit">
                                disable
                            </button>
                        @endif
                    </div>
            </div>

        </div>
        </form>

    </div>
</x-front-layout>
