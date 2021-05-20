<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NoAVA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="conteiner" style="margin: 30px">
        <form action="{{route('matriculas')}}" method="get">
            <button class="btn btn-primary btn-sm" style="margin-bottom: 30px">MATRÍCULAS</button>
        </form>
        @if (@$matriculas)
            <div class="table-responsive">
                <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>MatriculaID</th>
                            <th>Nome Aluno</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Situacao</th>
                            <th>CursoID</th>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($matriculas as $matricula)
                        <tr>
                            <td>{{$matricula->MatriculaID}}</td>
                            <td>{{$matricula->Aluno}}</td>
                            <td>{{$matricula->CPF}}</td>
                            <td>{{$matricula->Email}}</td>
                            <td>{{$matricula->SituacaoDescricao}}</td>
                            <td>{{$matricula->CursoID}}</td>
                            <td>{{$matricula->Curso}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
            <div class="justify-center" style="margin-top: 40px">
                <hr>
                <h4>CONSULTA DE CONTEUDO DOS DISCIPLINAS</h4>
                <div class="row ">
                    <div class="col-5">
                        <form action="{{route('pdf.links')}}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">DIGITE A MATRICULA</span>
                                <input type="number" class="form-control" name="matriculaID" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">DIGITE O ID DO CURSO</span>
                                <input name="cursoID" type="number" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" type="number">DIGITE O CÓDIGO DA DISCIPLINA</span>
                                <input  name="disciplinaID" type="number" class="form-control" required>
                            </div>
                            <p align="right">
                                <button class="btn btn-primary btn-sm">BUSCAR</button>
                            </p>
                        </form>
                        <hr>
                    </div>
                </div>
                @if (@$disciplinas)
                    <h4>Resumo de Disciplinas</h4>
                    @foreach($disciplinas as $disciplina)
                        <h6>URL de PDF: <a href="https://sigma.noava.com.br/iesde/public/pdf/{{$disciplina->DisciplinaID}}/{{$matriculaID}}" target="_blank">https://sigma.noava.com.br/iesde/public/pdf/{{$disciplina->DisciplinaID}}/{{$matriculaID}}</a></h6><hr>
                        <h6>Disciplina ID: {{$disciplina->DisciplinaID}}</h6>
                        <h6>Curso ID: {{$disciplina->CursoID}}</h6>
                        <h6>Nome Disciplina: {{$disciplina->computed}}</h6><hr>
                        <b>Ementa:</b> {{$disciplina->Ementa}}<br><br><hr>
                        <b>Plano Aula:</b> {!!str_replace( ["?", "<br>"], ["", ""], $disciplina->PlanoAula)!!}<hr>
                        <h6><b>Aulas:</b></h6>
                        @foreach($aulas as $aula)
                            @foreach($aula as $value)
                                @if (isset($value->DisciplinaID))
                                    @if($value->DisciplinaID == $disciplina->DisciplinaID)
                                        <p><b>Nome Aula: </b>{{$value->Tema}}</p>
                                        <h6>URL do video: <a href="https://sigma.noava.com.br/iesde/public/video/{{$value->AulaID}}/{{$value->MatriculaID}}" target="_blank">https://sigma.noava.com.br/iesde/public/video/{{$value->AulaID}}/{{$value->MatriculaID}}</a></h6>
                                        <a href="{{route( 'formattingAlternatives' , $value->DisciplinaID)}}"><button class="btn btn-primary btn-sm" style="margin-bottom: 30px;">Banco de Questões</button></a>
                                    @endif                      
                                @endif
                            @endforeach
                        @endforeach
                        <hr>
                    @endforeach
                @endif
            </div>
        </div>
    </body>
</html>
