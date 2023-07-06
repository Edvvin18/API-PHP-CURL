<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>API-PHP-CURL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


</head>

<body>
    <h1>Dados JsonPlaceholder</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <?php
    $json_url = "https://jsonplaceholder.typicode.com/posts";

    function buscarDados($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $exe = curl_exec($ch);
        curl_close($ch);
        return json_decode($exe, true);
    }

    $dados = buscarDados($json_url);

    // Definir o número máximo de registros por página
    $registrosPorPagina = 10;

    // Obter o número da página atual
    $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcular o deslocamento
    $deslocamento = ($paginaAtual - 1) * $registrosPorPagina;

    // Obter os registros da página atual
    $registrosPagina = array_slice($dados, $deslocamento, $registrosPorPagina);

    if (!empty($registrosPagina)) {
        echo "<table class='table table-stripped'>
        <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Corpo</th>
        </tr>
        ";
        foreach ($registrosPagina as $dado) {
            echo "<tr>";
            echo "<td>" . $dado['id'] . "</td>";
            echo "<td>" . $dado['title'] . "</td>";
            echo "<td>" . $dado['body'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Criar links de paginação
        echo "<div class='table'>";
        $totalRegistros = count($dados);
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

        for ($i = 1; $i <= $totalPaginas; $i++) {
            $link = "?pagina=$i";
            if ($i == $paginaAtual) {
                echo "<span class='current'>$i  </span>";
            } else {
                echo "<a href='$link'>$i  </a>";
            }
        }
        echo "</div>";
    } else {
        echo "Nao foi possivel obter os dados da API!";
    }
    ?>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>