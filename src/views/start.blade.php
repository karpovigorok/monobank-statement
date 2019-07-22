@extends('MonobankStatement::layouts.app')
@section('title', 'Отримати')
@section('head_scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endsection
@section('content')
    <form class="form-signin" action="/statement" method="post">
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal text-muted">monobank | Universal Bank</h1>
            <p>Сформувати виписку для <?php echo $client_name;?></p>
        </div>
        <p class="text-muted">Максимальний час за який можливо отримувати виписку 31 доба. Обмеження на використання -
            не частіше ніж 1 раз у 60 секунд.</p>
        <div class="">
            <?php
            if(sizeof($accounts) == 1):
            $account = $accounts[0];
            ?>
            <input type="hidden" name="account_id" value="<?php echo $account['id'];?>"
                   id="account_<?php echo $account['currency']['numeric'];?>">
            <?php
            else:
            foreach($accounts as $key => $account):?>
            <input <?php echo $key == 0 ? 'checked' : '';?> type="radio" name="account_id"
                                                            value="<?php echo $account['id'];?>"
                                                            id="account_<?php echo $account['currency']['numeric'];?>">
            <label style="margin-right: 10px;"
                   for="account_<?php echo $account['currency']['numeric'];?>"><?php echo $account['currency']['alpha3'];?></label>
            <?php
            endforeach;
            endif;?>
        </div>
        <div class="form-label-group">
            <input type="text" name="datetimes" id="daterange" class="form-control" placeholder="виберіть період"
                   required/>
            <label for="inputXToken">виберіть період</label>
        </div>
        {{ csrf_field() }}
        <input type="hidden" name="startDate" id="startDate" value="">
        <input type="hidden" name="endDate" id="endDate" value="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Отримати</button>
        <a href="/forget_xtoken" class="btn btn-lg btn-danger btn-block" type="button">Забути мій токен</a>
    </form>
<script>
    $(function () {
        var start = moment().subtract(1, 'days');
        var end = moment();
        var day_30_back = moment().subtract(30, 'days');
        function cb(start, end) {
            $("#startDate").val(start.format('YYYY-MM-DD hh:mm A'));
            $("#endDate").val(end.format('YYYY-MM-DD hh:mm A'));
        }

        $('#daterange').daterangepicker({
            maxDate: end,
            minDate: day_30_back,
            timePicker: true,
            startDate: start,
            endDate: end,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            },
            autoApply: true,
            timePicker24Hour: true
        }, cb);
        cb(start, end);
    });
</script>
@endsection

