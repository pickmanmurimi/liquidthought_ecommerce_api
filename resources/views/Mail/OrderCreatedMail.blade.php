@component('mail::message')
    # Your order has been placed {{ $user->first_name }}

    The following Items will be delivered to you

@component('mail::table')
| Item   | Price |
|--------|-------|
@foreach( $order->OrderItems as $OrderItem )
| {{ $OrderItem->item->name }} | {{ $OrderItem->item->unit_price }} |
@endforeach
@endcomponent

    We are delivering this items to:
    {{ $order->address->full_name }}

    {{ $order->address->address }}


    Thanks,
    {{ config('app.name') }}

@endcomponent
