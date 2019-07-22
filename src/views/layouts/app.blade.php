<!doctype html>
<html lang="uk" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Сторінка генерує виписку по рахункам відкритим в Monobank.">
    <meta name="author" content="Igor Karpov">
    <title>Виписка з Монобанк - @yield('title')</title>
    <style>
        .form-signin{width:100%;max-width:420px;padding:15px;margin:auto}.form-label-group{position:relative;margin-bottom:1rem}.form-label-group > input,.form-label-group > label{height:3.125rem;padding:.75rem}.form-label-group > label{position:absolute;top:0;left:0;display:block;width:100%;margin-bottom:0;line-height:1.5;color:#495057;pointer-events:none;cursor:text;border:1px solid transparent;border-radius:.25rem;transition:all .1s ease-in-out}.form-label-group input::-webkit-input-placeholder{color:transparent}.form-label-group input:-ms-input-placeholder{color:transparent}.form-label-group input::-ms-input-placeholder{color:transparent}.form-label-group input::-moz-placeholder{color:transparent}.form-label-group input::placeholder{color:transparent}.form-label-group input:not(:placeholder-shown){padding-top:1.25rem;padding-bottom:.25rem}.form-label-group input:not(:placeholder-shown) ~ label{padding-top:.25rem;padding-bottom:.25rem;font-size:12px;color:#777}.form-label-group input::-ms-input-placeholder{color:#777}@media all and (-ms-high-contrast: none),(-ms-high-contrast: active){.form-label-group > label{display:none}.form-label-group input:-ms-input-placeholder{color:#777}}.bd-placeholder-img{font-size:1.125rem;text-anchor:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}@media (min-width: 768px){.bd-placeholder-img-lg{font-size:3.5rem}}.footer{background-color:#f5f5f5;font-size:.75rem}
    </style>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @yield('head_scripts')
</head>
<body class="d-flex flex-column h-100">
<main role="main" class="flex-shrink-0">
    @yield('content')
</main>
<footer class="footer mt-auto py-3 d-print-none">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            <span class="text-muted">
            <p>Виписка доступна виключно за посиланням.<br>
                Виписка згенерована з використанням <a href="https://api.monobank.ua">api.monobank.ua</a></p>
            <p>&copy; <?php echo date('Y');?> Зроблено в Україні. У разі знайдених неточностей звертайтесь за адресою
                i@karpov.cc</p>
        </span>
            </div>
            <div class="col-md-4">
            <span class="text-muted">
                <a href="/">Головна</a> | <a href="https://github.com/karpovigorok/monobank-statement">GitHub</a> | <a href="https://send.monobank.com.ua/vKN2YZ25">Підтримати</a>
            </span>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
