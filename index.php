<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>API-PHP-CURL</title>
</head>

<body>
    <h1>Dados JsonPlaceholder</h1>
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

    if (!empty($dados)) {
        echo "<table>
        <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Corpo</th>
        </tr>
        ";
        foreach ($dados as $dado) {
            echo "<tr>";
            echo "<td>" . $dado['id'] . "</td>";
            echo "<td>" . $dado['title'] . "</td>";
            echo "<td>" . $dado['body'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nao foi possivel obter os dados da API!";
    }

    ?>
</body>

</html>