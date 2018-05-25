@include('header')
<div class="content">
    <div class="title m-b-md">
        <h1>Список заказов (Дополнение)</h1>
    </div>
    Сортировать: <a href="/product&sort=0"><span class="badge">по наименованию продукта</span></a>
                 <a href="/product&sort=1"><span class="badge">по цене</span></a>
                 <a href="/product"><span class="label label-danger">по умолчанию</span></a>
    <input id="tk" type="hidden" name="_token" value="{{csrf_token()}}">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Номер продукта</th>
            <th>Наименование продукта</th>
            <th>Наименование поставщика</th>
            <th>Цена</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $key => $product)
            <tr>
                <td>{{$product -> id}}</td>
                <td>{{$product -> product_name}}</td>
                <td>{{$product -> vendors_name}}</td>
                <td class="mycursor" id="inputTD_{{$key}}" onclick="OnSelectionInput({{$product -> price}}, {{$key}}, {{$product -> id}})">{{$product -> price}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <?php echo $products->render(); ?>
</div>
@include('footer')