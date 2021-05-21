<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NoAVA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

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
        <div class="conteiner" style="margin: 30px">
            <div class="position-relative">
                <h1 class="fw-bold text-center bg-primary p-2 text-white">NoAVA</h1>
            </div>
            @foreach ($allQuestions as $value)
                <span>{!!$value['questao']->Enunciado!!}</span>
                <span>A. {!!str_replace("<br>", "", $value['alternativas'][0]->Texto)!!}</span><br>
                <span>B. {!!str_replace("<br>", "", $value['alternativas'][1]->Texto)!!}</span><br>
                <span>C. {!!str_replace("<br>", "", $value['alternativas'][2]->Texto)!!}</span><br>
                <span>D. {!!str_replace("<br>", "", $value['alternativas'][3]->Texto)!!}</span><br>
                @foreach ($value['alternativas'] as $correta)
                    @if ($correta->Correta == "S")
                        @if ($correta->Texto == $value['alternativas'][0]->Texto)
                        ANSWER: A
                        @endif                 
                        @if ($correta->Texto == $value['alternativas'][1]->Texto)
                        ANSWER: B
                        @endif                 
                        @if ($correta->Texto == $value['alternativas'][2]->Texto)
                        ANSWER: C
                        @endif                 
                        @if ($correta->Texto == $value['alternativas'][3]->Texto)
                        ANSWER: D
                        @endif                
                    @endif
                @endforeach
                <hr>
            @endforeach
        </div>
    </body>
</html>
