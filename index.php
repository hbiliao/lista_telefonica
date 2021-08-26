<?php

include('importacoes.php'); ?>

<html ng-app="listaTelefonica">
<head>
    <title>Lista Telefonica</title>
</head>
<body ng-controller="listaTelefonicaCtrl">
<div class="jumbotron">
    <h3>{{titulo}}</h3>
    <ui-alert title="Ops, aconteceu um problema!">
        Não foi possivel carregar os dados
    </ui-alert>
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
            <td>{{contato.nome | name | ellipsis:10 }}</td>
            <td>{{contato.telefone}}</td>
            <td>{{contato.operadora.nome}}</td>
            <td>{{contato.data | date:'dd/MM/yyyy'}}</td>
        </tr>
    </table>
    <hr/>
    <form name="contatoForm">
        <input class="form-control" type="text" ng-model="contato.nome" name="nome" ng-required="true" ng-minlength="10"
               placeholder="Nome" autocomplete="off"/>
        <input class="form-control" type="text" ng-model="contato.telefone" name="telefone" ng-required="true"
               placeholder="Telefone"
               ng-pattern="/^\d{4,5}-\d{3,4}$/"/>
        <input class="form-control" type="text" ng-model="contato.data" name="data" placeholder="Data" ui-date/>
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
<div ng-include="'view/footer.php'"></div>
</body>
</html>