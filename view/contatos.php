<div class="jumbotron">
    <h3>{{titulo}}</h3>
<!--    <ui-alert title="Ops, aconteceu um problema!">-->
<!--        Não foi possivel carregar os dados-->
<!--    </ui-alert>-->
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
            <td><a href="#/detalhesContato/{{contato.id}}">{{contato.nome | name}}</a></td>
            <td>{{contato.telefone}}</td>
            <td>{{contato.operadora.nome}}</td>
            <td>{{contato.data | date:'dd/MM/yyyy'}}</td>
        </tr>
    </table>
    <hr/>
    <a class="btn btn-primary btn-block" href="#/novoContato">Novo Contato</a>
    <button class="btn btn-danger btn-block" ng-click="apagarContatos(contatos)" ng-if="isContatoSelecionado(contatos)">
        Apagar Contatos
    </button>
</div>