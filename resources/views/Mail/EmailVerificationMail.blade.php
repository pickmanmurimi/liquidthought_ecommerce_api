@component('mail::message')
    # Welcome To {{ config('app.name')  }} {{ $user->first_name }}

    Your Account has been successfully created.

{{--    Click on the button below to activate your account.--}}

{{--@component('mail::button', ['url' => $url])--}}
{{--    Confirm Email--}}
{{--@endcomponent--}}
{{--    <a href="{{$url}}"> {{$url}} </a>--}}

    Thanks,
    {{ config('app.name') }}

@endcomponent
