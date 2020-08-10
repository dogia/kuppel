<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 d-flex justify-content-center">
    <div class="col itemAngular" ng-repeat="cliente in clientes">
        <h3 class="text-center">{{cliente.nombre}}</h3><br>

        <b>Nombre:</b> {{cliente.nombre}} {{cliente.segundoNombre | limitTo:1}} {{cliente.apellido}} {{cliente.segundoApellido}} <br>
        <b>Documento:</b> {{cliente.ccid}} <br>
        <b>Correo:</b> {{cliente.email}} <br>
        <b>Compras:</b> {{cliente.totalCompras | currency}} <br>

        <div class="center btns-angular">
            <!---->
            <button name="delete" value="true" type="button" class="btn btn-outline-danger" ng-click="deleteClient(cliente.nombre, cliente.apellido, cliente.ccid, '<?php echo $_SESSION["sticker"];?>')">Delete</button>
            <button name="update" value="true" type="button" class="btn btn-outline-warning" ng-click="goToUpdatePage(cliente.nombre, cliente.apellido, cliente.ccid)">Update</button>

        </div>
    </div>
</div>