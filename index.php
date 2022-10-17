<?php 
    $xml                = simplexml_load_file('assets/dados.xml');
    $data_nasc          = $_GET['data_nasc'];
    $unixTimestamp_nasc = strtotime($data_nasc);
    $data_nasc          = explode('-', $data_nasc);
    $ano_nasc           = $ano_nasc_original = $data_nasc[0];
    $mes_nasc           = $data_nasc[1];
    $signo              = '';
    $caracteristicas    = '';

    foreach ($xml as $item) {
        $data_inicio = explode('/', $item->data_inicio);
        $data_fim = explode('/', $item->data_fim);

        $mes_inicio = $data_inicio[1];
        $dia_inicio = $data_inicio[0];

        $data_inicio = $ano_nasc . '-' . $mes_inicio . '-' . $dia_inicio;

        $mes_fim = $data_fim[1];
        $dia_fim = $data_fim[0];

        $data_fim       = $ano_nasc . '-' . $mes_fim . '-' . $dia_fim;

        $ano_nasc = $mes_nasc == 1 && $mes_inicio == 12 ? $ano_nasc - 1 : $ano_nasc_original;
        
        $data_inicio    = $ano_nasc . '-' . $mes_inicio . '-' . $dia_inicio;

        $unixTimestamp_fim = strtotime($data_fim);
        $unixTimestamp_inicio = strtotime($data_inicio);

        if ($unixTimestamp_nasc >= $unixTimestamp_inicio && $unixTimestamp_nasc <= $unixTimestamp_fim) {
            $signo = $item->nome;
            $caracteristicas = $item->caracteristicas;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Signos</title>
</head>
    <body>
        <div class="container">
            <h1>Vamos descobrir as<br> caracteristicas  do seu signo!</h1>
            <form action="" method="GET" class="form">
                <div>
                    <input class="date" id="birthDate" type="date" name="data_nasc">
                    <button class="btn" type="submit">Pesquisar</button>
                </div>
                <div id="text"> <span>Seu signo é: </span><?=$signo?></div>
                <div id="caracteristicas"> <span>Caracteristicas: </span><?=$caracteristicas?></div>
            </form>
        </div>
    </body>
</html>