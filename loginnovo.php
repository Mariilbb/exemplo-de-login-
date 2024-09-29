<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Verificar se todos os campos foram preenchidos
    if (empty($usuario) || empty($senha)) {
        echo "Todos os campos devem ser preenchidos.";
        exit;
    }

    // Carregar os dados dos usuários armazenados
    $usuarios = file('usuarios.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $autenticado = false;
    foreach ($usuarios as $user) {
        list($nome, $sobrenome, $email, $senha_armazenada) = explode(';', $user);
        if ($nome === $usuario && $senha_armazenada === $senha) {
            $autenticado = true;
            break;
        }
    }

    if ($autenticado) {
        // Retorna um status para o JavaScript saber que o login foi bem-sucedido
        echo "success";
    } else {
        // Retorna um status para o JavaScript saber que o login falhou
        echo "Usuário não cadastrado.";
    }
}
?>
