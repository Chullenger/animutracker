function add_to_list(){
	var obj = {};
	var manga_idmanga = document.getElementById("manga_idmanga").value;
	var usuario_idusuario = document.getElementById("usuario_idusuario").value;

	obj["manga"] = manga_idmanga;
	obj["usuario"] = usuario_idusuario;

	document.getElementById("hidden_valu").value = JSON.stringify(obj);
	alert("Enviando datos2...");
	//document.getElementById("testing").submit();
	}