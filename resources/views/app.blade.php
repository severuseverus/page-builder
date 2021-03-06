<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('page-css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Slabo+27px">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen:300">
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert2.min.css') }}">

    <title>Page Builder</title>

</head>
<body>

<div id="app">
    @section('navbar')
        <nav class="navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="/"><img src="/images/pagebuilder_logo_horizontal.png" alt="Page Builder" height="50"></a>
                </div>
                @if(Auth::user())
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Administração <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/pages/list">Páginas</a></li>
                                <li><a href="/pages/new">Nova Página</a></li>
                                @can('manage', Auth::user())
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ route('templates.list') }}">Templates</a></li>
                                    <li><a href="{{ route('templates.new') }}">Novo template</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ route('template-collections.list') }}">Coleção de templates</a></li>
                                    <li><a href="{{ route('template-collections.new') }}">Nova coleçao de templates</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ route('user.list') }}">Usuários</a></li>
                                    <li><a href="{{ route('user.new') }}">Novo usuário</a></li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">Logado como: <strong>{{ Auth::user()->name }}</strong> <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('user.edit', Auth::user()->id) }}"><i class="glyphicon glyphicon-cog"></i> Alterar Dados</a></li>
                                <li><a href="/logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                @endif
            </div>
        </nav>
    @show
    @yield('content')
</div>

<script>
    Laravel = {
        csrfToken: '{{ csrf_token() }}'
    };
</script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    $('body').delegate('[data-form-link]', 'click', function (e) {
        
        var $self = $(this);
        
        function submitForm() {
            var method = $self.data('method');
            var action = $self.data('action');
            var $form = $('<form method="POST" action="' + action + '"><input type="hidden" name="_method" value="' + method + '"></form>');
            var params = $self.data('params');
            
            $form.append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
            
            if (typeof params !== 'undefined' && params != '') {
                $.each(params, function (key, p) {
                    $form.append('<input type="hidden" name="' + key + '" value="' + p + '">');
                });
            }
            
            $form.appendTo('body').submit();
            return true;
        }
        
        var confirmTitle = $self.data('confirm-title');
        var confirmText = $self.data('confirm-text');
        
        if (typeof confirmTitle !== typeof undefined && confirmTitle !== false) {
            
            swal({
                title: confirmTitle,
                html: confirmText,
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim",
                cancelButtonText: "Não",
                showLoaderOnConfirm: true
            }).then(function () {
                
                submitForm();
                
            });
            
        } else {
            submitForm();
        }
        
        e.preventDefault();
    });
    
    CKEDITOR.inlineAll();
</script>
</body>
</html>
