<?php

include('links.php'); ?>
<html ng-app="listaTelefonica">
<head>
    <title>Lista Telefonica</title>
    <style>
        .jumbotron {
            width: 720px;
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

        .negrito {
            font-weight: bold;
        }
    </style>
    <script>
        angular.module("listaTelefonica", ["ngMessages"]);
        angular.module("listaTelefonica").controller("listaTelefonicaCtrl", ($scope, $http) => {
            $scope.titulo = "Lista Telefonica"; //h3, ng-bind
            $scope.contatos = [];
            $scope.operadoras = [];

            var carregarContatos = () => {
                $http.get("http://localhost/contatosBackend.php").then(response => $scope.contatos = response.data);
            };

            var carregarOperadoras = () => {
                $http.get("http://localhost/operadoras.php").then(response => $scope.operadoras = response.data);
            };

            $scope.adicionarContato = contato => {
                contato.data = new Date();
                $http.post("http://localhost/contatosBackend.php", contato).then(() => {
                    delete $scope.contato;
                    $scope.contatoForm.$setPristine();
                    carregarContatos();
                });
            };

            $scope.apagarContatos = contatos => {
                $scope.contatos = contatos.filter(contato => {
                    if (!contato.selecionado)
                        return contato
                });
            };
            $scope.isContatoSelecionado = contatos => contatos.some(contato => contato.selecionado);

            $scope.ordenarPor = campo => {
                $scope.criterioDeOrdenacao = campo;
                $scope.direcaoDaOrdenacao = !$scope.direcaoDaOrdenacao;
            };

            carregarContatos();
            carregarOperadoras();

        });
    </script>
</head>
<body ng-controller="listaTelefonicaCtrl">
<div class="jumbotron">
    <h3>{{titulo}}</h3>
    <input class="form-control" type="text" ng-model="criterioDeBusca" placeholder="O que você está buscando?"/>
    <table ng-show="contatos.length > 0" class="table table-striped">
        <thead>
        <th></th>
        <th><a href="" ng-click="ordenarPor('nome')">Nome</a></th>
        <th><a href="" ng-click="ordenarPor('telefone')">Telefone</a></th>
        <th>Operadora</th>
        <th>Data</th>
        </thead>
        <tr ng-class="{'negrito': contato.selecionado}"
            ng-repeat="contato in contatos | filter:criterioDeBusca | orderBy:criterioDeOrdenacao:direcaoDaOrdenacao">
            <td><input type="checkbox" ng-model="contato.selecionado"/></td>
            <td>{{contato.nome}}</td>
            <td>{{contato.telefone}}</td>
            <td>{{contato.operadora.nome}}</td>
            <td>{{contato.data | date:'dd/MM/yyyy HH:mm'}}</td>
        </tr>
    </table>
    <hr/>
    <form name="contatoForm">
        <input class="form-control" type="text" ng-model="contato.nome" name="nome" ng-required="true" ng-minlength="10"
               placeholder="Nome" autocomplete="off"/>
        <input class="form-control" type="text" ng-model="contato.telefone" name="telefone" ng-required="true"
               placeholder="Telefone"
               ng-pattern="/^\d{4,5}-\d{3,4}$/"/>
        <select class="form-control" ng-model="contato.operadora"
                ng-options="operadora.nome + ' ( ' + (operadora.preco | currency) + ' )' for operadora in operadoras | orderBy:'nome'">
            <option value="">Selecione uma operadora</option>
        </select>
    </form>
    <div ng-show="contatoForm.nome.$dirty" ng-messages="contatoForm.nome.$error">
        <div ng-message="required" class="alert alert-danger">
            Por favor, preencha o campo nome!
        </div>
        <div ng-message="minlength" class="alert alert-danger">
            O campo nome deve ter no mínimo 10 caracteres.
        </div>
    </div>

    <div ng-show="contatoForm.telefone.$error.required && contatoForm.telefone.$dirty" class="alert alert-danger">
        Por favor, preencha o campo telefone!
    </div>
    <div ng-show="contatoForm.telefone.$error.pattern" class="alert alert-danger">
        O campo telefone deve ter o formato DDDDD-DDDD.
    </div>

    <button class="btn btn-primary btn-block" ng-disabled="contatoForm.$invalid"
            ng-click="adicionarContato(contato)">Adicionar Contato
    </button>
    <button class="btn btn-danger btn-block" ng-click="apagarContatos(contatos)" ng-if="isContatoSelecionado(contatos)">
        Apagar Contatos
    </button>
</div>
<div ng-include="'footer.php'"></div>
</body>
</html>