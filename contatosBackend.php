<?php

$post = file_get_contents("php://input");
$contato = json_decode($post);

if (!empty($post)) {
    $contato = get_object_vars($contato);
    $contato['operadora'] = get_object_vars($contato['operadora']);
    $contatos = unserialize($_COOKIE['api_contatos'] ?? "");
    $contato['id'] = count(array($contatos)) + 1;
    $contatos[] = $contato;
    setcookie('api_contatos', serialize($contatos));
}

if (isset($_COOKIE['api_contatos'])) {
    $contatos = unserialize($_COOKIE['api_contatos']);
}

$contatos[] = array(
    'id' => 1,
    'nome' => "Pedro Luiz dos Santos",
    "telefone" => "9999-2222",
    'data' => date('d/m/Y'),
    'operadora' => ['nome' => "Oi", 'codigo' => 14, 'categoria' => "Celular"]
);

$contatos[] = array(
    'id' => 2,
    'nome' => "Ana assis Carvalho",
    "telefone" => "9999-3333",
    'data' => date('d/m/Y', strtotime('+1 week')),
    'operadora' => ['nome' => "Oi", 'codigo' => 14, 'categoria' => "Celular"]
);

$contatos[] = array(
    'id' => 3,
    'nome' => "Maria do bairro Porré",
    "telefone" => "9999-9999",
    'data' => date('d/m/Y'),
    'operadora' => ['nome' => "Oi", 'codigo' => 14, 'categoria' => "Celular"]
);

echo json_encode($contatos);

?>