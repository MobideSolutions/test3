	
$(document).on("mobileinit", function() {
$.mobile.defaultPageTransition = "slide";
});
	
$(document).ready(function(event){
obtenerListado("Pintxo");
});
	
/*$(document).bind('pageload', function(){ 
obtenerDetalle(1);
});
*/
	
	
function obtenerListado(tipo){
	var parametros = {
	"tipo" : tipo
	};

	$.ajax({
		data: parametros,
		url: 'http://demo.mobide.es/testbartolo/ObtenerListadoPintxos.php',
		type: 'get',
		beforeSend: function () {
			//$("#resultado").html("Procesando, espere por favor..."); para introducir en el futuro el gif de cargando
		},
		success: function ProcesarRespuesta(ajaxResponse) {
			if (typeof ajaxResponse == "string"){
				var pintxos  = $.parseJSON(ajaxResponse);
			}
			if (!pintxos)
			{
				// no se encontraron registros :(
				return;
			} 
			// Recuperamos el elemento donde se van a postear el listado de los pintxos
			var $Listado = $("#listadoPintxos");
			
		 
			// ahora, para cada pintxo
			var pintxo;
			for (var idx in pintxos)
			{
				pintxo = pintxos[idx];
				$Listado.append(
				"<li><a href='#' onclick='obtenerDetalle(" + pintxo.id + ")'>"+
				"<img src='img/listado/" + pintxo.srcimg + "'>" +
				"<h2>" + pintxo.alias + "</h2>" +
				"<p>" + pintxo.ingredientes + "</p>" +
				"</a></li>").listview("refresh"); 
			} 
					
		}
	});
}





function obtenerDetalle(id){
	var parametros = {
	"id" : id
	};
	$.ajax({
		data: parametros,
		url: 'ObtenerDetallePintxo.php',
		type: 'get',
		beforeSend: function () {
			//$("#resultado").html("Procesando, espere por favor..."); para introducir en el futuro el gif de cargando
		},
		success: function ProcesarRespuesta(ajaxResponse) {
			if (typeof ajaxResponse == "string"){
				var pintxo  = $.parseJSON(ajaxResponse);
			}
			if (!pintxo)
			{
				// no se encontraron registros :(
				return;
			}
			$(":mobile-pagecontainer" ).pagecontainer( "change", "#detallepintxo");
			$("#image_principal_pintxo").html("<img width='100%' src='img/detalle/" + pintxo.srcimg +"'>");
			$("#title_pintxo").html(pintxo.alias);
			$("#info_pintxo").html(pintxo.ingredientes);
				
			
			
			
			
			
		}
	});
}