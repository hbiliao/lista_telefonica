angular.module("listaTelefonica").controller("listaTelefonicaCtrl", function($scope, contatosAPI, operadorasAPI) {
    $scope.titulo = "Lista Telefonica"; //h3, ng-bind
    $scope.contatos = [];
    $scope.operadoras = [];

    var carregarContatos = () => {
        contatosAPI.getContatos().then(response => $scope.contatos = response.data);
    };

    var carregarOperadoras = () => {
        operadorasAPI.getOperadoras().then(response => $scope.operadoras = response.data);
    };

    $scope.adicionarContato = contato => {
        contatosAPI.saveContato(contato).then(() => {
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