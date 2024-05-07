<x-front-layout>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <form class="card login-form" method="POST" action="{{ route('two-factor.login') }}">
                    @csrf
                    <div class="card-body">
                        <div class="title">
                            <h3>Challinge</h3>
                            <p>Enter Qr code</p>
                        </div>
                    </div>
                    @if ($errors->has('code'))
                        <div class="alert alert-danger"> {{ $errors->first('code') }}</div>
                    @endif
                    <div class="form-group input-group">
                        <label for="">2FA code </label>
                        <input type="text" class="form-control" name="code">
                    </div>
                    <div class="button">
                        <button class="btn" type="submit"> submit</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</x-front-layout>
