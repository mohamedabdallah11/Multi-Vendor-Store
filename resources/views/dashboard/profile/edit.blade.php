@extends('layouts.dashboards')

@section('title', 'Edit Profile')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@if ($errors->any())
    <div>
        <h1>Error</h1>
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

<x-alerts type="success" />
@section('content')
    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <x-form.label id="first_name">First Name</x-form.label>
            <x-form.input name="first_name" value="{{ $user->profile->first_name }}" />
        </div>

        <div class="form-group">
            <x-form.label id="last_name">Last Name</x-form.label>
            <x-form.input name="last_name" value="{{ $user->profile->last_name }}" />
        </div>

        <div class="form-group">
            <x-form.label id="birthdate">Birthdate</x-form.label>
            <x-form.input name="birthday" type="date" value="{{ $user->profile->birthday }}" />
        </div>

        <div class="form-group">
            <x-form.label id="gender">Gender</x-form.label>
            <x-form.radio name="gender" :options="['male' => 'Male', 'female' => 'Female']" value="{{ $user->profile->gender }}" :checked="$user->profile->gender" />
        </div>

        <div class="form-group">
            <x-form.label id="street_address">Address</x-form.label>
            <x-form.input name="street_address" value="{{ $user->profile->street_address }}" />
        </div>

        <div class="form-group">
            <x-form.label id="city">City</x-form.label>
            <x-form.input name="city" value="{{ $user->profile->city }}" />
        </div>

        <div class="form-group">
            <x-form.label id="state">State</x-form.label>
            <x-form.input name="state" value="{{ $user->profile->state }}" />
        </div>

        <div class="form-group">
            <x-form.label id="postal_code">Postal Code</x-form.label>
            <x-form.input name="postal_code" value="{{ $user->profile->postal_code }}" />
        </div>

        <div class="form-group">
            <x-form.label id="country">Country</x-form.label>
            <x-form.select name="country" :options="$countries" :selected="$user->profile->country" />
        </div>

        <div class="form-group">
            <x-form.label id="locale">Locale</x-form.label>
            <x-form.select name="locale" :options="$locales" :selected="$user->profile->locale" />
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
