<?php include('links.php'); ?>
<html ng-app="listaTelefonica">
<head>
    <title>Lista Telefonica</title>
    <style>
        .jumbotron {
            width: 400px;
            text-align: center;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }
        .table {
            margin-top: 20px;
        }
        .form-control {
            margin-bottom: 5px;
        }
    </style>
    <script>
        angular.module("listaTelefonica", []);
        angular.module("listaTelefonica").controller("listaTelefonicaCtrl", $scope => {
            $scope.titulo = "Lista Telefonica"; //h3, ng-bind
            $scope.contatos = [
                {nome: "Pedro", telefone: "99998888"},
                {nome: "Ana", telefone: "99998877"},
                {nome: "Maria", telefone: "99998866"}
            ];
            $scope.adicionarContato = contato => {
                $scope.contatos.push(angular.copy(contato));
                delete $scope.contato;
            };
        });
    </script>
</head>
<body ng-controller="listaTelefonicaCtrl">
<div class="jumbotron">
    <h3>{{titulo}}</h3>
    <table class="table table-striped">
        <thead>
            <th>Nome</th>
            <th>Telefone</th>
        </thead>
        <tr ng-repeat="contato in contatos">
            <td>{{contato.nome}}</td>
            <td>{{contato.telefone}}</td>
        </tr>
    </table>
    <hr/>
    <input class="form-control" type="text" ng-model="contato.nome" placeholder="Nome"/>
    <input class="form-control" type="text" ng-model="contato.telefone" placeholder="Telefone"/>
    <button class="btn btn-primary btn-block" ng-click="adicionarContato(contato)">Adicionar Contato</button>
<!--    {{contato}}-->
</div>
</body>
</html>