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

    	function onPlayerReady(event){
    		event.target.playVideo();
    	}

    	function onPlayerStateChange(){
    		
    	}

    	function iniciar(){
    		player=new YT.Player('player',{
    			width:'100%',
    			height:'500',
    			videoId:'TYYW_WwYHuM',
    			events:{
    				onReady:onPlayerReady,
    				onStateChange:onPlayerStateChange
    			}
    		});
    	}
    </script>
</body>
</html>