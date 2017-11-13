@foreach($orderData as $d)
    <h2>Name: {{ $d->name}}</h2>
    <h2>Email: {{ $d->email }}</h2>
    <h2>Country: {{ $d->country }}</h2>
    <h2>City: {{ $d->city }}</h2>
    <h2>Street: {{ $d->street }}</h2>
    @foreach($d->basket->items as $item)

        <ul>
            <li>{{ $item['price'] }} $</li>
            {{ $item['item']['name'] }} | {{$item['qty']}}


            <ul>
                <li>Total Price: {{ $d->basket->totalPrice }}</li>
            </ul>
        </ul>
    @endforeach
@endforeach