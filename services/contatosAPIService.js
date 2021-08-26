angular.module("listaTelefonica").factory("contatosAPI", function($http, config) {

	let _getContatos =  () => $http.get(config.baseUrl + "/contatosBackend.php");

	let _saveContato = contato => $http.post(config.baseUrl + "/contatosBackend.php", contato)

	return {
		getContatos: _getContatos,
		saveContato: _saveContato
	};

});