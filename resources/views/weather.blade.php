@include('header');
<div class="content">
    <div class="title m-b-md">
        <h1>Прогноз погоды <span class="label label-default"><?php echo $info['slug']; ?></span></h1>
    </div>
    <?php $current_date_time = $info['tzinfo']['offset'] + $now ?>
    <div class="panel panel-primary">
        <div class="panel-heading">Погода на <?php echo date('d-m-Y H:i', $current_date_time); ?></div>
        <div class="panel-body">
            <div class="panel panel-info">
                <div class="panel-heading">Текущая температура</div>
                <div class="panel-body"><?php echo $fact['temp']; ?> &degC</div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Ощущаемая температура</div>
                <div class="panel-body"><?php echo $fact['feels_like']; ?> &degC</div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Облачность</div>
                <div id="cloud" class="panel-body"><img
                            src="https://yastatic.net/weather/i/icons/blueye/color/svg/<?php echo $fact['icon']; ?>.svg">
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Скрость ветра</div>
                <div class="panel-body"><?php echo $fact['wind_speed']; ?> м/с</div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Давление</div>
                <div class="panel-body"><?php echo $fact['pressure_mm']; ?> мм рт. ст.</div>
            </div>
        </div>
    </div>
</div>
@include('footer');