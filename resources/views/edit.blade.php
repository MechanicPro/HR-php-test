@include('header')
<div class="content">
    <div class="title m-b-md">
        <h1>Редактирование заказа</h1>
    </div>

    <div id="lbl">
        <span class="label label-info">Количество продуктов: <?php echo count($orders)?></span>
    </div>

    <form action="/order/{{$orders[0]->id}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="count" value="<?php echo count($orders)?>">
        @foreach ($orders as $key => $order)
            <div class="input-group">
                <span class="input-group-addon">Email клиента</span>
                <input id="msg" type="text" class="form-control" name="email_cli_{{$key}}" placeholder="Additional Info"
                       value={{$order -> email_cli}}>
            </div>
            <div class="input-group">
                <span class="input-group-addon">Продукты</span>
                <input id="msg" type="text" class="form-control" name="names_{{$key}}" placeholder="Additional Info"
                       value={{$order -> names}}>
            </div>
            <div class="input-group">
                <span class="input-group-addon">Стоимость заказ</span>
                <input id="msg" type="text" class="form-control" name="price_{{$key}}" placeholder="Additional Info"
                       value={{$order -> price}}>
            </div>
            <hr class="hr">
        @endforeach

        <div class="input-group">
            <span class="input-group-addon">Номер заказа</span>
            <input id="msg" readonly type="text" class="form-control" name="id" placeholder="Additional Info"
                   value={{$order -> id}}>
        </div>
        <div class="input-group">
            <span class="input-group-addon">Название партнера</span>
            <input id="msg" type="text" class="form-control" name="partners_name" placeholder="Additional Info"
                   value={{$order -> partners_name}}>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <label for="sel1">Статус заказа:</label>
                <select class="form-control" id="sel1_s" onclick="OnSelectionChange(this)">
                    <option value="0">Новый</option>
                    <option value="10">Подтвержден</option>
                    <option value="20">Завершен</option>
                </select>
                <div class="input-group">
                    <span class="input-group-addon">Статус заказа</span>
                    <input id="msg_s" readonly type="text" class="form-control" name="status_num"
                           placeholder="Additional Info"
                           value={{$order -> status_num}}>
                </div>
            </div>
        </div>
        <button type='submit' class="btn btn-success">Сохранить</button>
    </form>
</div>
@include('footer')