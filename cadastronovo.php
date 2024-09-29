<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $sobrenome = $_POST['sobrenome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirma_senha = $_POST['confirma_senha'] ?? '';
    $dia = $_POST['dia'] ?? '';
    $mes = $_POST['mes'] ?? '';
    $ano = $_POST['ano'] ?? '';

    // Verificar se todos os campos foram preenchidos
    if (empty($nome) || empty($sobrenome) || empty($email) || empty($senha) || empty($confirma_senha) || empty($dia) || empty($mes) || empty($ano)) {
        echo "Todos os campos devem ser preenchidos.";
        exit;
    }

    // Verificar se as senhas coincidem
    if ($senha !== $confirma_senha) {
        echo "As senhas não coincidem.";
        exit;
    }

    // Verificar se a senha tem mais de 10 caracteres
    if (strlen($senha) <= 10) {
        echo "Deve gravar uma senha forte.";
        exit;
    }

    // Verificar idade
    $data_nascimento = "$ano-$mes-$dia";
    $idade = (int)((time() - strtotime($data_nascimento)) / (60 * 60 * 24 * 365.25));
    if ($idade < 18) {
        echo "Usuário deve ter mais do que 18 anos.";
        exit;
    }

    // Verificar e-mail institucional
    if (!preg_match('/@pucpr\.br$|@pucpr\.edu\.br$/', $email)) {
        echo "Somente é permitido cadastrar um e-mail institucional da PUCPR.";
        exit;
    }

    // Armazenar dados do usuário em um arquivo
    $user_data = "$nome;$sobrenome;$email;$senha\n";
    file_put_contents('usuarios.txt', $user_data, FILE_APPEND);

    echo "Gravado com sucesso.";
}
?>
