<?php
    require "./src/config/db.php";
    
    $filters = [
        "nombre" => $_GET["nombre"],
        "apellido" => $_GET["apellido"],
        "ccid" => (int)$_GET["ccid"]
    ];

    

    $mdb = new mongodb("dbUser", "dogiaAtlas", "cluster.oxs3r.gcp.mongodb.net", "kuppel", "clientes");
    $userToUpdate = json_decode($mdb->getDocuments($filters, ['limit' => 1]), true);
    $userToUpdate = $userToUpdate[0];
?>

<div class="row row-cols-1 d-flex justify-content-center">
    <form class="col-5 itemAngular register-form" action="/api/clientes" method="get" autocomplete="off">
        <h3 class="text-center">Actualizar Cliente</h3>
        <label for="firstName" class="sr-only">Nombre</label>
        <input name="firstName" type="text" id="firstName" class="form-control" value="<?php echo $userToUpdate["nombre"]; ?>" required="" autofocus="">
        
        <label for="secondName" class="sr-only">Segundo nombre</label>
        <input name="secondName" type="text" id="secondName" class="form-control" value="<?php echo $userToUpdate["segundoNombre"]; ?>">
        
        <label for="lastName" class="sr-only">Apellido</label>
        <input name="lastName" type="text" id="lastName" class="form-control" value="<?php echo $userToUpdate["apellido"]; ?>" required="">
        
        <label for="secondLastName" class="sr-only">Segundo apellido</label>
        <input name="secondLastName" type="text" id="secondLastName" class="form-control" value="<?php echo $userToUpdate["segundoApellido"]; ?>">
        
        <label for="inputEmail" class="sr-only">Email</label>
        <input name="userEmail" type="email" id="inputEmail" class="form-control" value="<?php echo $userToUpdate["email"]; ?>" required="">

        <label for="ccid" class="sr-only">Documento de identidad</label>
        <input name="ccid" type="text" id="ccid" class="form-control" value="<?php echo $userToUpdate["ccid"]; ?>" required="">

        <label for="totalBuys" class="sr-only">Total en compras</label>
        <input name="totalBuys" type="text" id="totalBuys" class="form-control" value="<?php echo $userToUpdate["totalCompras"]; ?>" required="">

        <input type="text" name="update" value="<?php echo $userToUpdate["_id"]["\$oid"] ?>" class="d-none">
        <input type="text" name="STICKER" value="<?php echo $_SESSION["sticker"] ?>" class="d-none">
        
        <div class="center"><button type="submit" class="btn btn-outline-success">Guardar</button></div>
    </form>
</div>