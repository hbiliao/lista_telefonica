angular.module("listaTelefonica").controller("novoContatoCtrl", function ($scope, contatosAPI, serialGenerator, $location, operadoras) {

    //console.log(operadoras)
    $scope.operadoras = operadoras.data;

    $scope.adicionarContato = contato => {
        contatosAPI.saveContato(contato).then(() => {
            delete $scope.contato;
            $scope.contatoForm.$setPristine();
            $location.path("/contatos");
            //carregarContatos();
        });
    };
});