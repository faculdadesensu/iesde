<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
            @foreach ($allQuestions as $value)
                <span><b>Disciplina ID: </b>{{$value['questao']->DisciplinaID}}</span><br>
                <span><b>Formato Questao: </b>{{$value['questao']->FormatoQuestao}}</span><br><br>
                <span><b>Enunciado: </b>{!!$value['questao']->Enunciado!!}</span><br>
                    @foreach ($value['alternativas'] as $alternativa) 
                        <span><b>Alternativa: </b>{!!str_replace("<br>", "", $alternativa->Texto)!!}</span>
                        <span><b>Correta? </b>{{$alternativa->Correta}}</span><br>
                    @endforeach
                <br><br><hr>
            @endforeach
    </body>
</html>
