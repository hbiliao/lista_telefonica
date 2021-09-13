angular.module("listaTelefonica").service("operadorasAPI", function ($http, config) {

    this.getOperadoras = () => $http.get(config.baseUrl + "/operadoras.php");

});