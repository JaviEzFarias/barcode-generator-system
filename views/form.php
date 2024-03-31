
<div class="modal fade" id="cod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h3 class="modal-title" id="exampleModalLabel">Generar Codigo de Barras</h3>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
					<i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
	<form method="post" action="">
         
    <label for="codigo">Código de barras:</label>
		<input class="form-control" name="codigo" required type="text" id="codigo" placeholder="Introduce el codigo">

		<label for="nombre">Descripción:</label>
		<input class="form-control" name="nombre" required type="text" id="nombre" placeholder="Nombre del producto">
</body>
</html>


		<br>
		<input type="submit" value="Guardar" id="register" class="btn btn-success" 
                               name="registrar">
		<a class="btn btn-danger" href="index.php">Cancelar</a>
	</form>
</div>
<script type="text/javascript">
	$(function(){
		$('#register').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){

            var nombre = $('#nombre').val();
			var codigo = $('#codigo').val();		

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: '../includes/insertar.php',
					data: {nombre: nombre, codigo: codigo},
					success: function(data){
					Swal.fire({
								'title': '¡Mensaje!',
								'text': data,
                                'icon': 'success',
                                'showConfirmButton': 'false',
                                'timer': '1500'
								}).then(function() {
                window.location = "index.php";
            });
							
					} ,
                    
					error: function(data){
						Swal.fire({
								'title': 'Error',
								'text': data,
								'icon': 'error'
								})
					}
				});

				
			}else{
				
			}

			



		});		

		
	});
    
	
</script>


<script src="../js/sweetalert2.all.js"></script>
<script src="../js/sweetalert2.all.min.js"></script>