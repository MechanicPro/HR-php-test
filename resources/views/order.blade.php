@include('header')
<div class="content">
    <div class="title m-b-md">
        <h1>Список заказов</h1>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Номер заказа</th>
            <th>Название партнера</th>
            <th>Стоимость заказа</th>
            <th>Состав заказа</th>
            <th>Статус заказа</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td><a href="/order{{$order -> id}}">{{$order -> id}}</a></td>
                <td>{{$order -> partners_name}}</td>
                <td>{{$order -> price}}</td>
                <td id="per">{{$order -> names}}</td>
                <td>{{$order -> status}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <?php echo $orders->render(); ?>
</div>
@include('footer')