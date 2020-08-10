const app = angular.module("adminTool", []);

app.controller("contentController", ($scope, $http) => {
    $scope.clientes = [];
    $scope.colaboradores = [];
    $scope.usuarios = [];
    $scope.newClietAdding = {};

    $scope.goToUpdatePage = (nombre, apellido, ccid)=>{
        location.href = "/index.php?action=updateClient&nombre="+nombre+"&apellido="+apellido+"&ccid="+ccid;
    }

    $scope.deleteClient = (nombre, apellido, ccid, sticker)=>{
        const directive = "/api/clientes?delete=true&nombre="+nombre+"&apellido="+apellido+"&ccid="+ccid+"&STICKER="+sticker;

        const request = $http.get(directive);
        request.then(
            (data)=>{console.log(data)},
            (error)=>{console.error(error)}
        );
        
        $scope.loadClients();
        $scope.$digest();
    }

    $scope.loadClients = ()=>{
        const request = $http.get("/api/clientes");
        request.then(
            (data)=>{
                $scope.clientes = data.data;
            }, 
            
            (error)=>{
                console.log(error)
            }
        );
    }

    $scope.loadClients();
    
});