angular.module("listaTelefonica").config(function ($routeProvider, $locationProvider) {
    $locationProvider.hashPrefix('');
    $routeProvider.when("/contatos", {
        templateUrl: "view/contatos.php",
        controller: "listaTelefonicaCtrl",
        resolve: {
            contatos: function (contatosAPI) {
                return contatosAPI.getContatos();
            },
            operadoras: function (operadorasAPI) {
                return operadorasAPI.getOperadoras();
            }
        }
    });
    $routeProvider.when("/novoContato", {
        templateUrl: "view/novoContato.php",
        controller: "novoContatoCtrl",
        resolve: {
            operadoras: function (operadorasAPI) {
                return operadorasAPI.getOperadoras();
            }
        }
    });
    $routeProvider.when("/detalhesContato/:id", {
        templateUrl: "view/detalhesContato.php",
        controller: "detalhesContatoCtrl",
        resolve: {
            contato: function (contatosAPI, $route) {
                return contatosAPI.getContato($route.current.params.id);
            }
        }
    });
    $routeProvider.otherwise({redirectTo: "/contatos"});
});