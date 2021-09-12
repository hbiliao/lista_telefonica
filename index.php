<?php include('importacoes.php'); ?>

<html ng-app="listaTelefonica">
<head>
    <title>Lista Telefonica</title>
</head>
<body ng-controller="listaTelefonicaCtrl">
<div ng-view></div>
<div ng-include="'view/footer.php'"></div>
</body>
</html>