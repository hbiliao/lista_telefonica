<div class="jumbotron">
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
</div>