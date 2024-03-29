<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <h3>
                error occured
            </h3>
            <ul>
                @foreach ($errors->all() as $errors)
                    <li>{{ $errors }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
