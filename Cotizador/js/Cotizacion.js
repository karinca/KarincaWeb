//============== Variables globales

	var isError = false;
	var error = "";
	var entidad = "";
	var nombre = "";
	var rut = "";
	var telefono ="";
	var email = "";
	var comentario = "";
	var servicio = "";

//============== Eventos
$(document).ready(function(){
	
		$("#modal-cotizacion").modal("show");
	$("#enviar").click(function(){
		console.log("click");
		validarForm();
	});		
	
	$('#Entidad').change(function () {
		entidad = $(this).val();
		console.log(entidad);
	});
	$('#servicio').change(function () {
		servicio = $(this).val();
		console.log(servicio);
	});

	$("#volverEI").click(function(){
		$("#modal").modal("hide");
	});

	$("#cotizar").click(function(){
		$("#modal-cotizacion").modal("show");
	});

});

//================Funciones

function validarForm(){

	nombre = $("#nombre").val();
	rut = $("#rut").val();
	telefono = $("#telefono").val();
	email = $("#email").val();
	comentario = $("#comentario").val();
	
	if ((entidad == "" || entidad == undefined  )) {error += "- Tipo Entidad REQUERIDA \r\n"; isError = true;};
	if ((nombre == "" || nombre == undefined)) {error += "- Nombre o razón social REQUERIDA \r\n";isError = true;};
	if ((rut == "" || rut == undefined)) {error += "- Nombre o razón social REQUERIDA \r\n"; isError = true;};
	if ((telefono == "" || telefono == undefined )) {error += "- Nombre o razón social REQUERIDA \r\n"; isError = true;};
	if ((email == "" || email == undefined )) {error += "- E-mail REQUERIDA \r\n"; isError = true;};
	if ((comentario == "" || comentario ==undefined )) {error += "- Comentario REQUERIDA \r\n"; isError = true;};
	if ((servicio == "" || servicio == undefined )) {error += "- Servicios REQUERIDA \r\n"; isError = true;};


	if (isError) {		
		console.log(error);
		$("#modal-cabecera").empty();
		$(".modal-body").empty();
		$("#modal-cabecera").append('<h4 class="modal-title custom_align" id="Heading">Formulario incompleto</h4>');
		$(".modal-body").append('<h2>Faltan algunos campos por completar</h2><p>'+error+'</p>');
		$("#modal").modal("show");
	}else
	{
		EnviarDatos(entidad,nombre,rut,telefono,email,comentario,servicio);
	};

}

function EnviarDatos(entidad,nombre,rut,telefono,email,comentario,servicio){
	console.log(entidad+"//"+nombre+"//"+rut+"//"+telefono+"//"+email+"//"+comentario+"//"+servicio);
        var parametros = {
        		"entidad" : entidad,
        		"nombre" : nombre,
        		"rut" : rut,
        		"telefono" : telefono,
        		"email" : email,
        		"comentario" : comentario,
        		"servicio" : servicio
        };
        $.ajax({
                data:  parametros,
                url:   'php/Controlador.php',
                type:  'post',
                success:  function (response) {
                	console.log(response);
                	/*if(response == "ok")
                	{*/
                		$("#modal-cabecera").empty();
                		$(".modal-body").empty();
            			$("#modal-cabecera").append('<h4 class="modal-title custom_align" id="Heading">Cotizacion Correcta</h4>');
            			$(".modal-body").append('<h2>Cotizacion Enviada correctamente</h2><h3>Nuestro personal se pondrá en contacto con usted.</h3>');
            			$("#modal").modal("show");
                	/*}else
                	{                      	
                		$("#modal-cabecera").empty();
                		$(".modal-body").empty();          		
            			$("#modal-cabecera").append('<h4 class="modal-title custom_align" id="Heading">Cotizacion Erronea</h4>');
            			$(".modal-body").append('<h2>Ocurrió un error al enviar formulario</h2><h3>Porfavor intentelo nuevamente</h3>');
                		$("#modal").modal("show");
                	}   */                  
                }
        });
}