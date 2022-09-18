<html>

<head>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: sans-serif;
        }

        @page {
            margin: 160px 50px;
        }

        header {
            position: fixed;
            left: 0px;
            top: -160px;
            right: 0px;
            height: 100px;
            background-color: #4e73df;
            text-align: center;
        }

        header h1 {
            margin: 10px 0;
        }

        header h2 {
            margin: 0 0 10px 0;
        }

        footer {
            position: fixed;
            left: 0px;
            bottom: -50px;
            right: 0px;
            height: 40px;
            border-bottom: 2px solid #ddd;
        }

        footer .page:after {
            content: counter(page);
        }

        footer table {
            width: 100%;
        }

        footer p {
            text-align: right;
        }

        footer .izq {
            text-align: left;
        }

    </style>

<body>

    <header>
        <img src="img/logo.png" width="100px" height="50px"alt="">
    </header>

    <footer>
        <table>
            <tr>
                <td>
                    <p class="izq">
                        sodexo
                    </p>
                </td>
                <td>
                    <p class="page">
                        Página
                    </p>
                </td>
            </tr>
        </table>
    </footer>

    <div id="content">

        <body>
            <img src="img/simulado.jpg" width="700px" height="200px" alt="">
        </body>

        <table class="table table-bordered">
            <tbody>
                @foreach ($calificacion as $list2)
                    <tr>
                        <th scope="row">Nombre</th>
                        <td colspan="3"> {{ $list2->emp_nombre }} {{ $list2->emp_apellidos}} </td>
                    </tr>
                    <tr>
                        <th scope="row">Cedula</th>
                        <td colspan="3"> {{ $list2->emp_cedula }} </td>
                    </tr>
                    <tr>
                        <th scope="row">Curso</th>
                        <td> {{ $list2->cur_nombre }} </td>
                        <th scope="row">Operacion</th>
                        <td> {{ $list2->emp_cargo }} </td>
                    </tr>
                    <tr>
                        <th scope="row">Calificacion</th>
                        <td colspan="1"> {{ $list2->cal_calificacion }}% </td>
                        <th scope="row">Puntaje</th>
                        <td colspan="1"> {{ $list2->cal_puntaje }} </td>
                    </tr>

                    @if ($list2->cal_calificacion > 60)
                        <tr>
                            <th scope="row">Resultado</th>
                            <td colspan="3"> Aprueba </td>
                            <th scope="row" colspan="1" style="background-color: #7EFF2B;"></th>
                        </tr>
                    @else
                        <tr>
                            <th scope="row">Resultado</th>
                            <td colspan="3"> Recapacitación en limpieza y desinfección </td>
                            <th scope="row" colspan="1" style="background-color: #FC4D4A ;"></th>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <br>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Pregunta N°</th>
                    <th scope="col">Correcta</th>
                    <th scope="col">Incorrecta</th>
                    <th scope="col">Consejo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($respuestas as $list)
                    <tr>
                        <td>{{ $list->pre_id }}</td>

                        @if ($list->res_respuesta == 1)
                            <td style="background-color: #7EFF2B;"></td>
                            <td></td>
                        @else
                            <td></td>
                            <td style="background-color: #FC4D4A ;"></td>
                        @endif

                        <td>{{ $list->pre_consejo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
