<!DOCTYPE html>
<html>
<head>
    <title>Players Online</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body style="background-color: #003366;"> <!-- Fundo azul marinho -->

    <h1 style="color: white;">Players Online</h1> <!-- Título em branco -->

    <table class="players-table"> <!-- Tabela para listar os jogadores -->
        <tr>
            <th>Name</th>
            <th>Level</th>
            <th>Vocation</th>
        </tr>
        <?php
        $apiUrl = 'https://api.tibiadata.com/v3/guild/taseif';
        $response = file_get_contents($apiUrl);
        $guildData = json_decode($response, true);

        // Verifica se a guilda foi encontrada e se os membros estão definidos
        if (isset($guildData['guild']) && isset($guildData['guild']['members'])) {
            $members = $guildData['guild']['members'];

            // Função para ordenar os jogadores pelo nível em ordem decrescente
            usort($members, function($a, $b) {
                return $b['level'] - $a['level'];
            });

            // Itera sobre os membros da guilda e exibe as informações na tabela
            foreach ($members as $member) {
                if ($member['status'] === 'online') {
                    echo '<tr>';
                    echo '<td>' . $member['name'] . '</td>';
                    echo '<td>' . $member['level'] . '</td>';
                    echo '<td>' . $member['vocation'] . '</td>';
                    echo '</tr>';
                }
            }
        } else {
            echo '<tr><td colspan="3">Não foi possível obter os dados da guilda ou os dados não estão no formato esperado.</td></tr>';
        }
        ?>
    </table>
</body>
</html>