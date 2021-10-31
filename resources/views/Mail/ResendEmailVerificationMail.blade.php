@component('mail::message')
    # Verify your email {{ $user->first_name }}

    Click on the button below to verify your account.

@component('mail::button', ['url' => $url])
    Confirm Email
@endcomponent

<a href="{{$url}}"> {{$url}} </a>

    Thanks,
    {{ config('app.name') }}

@endcomponent
