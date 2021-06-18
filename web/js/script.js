$(document).ready(function(){
	$.ajax({
		url:"http://api.geonames.org/childrenJSON?geonameId=3996063&username=kztneda&hierarchy=geography",
		dataType:"JSON",
		type:"GET"
	}).always(function(respuesta){
		$.each(respuesta.geonames, function(k, v){
			$('#ciudad').append(
				$('<option/>',{
					value: v.geonameId,
					text: v.name
				})
			)
		})
	})
})