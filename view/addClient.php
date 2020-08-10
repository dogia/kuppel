<div class="row row-cols-1 d-flex justify-content-center">
    <form class="col-5 itemAngular register-form" action="/api/clientes" method="post" autocomplete="off">
        <h3 class="text-center">Registrar Cliente</h3>
        <label for="firstName" class="sr-only">Nombre</label>
        <input name="firstName" type="text" id="firstName" class="form-control" placeholder="Nombre" required="" autofocus="">
        
        <label for="secondName" class="sr-only">Segundo nombre</label>
        <input name="secondName" type="text" id="secondName" class="form-control" placeholder="Segundo nombre (opcional)">
        
        <label for="lastName" class="sr-only">Apellido</label>
        <input name="lastName" type="text" id="lastName" class="form-control" placeholder="Apellido" required="">
        
        <label for="secondLastName" class="sr-only">Segundo apellido</label>
        <input name="secondLastName" type="text" id="secondLastName" class="form-control" placeholder="Segundo apellido (opcional)">
        
        <label for="inputEmail" class="sr-only">Email</label>
        <input name="userEmail" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="">

        <label for="ccid" class="sr-only">Documento de identidad</label>
        <input name="ccid" type="text" id="ccid" class="form-control" placeholder="Documento" required="">

        <label for="totalBuys" class="sr-only">Total en compras</label>
        <input name="totalBuys" type="text" id="totalBuys" class="form-control" placeholder="Total en compras" required="">
        
        <div class="center"><button type="submit" class="btn btn-outline-success">Guardar</button></div>
    </form>
</div>