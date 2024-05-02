<div>
    @if (session()->has('sucsess'))
    <div class="alert alert-success">
        {{ session('sucsess') }}
    </div>
@endif
</div>