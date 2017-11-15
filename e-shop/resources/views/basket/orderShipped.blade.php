<br>
<div class="panel panel-info book_info" style="width: 45%; display:inline-block; float: left">
    <div class="panel-heading">Your name:</div>
    <div class="panel-body"> {{ auth()->user()->name }}</div>
</div>
<div class="panel panel-info book_info" style="width: 45%; display:inline-block; float: right">
    <div class="panel-heading">Your email:</div>
    <div class="panel-body"> {{ auth()->user()->email }}</div>
</div>
<br>
@foreach($orderData as $data)
    <h2>Order data: {{ $data->created_at}}</h2>
    <h2>Name: {{ $data->name}}</h2>
    <h2>Email: {{ $data->email }}</h2>
    <h2>Country: {{ $data->country }}</h2>
    <h2>City: {{ $data->city }}</h2>
    <h2>Street: {{ $data->street }}</h2>
    @foreach($data->basket->items as $item)
        <ul>
            <div class="panel panel-primary book_info" style="width: 25%; display:inline-block;">
                <div class="panel-heading">Title:</div>
                <div class="panel-body" style="height: 120px;">"{{ $item['item']['name'] }}"</div>
            </div>
            <div class="panel panel-success book_info" style="width: 15%; display:inline-block;">
                <div class="panel-heading">Author:</div>
                <div class="panel-body">{{ $item['item']['writer'] }}</div>
            </div>
            <div class="panel panel-info book_info" style="width: 15%; display:inline-block;">
                <div class="panel-heading">Quantity:</div>
                <div class="panel-body">{{ $item['qty'] }}</div>
            </div>
            <div class="panel panel-danger book_info" style="width: 15%; display:inline-block;">
                <div class="panel-heading">Price:</div>
                <div class="panel-body price">${{ $item['price'] }}</div>
            </div>
        </ul>
    @endforeach
        <div class="panel panel-danger book_info">
            <div class="panel-heading">Total Price:</div>
            <div class="panel-body price">${{ $data->basket->totalPrice }}</div>
        </div>
        <hr class="hr" color="black">
@endforeach
