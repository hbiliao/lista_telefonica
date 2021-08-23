<?php

include('links.php'); ?>
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

        .negrito {
            font-weight: bold;
        }
    </style>
    <script>
        angular.module("listaTelefonica", ["ngMessages"]);
        angular.module("listaTelefonica").controller("listaTelefonicaCtrl", $scope => {
            $scope.titulo = "Lista Telefonica"; //h3, ng-bind
            $scope.contatos = [
                {nome: "Pedro", telefone: "99998888", cor: "blue"},
                {nome: "Ana", telefone: "99998877", cor: "yellow"},
                {nome: "Maria", telefone: "99998866", cor: "red"}
            ];
            $scope.operadoras = [
                {nome: "Oi", codigo: 14, categoria: "Celular"},
                {nome: "Vivo", codigo: 15, categoria: "Celular"},
                {nome: "Tim", codigo: 41, categoria: "Celular"},
                {nome: "GVT", codigo: 25, categoria: "Fixo"},
                {nome: "Embratel", codigo: 21, categoria: "Fixo"}
            ];
            $scope.adicionarContato = contato => {
                $scope.contatos.push(angular.copy(contato));
                delete $scope.contato;
                $scope.contatoForm.$setPristine();
            };
            $scope.apagarContatos = contatos => {
                $scope.contatos = contatos.filter(contato => {
                    if (!contato.selecionado)
                        return contato
                });
            };
            $scope.isContatoSelecionado = contatos => contatos.some(contato => contato.selecionado);

        });
    </script>
</head>
<body ng-controller="listaTelefonicaCtrl">
<div class="jumbotron">
    <h3>{{titulo}}</h3>
    <table ng-show="contatos.length > 0" class="table table-striped">
        <thead>
        <th></th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Operadora</th>
        <th></th>
        </thead>
        <tr ng-class="{'negrito': contato.selecionado}" ng-repeat="contato in contatos">
            <td><input type="checkbox" ng-model="contato.selecionado"/></td>
            <td>{{contato.nome}}</td>
            <td>{{contato.telefone}}</td>
            <td>{{contato.operadora.nome}}</td>
            <td>
                <div style="width: 20px; height: 20px;" ng-style="{'background-color': contato.cor}"></div>
            </td>
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
                ng-options="operadora.codigo as operadora.nome group by operadora.categoria for operadora in operadoras">
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