@extends('MonobankStatement::layouts.app')
@section('title', 'Сформувати виписку Monobank')
@section('content')
    <form class="form-signin" action="/check_token" method="post">
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal text-muted">monobank | Universal Bank</h1>
            <p>Для отримання виписки введіть токен. Можете отримати в особистому кабінеті <a href="https://api.monobank.ua/" target="_blank">https://api.monobank.ua/</a></p>
        </div>
        <div class="form-label-group">
            <input type="text" id="inputXToken" name="x_token" class="form-control" placeholder="Token для особистого доступу до API" required autofocus>
            <label for="inputXToken">X-Token</label>
        </div>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" name="remember_token" value="1"> Запамʼятати токен
            </label>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-lg btn-primary btn-block" type="submit">Далі</button>
    </form>
@endsection
