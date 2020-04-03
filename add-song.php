<!DOCTYPE html>
<html>
<head>
	<title>Youtube PlayList</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body onload="get_songs()">
	<div class="content">
		<center><h2>Lista de temas</h2></center>
		<table>
			<thead>
				<th>N° Orden</th>
				<th>Canci&oacute;n</th>
				<th>URL EMBED</th>
			</thead>
			<tbody id="idbody">
				<tr>
					<td>asd</td>
					<td>asd</td>
					<td>asd</td>
				</tr>
			</tbody>
		</table>
		<center><h2>Agregar temas</h2></center>
		<input type="text" id="idname" placeholder="Artista / Tema">
		<input type="text" id="idurl" placeholder="Añadir URL...">
		<center><button onclick="save_song()">Añadir</button></center>
	</div>
	<script type="text/javascript">
		function get_songs(){
			let http=new XMLHttpRequest();
			http.open('GET'/*'POST'*/,'service/get_songs.php',true);
			http.onload=function (){
				if (http.readyState==4 && http.status==200) {
					let json=JSON.parse(http.responseText);
					//console.log(json);
					let html='';
					for (var i = 0; i < json.canciones.length; i++) {
						html+=
						'<tr>'+
							'<td>'+json.canciones[i].codcan+'</td>'+
							'<td>'+json.canciones[i].nomcan+'</td>'+
							'<td>'+json.canciones[i].urlcan+'</td>'+
						'</tr>';						
					}
					document.getElementById("idbody").innerHTML=html;
				}
			}
			http.send(null);
		}
		function save_song(){
			//https://www.youtube.com/watch?v=PbdRBLabJWU&list=RDMMPbdRBLabJWU&start_radio=1
			let url=document.getElementById("idurl").value;
			let name=document.getElementById("idname").value;
			if (url=="" || name=="") {
				alert("Complete ambos campos!");
			}else{
				let pos=url.indexOf("v=");
				let str_delete=url.substr(0,pos+2);
				url=url.replace(str_delete,'');
				pos=url.indexOf("&");
				if (pos==-1) {
					pos=url.lenght;
				}
				url=url.substr(0,pos);
				//console.log(url);
				let http=new XMLHttpRequest();
				http.open('GET','service/save_song.php?url='+url+'&name='+name,true);
				http.onload=function (){
					if (http.readyState==4 && http.status==200) {
						let json=JSON.parse(http.responseText);
						console.log(json);
						if (json.state===true) {
							window.location.reload();
						}else{
							alert(json.detail);
						}
					}
				}
				http.send(null);
			}
		}
	</script>
</body>
</html>