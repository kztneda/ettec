<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
    <style>
    .custom-file-input ~ .custom-file-label::after {
        content: "Browse...";
    }
</style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>Temperaturas</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form id="formulario">
                    <div class="form-group">
                        <label for="archivos">Archivos</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" placeholder="Browse..." class="custom-file-input" accept=".csv" id="archivos" name="archivos">
                                <label class="custom-file-label" for="archivos">Elegir archivo CSV</label>
                            </div>

                        </div>
                        <small class="form-text text-muted">Seleccione el archivo de las ubicaciones.</small>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <h3>Resultado</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr></tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $('#formulario').submit(function(s){
            s.preventDefault();
            const datos = new FormData(this);

            $.ajax({
                url: "file.php",
                type: "POST",
                dataType: "JSON",
                data: datos,
                cache: false,
                contentType: false,
                processData: false
            }).always(function(respuesta){
                $.each(respuesta.headers, function(k,v){
                    const tmp = $('<th/>',{
                        text: v,
                        scope: "col"
                    })
                    $('thead tr').append(tmp)
                })
                $.each(respuesta.body, function(k,v){
                    let tr = $('<tr/>');
                    $.each(v, function(k2,v2){
                        tr.append( (k2 == 0) ? 
                            $('<th/>',{
                                text: v2,
                                scope: 'row'
                            }) :
                            $('<td/>',{
                                text: v2
                            })
                        )
                    })
                    $('tbody').append(tr)
                })
            })
        })
    </script>
</body>
</html>