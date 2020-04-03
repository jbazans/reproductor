<!DOCTYPE html>
<html>
<head>
	<title>Youtube Player</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body onload="iniciar()">
	<center><h2>Youtube Player</h2></center>
	<div class="content">
		<div id="player">
		</div>
	</div>
    <script src="http://www.youtube.com/player_api"></script>
    <script type="text/javascript">
    	var player;
        var index='<?php if (isset($_GET['i'])) { echo $_GET['i'];}else{ echo "1"; } ?>';

    	function onPlayerReady(event){
    		event.target.playVideo();
    	}

    	function onPlayerStateChange(event){
    		if (event.data===0) {
                index++;
                window.location.href="reproductor.php?i="+index;
            }
    	}

    	function iniciar(){
            let http=new XMLHttpRequest();
            http.open('GET'/*'POST'*/,'service/get_songs.php',true);
            http.onload=function (){
                if (http.readyState==4 && http.status==200) {
                    let json=JSON.parse(http.responseText);
                    if (json.canciones[index-1]) {
                        player=new YT.Player('player',{
                            width:'100%',
                            height:'500',
                            videoId:json.canciones[index-1].urlcan,
                            events:{
                                onReady:onPlayerReady,
                                onStateChange:onPlayerStateChange
                            }
                        });
                    }else{
                        window.location.href="reproductor.php";
                    }
                }
            }
            http.send(null);
    	}
    </script>
</body>
</html>