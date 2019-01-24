<html><head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta http-equiv="content-language" content="es-LA">
	<meta name="viewport" content="width=device-width, user-scalable=no">

	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">

	<link rel="shortcut icon" href="salzuela.ico">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Audiowide|Bungee+Inline|Monofett|Sarpanch" rel="stylesheet">

	<title>Salzuela TV-Player</title>   
	
	<style type="text/css">
		/* Let's get this party started */
		::-webkit-scrollbar { width: 0px; -webkit-border-radius: 50px; border-radius: 10px; }
		/* Track */
		::-webkit-scrollbar-track { background: rgba(0,0,0,0); -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0); 
			-webkit-border-radius: 50px; border-radius: 10px; }
		/* Handle */
		::-webkit-scrollbar-thumb { -webkit-border-radius: 50px; border-radius: 10px; background: rgba(0,0,0,0); 
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0); }
		::-webkit-scrollbar-thumb:window-inactive {	background: rgba(0,0,0,0); }
		::-webkit-scrollbar-track:hover { background: rgba(0,0,0,0); -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0); 
			-webkit-border-radius: 50px; border-radius: 10px; }
		::-webkit-scrollbar-track:active {background: rgba(0,0,0,0); -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0); 
			-webkit-border-radius: 50px; border-radius: 10px; }
		::-webkit-scrollbar-corner { background: transparent;	}

		
		BODY {
			background-color: black;
			background-image: url("salzuela2.png"), url("fondo2_1280.jpg") ; 
			background-size: 10% , 100%; 
			background-position: center , center;
			background-repeat: no-repeat , repeat-y;
			color: #2187bb ; 
			color: white ; 
		}

		.divisible {
		  opacity: 1;
		  transition:opacity 0.3s linear;
		}
		.divinvisible {
		  opacity: 0;
		  transition:opacity 0.3s linear;
		}

		.button {
			background-color: #f4511e;
			border: none;
			color: white;
			padding: 16px 32px;
			text-align: center;
			font-size: 16px;
			margin: 4px 2px;
			opacity: 0.8;
			transition: 0.3s;
			display: inline-block;
			text-decoration: none;
			cursor: pointer;
			box-shadow: 0px 0px 10px 2px #000 inset;
		}
		.button:hover {
			opacity: 1
		}

		.imagen {
			width: 84px;
			height: 84px;
			opacity: 0.4;
			cursor: pointer;
			box-shadow: 0px 0px 15px 0px #000 inset;
			border-radius: 15px;
			border: none;
			display:inline-block;
		    background-size: 100%;
		}	
		.imagen:hover {
			opacity: 1;
		}

		.imagenTV {
			width: 118px;
			height: 118px;
			opacity: 0.4;
			cursor: pointer;
			box-shadow: 0px 0px 15px 0px #000 inset;
			border-radius: 15px;
			border: none;
			display:inline-block;
		    background-size: 100%;
		}
		.imagenTV:hover {
			opacity: 1;
		}
		
		.frame {
			opacity: 0.0;
			cursor: pointer;
			box-shadow: 0px 0px 20px 5px #000 inset;
			display:inline-block;
			border-radius: 10px;
		}
		.frame:hover {
			opacity: 0.7;
			background-color: #2187bb;
		}

		.estado{
			background-color: #2187bb;
			opacity: 0.7;
			cursor: pointer;
			box-shadow: 0px 0px 20px 5px #000 inset;
			border-radius: 10px;			
		}
		
		.falla {
			width: 90px;
			height: 90px;
			opacity: 0.3;
			cursor: pointer;
			border-radius: 10px;
		}	
		.falla:hover {
			opacity: 0.2;
		}

		.texto {
			cursor: pointer;
			color: white;
			font-family: 'Audiowide';
			font-size: 30px;
			opacity: 1;
		}
		.texto:hover {
			opacity: 1;
		}
		
		.linea{
			border-top: 1px solid #FFFFFF;
			border-bottom: 0px;
			opacity: 0.7;
		}

	</style>	  

	<script>
		// http://free.iptvcanales.com/view/colombia.m3u
		//		http://free.iptvcanales.com/view/kr/AE_MUNDO_HD/playlist.m3u8
		// http://free.iptvcanales.com/view/latinos.m3u
		//		http://free.iptvcanales.com/view/channel/40506/playlist.m3u8

		var DEBUG = true;
		if(!DEBUG){
			if(!window.console) window.console = {};
			var methods = ["log", "debug", "warn", "info"];
			for(var i=0;i<methods.length;i++){
				console[methods[i]] = function(){};
			}
		}

		var navegador = "Win"
		if (navigator.appVersion.indexOf("Win")>=0) {
			navegador = "Win"
		}else{
			navegador = "other"
		}
		
		function alterna_modo_de_pantalla() {
			if ((document.fullScreenElement && document.fullScreenElement !== null) ||    // metodo alternativo
				(!document.mozFullScreen && !document.webkitIsFullScreen)) {               // metodos actuales
				if (document.documentElement.requestFullScreen) {
					document.documentElement.requestFullScreen();
				} else if (document.documentElement.mozRequestFullScreen) {
					document.documentElement.mozRequestFullScreen();
				} else if (document.documentElement.webkitRequestFullScreen) {
					document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
				}
			} else {
				if (document.cancelFullScreen) {
					document.cancelFullScreen();
				} else if (document.mozCancelFullScreen) {
					document.mozCancelFullScreen();
				} else if (document.webkitCancelFullScreen) {
					document.webkitCancelFullScreen();
				}
			}
		}

		function fullScreen() {
				if (document.documentElement.requestFullScreen) {
					document.documentElement.requestFullScreen();
				} else if (document.documentElement.mozRequestFullScreen) {
					document.documentElement.mozRequestFullScreen();
				} else if (document.documentElement.webkitRequestFullScreen) {
					document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
				}
		}
		
		var token = getCookie("token");
		var calidad = getCookie("calidad");

		var token = "verge"
		var calidad = 2
		
		function setCookie(cname, cvalue, exdays) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
			var expires = "expires="+d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}

		function getCookie(cname) {
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}

		function checkCookie() {
			var user = getCookie("username");
			if (user != "") {
				alert("Welcome again " + user);
			} else {
				user = prompt("Please enter your name:", "");
				if (user != "" && user != null) {
					setCookie("username", user, 365);
				}
			}
		}

		function setToken() {
			token = getCookie("token");
			token = prompt("Token: ", token);
			if (token != null) {
				setCookie("token", token, 365);			
			}
		}

		function setCalidad() {
			calidad = getCookie("calidad");
			calidad = prompt("Calidad: ", calidad);
			if (calidad != null) {
				setCookie("calidad", calidad, 365);			
			}
		}
		
		var tempo
		var v="none"
		function menu(v){
			console.log("menu(" + v + ")")
//v="visible"	
			switch(v) {
				case "hidden":
					document.body.style.cursor = "none";
					divMain.classList.remove("divisible")
					divMain.classList.add("divinvisible")
					v="hidden"
					break;
				case "visible":
					document.body.style.cursor = "pointer";
					divMain.classList.remove("divinvisible")
					divMain.classList.add("divisible")
					v="visible"
					break;
			}

			divMain.style.visibility = v
			claseActiva = divMain.classList.value

			console.log(claseActiva)

		}
				
		function onmove(){
			//console.log("OnMove: " + tempo)
			clearTimeout(tempo)
			tempo = setTimeout(menu, 5000, "hidden")
		}

		
		var Token2 = ""
		function getToken2(){
			console.log("getToken2")
			urlToken2 = 'token2.php'
			jQuery.ajax({
				url:  urlToken2 ,
				dataType: 'json',
				async: false
			}).done(function(data) {
				console.log(" D O N E : Token2 = " + data)
				document.getElementById("token").innerHTML = data
			});
		}


		var canales = []
		//canales[]={nombre:'',  src:'',    fuente1:'',       opcion1:1, fuente2:'', opcion2:1}
		canales[1] ={nombre:'FOX Action',       src:'img/FOXACTION.jpg',    fuente1:'FOXACTION_HD',          opcion1:1, fuente2:'2722', opcion2:1}
		canales[2] ={nombre:'FOX Cinema',       src:'img/FOXCINEMA.jpg',    fuente1:'FOX_CINEMA_HD_SUB',     opcion1:1, fuente2:'2580', opcion2:1}
		canales[3] ={nombre:'FOX Classics',     src:'img/FOXCLASSICS.jpg',  fuente1:'FOX_CLASSICS_HD',       opcion1:1, fuente2:'2581', opcion2:1}
		canales[4] ={nombre:'FOX Comedy',       src:'img/FOXCOMEDY.jpg',    fuente1:'FOX_COMEDY_HD',         opcion1:1, fuente2:'2611', opcion2:1}
		canales[5] ={nombre:'FOX Family',       src:'img/FOXFAMILY.jpg',    fuente1:'FOXFAMILY_HD',          opcion1:1, fuente2:'2723', opcion2:1}
		canales[6] ={nombre:'FOX Movies',       src:'img/FOXMOVIES.jpg',    fuente1:'FOXMOVIES_HD',          opcion1:1, fuente2:'2724', opcion2:1}
		canales[7] ={nombre:'FOX Series',       src:'img/FOXSERIES.jpg',    fuente1:'FOX1_HD_SUB',           opcion1:1, fuente2:'',     opcion2:1}
		canales[8] ={nombre:'HBO',              src:'img/HBO.jpg',          fuente1:'HBO_HD_SUB',            opcion1:1, fuente2:'2727', opcion2:1}
		canales[9] ={nombre:'HBO 2',            src:'img/HBO2.jpg',         fuente1:'HBO_2_HD',              opcion1:1, fuente2:'2764', opcion2:1}
		canales[10]={nombre:'HBO Family',       src:'img/HBOFAMILY.jpg',    fuente1:'HBO_FAMILY_HD',         opcion1:1, fuente2:'2594', opcion2:1}
		canales[11]={nombre:'HBO Plus',         src:'img/HBOPLUS.jpg',      fuente1:'HBO_PLUS_HD',           opcion1:1, fuente2:'2626', opcion2:1}
		canales[12]={nombre:'HBO Signature',    src:'img/HBOSIGNATURE.jpg', fuente1:'HBO_SIGNATURE_HD',      opcion1:1, fuente2:'2744', opcion2:1}
		canales[13]={nombre:'MAX',              src:'img/MAX.jpg',          fuente1:'',                      opcion1:1, fuente2:'2353', opcion2:1}
		canales[14]={nombre:'MAX Prime',        src:'img/MAXPRIME.jpg',     fuente1:'MAX_PRIME_HD',          opcion1:1, fuente2:'http://161.0.157.9/PLTV/88888888/224/3221226834/index.m3u8', opcion2:1}
		canales[15]={nombre:'MAX Up',           src:'img/MAXUP.jpg',        fuente1:'',                      opcion1:1, fuente2:'2765', opcion2:1}
		canales[16]={nombre:'AMC',              src:'img/AMC.jpg',          fuente1:'AMC_HD',                opcion1:1, fuente2:'2736', opcion2:1}
		canales[17]={nombre:'AXN',              src:'img/AXN.jpg',          fuente1:'AXN_HD',                opcion1:1, fuente2:'2761', opcion2:1}
		canales[18]={nombre:'Cinecanal',        src:'img/CINECANAL.png',    fuente1:'CINECANAL_HD',          opcion1:1, fuente2:'2577', opcion2:1}
		canales[19]={nombre:'Cinemax',          src:'img/CINEMAX.png',      fuente1:'CINEMAX',               opcion1:1, fuente2:'2760', opcion2:1}
		canales[20]={nombre:'Comedy Central',   src:'img/COMEDY.jpg',       fuente1:'COMEDY_CENTRAL_HD',     opcion1:1, fuente2:'2735', opcion2:1}
		canales[21]={nombre:'DHE',              src:'img/DHE.png',          fuente1:'DHE_HD',                opcion1:1, fuente2:'2612', opcion2:1}
		canales[22]={nombre:'Cinema 24/7',      src:'img/DTVCINEMA.png',    fuente1:'',                      opcion1:1, fuente2:'1124', opcion2:1}
		canales[23]={nombre:'FOX',              src:'img/FOX.jpg',          fuente1:'FOXMX_HD',              opcion1:1, fuente2:'2745', opcion2:1}
		canales[24]={nombre:'FOX Life',         src:'img/FOXLIFE.png',      fuente1:'FOX_LIFE_HD',           opcion1:1, fuente2:'2585', opcion2:1}
		canales[25]={nombre:'FXM',              src:'img/FXM.jpg',          fuente1:'FXMMX_HD',              opcion1:1, fuente2:'2713', opcion2:1}
		canales[26]={nombre:'FX',               src:'img/FX.jpg',           fuente1:'FX_HD',                 opcion1:1, fuente2:'2593', opcion2:1}
		canales[27]={nombre:'Golden Plus',      src:'img/GOLDEN+.jpg',      fuente1:'GOLDEN_HD',             opcion1:1, fuente2:'2599', opcion2:1}
		canales[28]={nombre:'Golden Premiere',  src:'img/GOLDENEDGE.jpg',   fuente1:'GOLDEN_PREMIER_HD',     opcion1:1, fuente2:'2598', opcion2:1}
		canales[29]={nombre:'Multipremiere',    src:'img/MULTIPREMIER.png', fuente1:'MULTIPREMIER',          opcion1:1, fuente2:'2754', opcion2:1}
		canales[30]={nombre:'Paramount',        src:'img/PARAMOUNT.png',    fuente1:'PARAMOUNT_HD',          opcion1:1, fuente2:'2741', opcion2:1}
		canales[31]={nombre:'Sony',             src:'img/SONY.jpg',         fuente1:'SONY_HD',               opcion1:1, fuente2:'2757', opcion2:1}
		canales[32]={nombre:'Studio Universal', src:'img/STUDIO.jpg',       fuente1:'STUDIO_UNIVERSAL',      opcion1:1, fuente2:'', opcion2:1}
		canales[33]={nombre:'Space',            src:'img/SPACE.jpg',        fuente1:'SPACE_HD',              opcion1:1, fuente2:'2614', opcion2:1}
		canales[34]={nombre:'Sundance',         src:'img/SUNDANCE.jpg',     fuente1:'SUNDANCE_HD',           opcion1:1, fuente2:'2573', opcion2:1}
		canales[35]={nombre:'SyFy',             src:'img/SYFY.jpg',         fuente1:'',                      opcion1:1, fuente2:'2090', opcion2:1}
		canales[36]={nombre:'TBS',              src:'img/TBS.jpg',          fuente1:'',                      opcion1:1, fuente2:'2630', opcion2:1}
		canales[37]={nombre:'TCM',              src:'img/TCM.png',          fuente1:'TCM',                   opcion1:1, fuente2:'2762', opcion2:1}
		canales[38]={nombre:'TLC',              src:'img/TLC.png',          fuente1:'TLC',                   opcion1:1, fuente2:'2690', opcion2:1}
		canales[39]={nombre:'TNT',              src:'img/TNT.jpg',          fuente1:'TNT_HD',                opcion1:1, fuente2:'2592', opcion2:1}
		canales[40]={nombre:'TNT Series',       src:'img/TNTSERIES.jpg',    fuente1:'TNT_SERIES_HD',         opcion1:1, fuente2:'2591', opcion2:1}
		canales[41]={nombre:'Universal Channel',src:'img/UNIVERSAL.png',    fuente1:'UNIVERSAL_CHANNEL_HD',  opcion1:1, fuente2:'2759', opcion2:1}
		canales[42]={nombre:'Warner Channel',   src:'img/WARNER.png',       fuente1:'WARNER_HD',             opcion1:1, fuente2:'2583', opcion2:1}
		canales[43]={nombre:'Classiques',       src:'icon/foxclassics.png', fuente1:'http://45.43.208.2:1935/classique/classique/live.m3u8', opcion1:1, fuente2:'', opcion2:1}
		canales[44]={nombre:'Pelicula',         src:'img/CINE.png',         fuente1:'http://www.youtube.com/embed/XT3voFvVEcI',         opcion1:1, fuente2:'', opcion2:1}
		canales[45]={nombre:'A&amp;E',          src:'img/AE.png',           fuente1:'AE_MUNDO_HD',           opcion1:1, fuente2:'2620', opcion2:1}
		canales[46]={nombre:'Animal Planet',    src:'img/ANIMALPLANET.png', fuente1:'ANIMAL_PLANET_HD',      opcion1:1, fuente2:'2739', opcion2:1}
		canales[47]={nombre:'Discovery Channel',src:'img/DISCOVERY.jpg',    fuente1:'DISCOVERY_CHANNEL_HD',  opcion1:1, fuente2:'2770', opcion2:1}
		canales[48]={nombre:'Discovery Civ',    src:'img/DISCIV.jpg',       fuente1:'DISCOVERY_CIVILIZATION',opcion1:1, fuente2:'',     opcion2:1}
		canales[49]={nombre:'E!',               src:'img/E.jpg',            fuente1:'E',                     opcion1:1, fuente2:'2756', opcion2:1}
		canales[50]={nombre:'History Channel',  src:'img/HISTORY.jpg',      fuente1:'HISTORY_CHANNEL_HD',    opcion1:1, fuente2:'2669', opcion2:1}
		canales[51]={nombre:'H2',               src:'img/H2.png',           fuente1:'H2',                    opcion1:1, fuente2:'2772', opcion2:1}
		canales[52]={nombre:'ID',               src:'img/ID.jpg',           fuente1:'ID_HD',                 opcion1:1, fuente2:'2709', opcion2:1}
		canales[53]={nombre:'NatGeo',           src:'img/NATIONALGEO.jpg',  fuente1:'NATGEO_HD',             opcion1:1, fuente2:'2678', opcion2:1}
		canales[54]={nombre:'NatGeo Wild',      src:'img/NATGEOWILD.png',   fuente1:'NATGEO_WILD_HD',        opcion1:1, fuente2:'2584', opcion2:1}
		canales[55]={nombre:'True TV',          src:'img/TRUETV.png',       fuente1:'TRU_TV_HD',             opcion1:1, fuente2:'2720', opcion2:1}
		canales[56]={nombre:'TLC',              src:'img/TLC.png',          fuente1:'TLC',                   opcion1:1, fuente2:'2690', opcion2:1}
		canales[57]={nombre:'Azteca',           src:'img/AZTECA.png',       fuente1:'',                      opcion1:1, fuente2:'808', opcion2:1}
		canales[58]={nombre:'Canal 1',          src:'img/CANAL1.png',       fuente1:'CANAL_UNO_HD',          opcion1:1, fuente2:'', opcion2:1}
		canales[59]={nombre:'Caracol',          src:'img/CARACOL.png',      fuente1:'CARACOL',               opcion1:1, fuente2:'2721', opcion2:1}
		canales[60]={nombre:'De Pelicula',      src:'img/DEPELICULA.png',   fuente1:'DEPELICULA',            opcion1:1, fuente2:'2686', opcion2:1}
		canales[61]={nombre:'Canal de las Estrellas',src:'img/ESTRELLAS.jpg',fuente1:'CANAL_DE_LAS_ESTRELLAS',opcion1:1, fuente2:'2750', opcion2:1}
		canales[62]={nombre:'Glitz',            src:'img/GLITZ.png',        fuente1:'GLITZ',                 opcion1:1, fuente2:'2689', opcion2:1}
		canales[63]={nombre:'RCN',              src:'img/RCN.png',          fuente1:'',                      opcion1:1, fuente2:'1778', opcion2:1}
		canales[64]={nombre:'Telemundo',        src:'img/TELEMUNDO.png',    fuente1:'TELEMUNDO',             opcion1:1, fuente2:'2691', opcion2:1}
		canales[65]={nombre:'Venevision Plus',  src:'img/VE+.jpg',          fuente1:'VEPLUSTV',              opcion1:1, fuente2:'2621', opcion2:1}
		canales[66]={nombre:'Boomerang',        src:'img/BOOMERANG.png',    fuente1:'BOOMERANG',             opcion1:1, fuente2:'2775', opcion2:1}
		canales[67]={nombre:'Cartoon Network',  src:'img/CARTOON.png',      fuente1:'CARTOON_NETWORK_HD',    opcion1:1, fuente2:'2587', opcion2:1}
		canales[68]={nombre:'Disney',           src:'img/DISNEY_HD.png',    fuente1:'',                      opcion1:1, fuente2:'2619', opcion2:1}
		canales[69]={nombre:'Disney XD',        src:'img/DISNEY_XD.png',    fuente1:'DISNEY_XD',             opcion1:1, fuente2:'2590', opcion2:1}
		canales[70]={nombre:'Disney Jr',        src:'img/DISNEYJR.png',     fuente1:'DISNEY_JR',             opcion1:1, fuente2:'2623', opcion2:1}
		canales[71]={nombre:'Nickelodeon Jr',   src:'img/NICK_JR_HD.png',   fuente1:'NICK_JR_HD',            opcion1:1, fuente2:'2766', opcion2:1}
		canales[72]={nombre:'Nickelodeon',      src:'img/NICKELODEON_HD.png',fuente1:'NICKELODEON_HD',       opcion1:1, fuente2:'2596', opcion2:1}
		canales[73]={nombre:'Nick 2',           src:'img/NICKTOONS.png',    fuente1:'NICK_2_HD',             opcion1:1, fuente2:'', opcion2:1}
		canales[74]={nombre:'ToonCast',         src:'img/TOONCAST.png',     fuente1:'TOONCAST',              opcion1:1, fuente2:'', opcion2:1}


		function docCanales(){
			for(i=1; i<canales.length; i++){
				if(navegador==="Win"){
					document.getElementById("divCanales").innerHTML += "<div id=" + i + " class='imagen' onclick = play(this.id) ></div>"
				}else{
					if(screen.width<1000){
						document.getElementById("divCanales").align ="center"
					}
					document.getElementById("divCanales").innerHTML += "<div id=" + i + " class='imagenTV' onclick = play(this.id) ></div>"
				}
				document.getElementById(i).style.backgroundImage = "url('" + canales[i].src + "')";
				if(i===15){document.getElementById("divCanales").innerHTML += "<hr class='linea'>"}
				if(i===44){document.getElementById("divCanales").innerHTML += "<hr class='linea'>"}
				if(i===56){document.getElementById("divCanales").innerHTML += "<hr class='linea'>"}
				if(i===65){document.getElementById("divCanales").innerHTML += "<hr class='linea'>"}
			}			
			
		}
		
		function play(id) {
			
			caption = canales[id].nombre
			f1 = canales[id].fuente1
			l1 = canales[id].opcion1
			f2 = canales[id].fuente2
			l2 = canales[id].opcion2
			
			console.log(caption , f1 , l1 , f2 , l2)

			document.getElementById("iVideo2").src = ""
			document.getElementById("video1").src = ""

			try {
				var src = window.event ? window.event.srcElement : ev.target;
				console.log (src.id)
				canalAnterior = canal
				canal = parseInt(src.id)
			}catch(err){
				canal = parseInt(document.getElementById('canalZ').value)
				canalAnterior = canal
			}

			fOrg = fuente
			
			if(f1=="") {
				if(f2=="") { 
					document.getElementById("lCanal").innerHTML = canal + ": " + caption + " (NO Fuente)";
					document.getElementById("canal").innerHTML = canal + ": " + caption + " (NO Fuente)";
					return
				}
				fuente = 2
			}
			if(f2=="") {
				fuente = 1
			}
				
			document.getElementById("pStop").src="http://tv.salzuela.tk/img/stop3D.png"
			
			menu("hidden");
			divLoad.style.visibility = "visible"

			if(f1.search("http") >= 0){
				Fuente="web"
				console.log("http")
				url = f1
				document.getElementById("video1").controls = true;
				document.getElementById("iVideo2").controls = true;
			}else{
				console.log("URL")
				document.getElementById("video1").controls = false;
				document.getElementById("iVideo2").controls = false;

				if(fuente == 1) {
					console.log("Fuente 1: IPTV")
					Fuente = " (Fuente 1)"
					urlBase = "http://free.iptvcanales.com/view/"
					switch(l1) {
						case 0:
							//	http
							url = f1
							break;
						case 1:
							//	Colombia playlist.m3u8
							//	http://free.iptvcanales.com/view/kr/AE_MUNDO_HD/playlist.m3u8
							//  http://free.iptvcanales.com/web/kr/AMC_HD/playlist.m3u8 // enlace desde la web
							//urlBase = "http://free.iptvcanales.com/web/"
							url = urlBase + "kr/" + f1 + "/playlist.m3u8"
							break;
						default:
							console.log("Switch Case L1 ERROR...")
							url = "ERROR"
					}					
				}else{
					console.log("Fuente 2: tvpremium")
					Fuente = " (Fuente 2)"
					// Fuente 2: tvpremium
					urlBase = "http://tvpremiumhd.club/lista-gratuita/"
					//http://tvpremiumhd.club/lista-gratuita/153109/tv/v/2090.ts
					//http://tvpremiumhd.club/lista-gratuita/215509/tv/live.php?id=2090.ts
					try {
						getToken2()
					}catch(err) {
						document.getElementById("token").innerHTML = err.message;
					}
					Token2 = document.getElementById("token").innerHTML
					//Token2 = "185409"

					switch(l2) {
						case 0:
							//	http
							url = f2
							break;
						case 1:
							//	http://tvpremiumhd.club/lista-gratuita/154409/tv/v/2353.m3u8
							url = urlBase + Token2 + "/tv/live.php?id="
							if (navigator.appVersion.indexOf("Win")!=-1) {
								url = url + f2 + ".m3u8"
							}else{
								url = url + f2 + ".ts"
							}
							break;							
						case 2:
							//	http://tvpremiumhd.club/lista-gratuita/213009/on/lo/496.m3u8							
							url = urlBase + Token2 + "/on/lo/"
							if (navigator.appVersion.indexOf("Win")!=-1) {
								url = url + f2 + ".m3u8"
							}else{
								url = url + f2 + ".ts"
							}
							break;
						case 3:
							//	http://sl.cdn.iutpcdn.com/LIVE/H01/CANAL 257 /PROFILE03. m3u8
							url = "http://sl.cdn.iutpcdn.com/LIVE/H01/CANAL"
							if (navigator.appVersion.indexOf("Win")!=-1) {
								url = url + f2 + "/PROFILE03.m3u8"
							}else{
								url = url + f2 + "/PROFILE03.ts"
							}
							break;						
						default:
							console.log("Switch Case L2 ERROR...")
							url = "ERROR"
					}
				}
			}

			document.getElementById("lCanal").innerHTML = canal + ": " + caption + Fuente;
			document.getElementById("canal").innerHTML = canal + ": " + caption + Fuente;
			
			fuente = fOrg
			document.getElementById("hFuente").innerHTML = "Fuente Preferida: " + fOrg
			//document.getElementById("lfuente").innerHTML = fOrg

			console.log("Token2= " + Token2)
			console.log(url)
			console.log(navigator.appVersion)
			
			
			if (navigator.appVersion.indexOf("Win")!=-1) {
				document.getElementById("divVideo2").style.visibility = "visible"
				document.getElementById("iVideo2").src = "chrome-extension://emnphkkblegpebimobpbekeedfgemhof/player.html#" + url
				//document.getElementById("iVideo2").src = "chrome-extension://ckblfoghkjhaclegefojbgllenffajdc/player.html#" + url				
			}else{
				document.getElementById("divVideo1").style.visibility = "visible"				
				document.getElementById("video1").src = url
				video1.play()		// Smart TV
			}			
		}
		
		var canal = 0
		var canalMax = 74
		canalAnterior = 0
		function sube(){	
			canal = canal + 1
			if(canal>canalMax){canal=1}
			console.log("sube")
			//document.getElementsByTagName("img")[canal].click()
			document.getElementById(canal).click()
			console.log(canal)
		}
		function baja(){
			canal = canal - 1
			if(canal==0){canal=canalMax}
			console.log("baja")
			//document.getElementsByTagName("img")[canal].click()
			document.getElementById(canal).click()
			console.log(canal)
		}
		function jump(){
			//document.getElementsByTagName("img")[canalAnterior].click()
			document.getElementById(canalAnterior).click()
		}
		function update(){
			//location.reload();
			//document.getElementsByTagName("img")[canal].click()
			document.getElementById(canal).click()
		}

		function stop(){
			document.getElementById("video1").src=""
			document.getElementById("iVideo2").src=""
			
			if(canal!=0) {
				if(document.getElementById("pStop").src=="http://tv.salzuela.tk/img/stop3D.png") {
					document.getElementById("pStop").src="http://tv.salzuela.tk/img/play3D.png"
				}else{
					document.getElementById("pStop").src="http://tv.salzuela.tk/img/stop3D.png"
					document.getElementsByTagName("img")[canal].click()
					console.log(canal)
				}
			}
			
			divLoad.style.visibility = "hidden"
			menu("visible")
		}

		aspecto=0
		function aspect(){
			if(aspecto==6){
				aspecto=0
			}else{
				aspecto++				
			}
			switch(aspecto) {
				case 0:	
					document.getElementById("video1").style = "width:100%; height:100%; margin-right:-0%; margin-left:-0%; margin-top:-0%; object-fit:fill; overflow:hidden; border:0;"
					document.getElementById("iVideo2").style = "width:100%; height:100%; margin-right:-0%; margin-left:-0%; margin-top:-0%; object-fit:fill; overflow:hidden; border:0;"
					break
				case 1:	
					document.getElementById("video1").style = "width:110%; height:110%; margin-right:-5%; margin-left:-5%; margin-top:-2%; object-fit:fill; overflow:hidden; border:0;"
					document.getElementById("iVideo2").style = "width:110%; height:110%; margin-right:-5%; margin-left:-5%; margin-top:-1%; object-fit:fill; overflow:hidden; border:0;"
					break
				case 2:	
					document.getElementById("video1").style = "width:120%; height:120%; margin-right:-10%; margin-left:-10%; margin-top:-4%; object-fit:fill; overflow:hidden; border:0;"
					document.getElementById("iVideo2").style = "width:120%; height:120%; margin-right:-10%; margin-left:-10%; margin-top:-4%; object-fit:fill; overflow:hidden; border:0;"
					break
				case 3:	
					document.getElementById("video1").style = "width:130%; height:130%; margin-right:-15%; margin-left:-15%; margin-top:-7%; object-fit:fill; overflow:hidden; border:0;"
					document.getElementById("iVideo2").style = "width:130%; height:130%; margin-right:-15%; margin-left:-15%; margin-top:-7%; object-fit:fill; overflow:hidden; border:0;"
					break

				case 4:	
					document.getElementById("video1").style = "width:80%; height:100%; object-fit:fill; overflow:hidden; border:0;"
					document.getElementById("iVideo2").style = "width:80%; height:100%; object-fit:fill; overflow:hidden; border:0;"
					break
				case 5:	
					document.getElementById("video1").style = "width:100%; height:125%; margin-top:-7%; object-fit:fill; overflow:hidden; border:0;"
					document.getElementById("iVideo2").style = "width:100%; height:125%; margin-top:-7%; object-fit:fill; overflow:hidden; border:0;"
					break
				case 6:	
					document.getElementById("video1").style = "width:125%; height:100%; margin-right:-12.5%; margin-left:-12.5%; margin-top:auto; margin-bottom:auto%; object-fit:fill; overflow:hidden; border:0;"
					document.getElementById("iVideo2").style = "width:125%; height:100%; margin-right:-12.5%; margin-left:-12.5%; margin-top:auto%; margin-bottom:auto%; object-fit:fill; overflow:hidden; border:0;"
					break
			}

			document.getElementById("laspect").innerHTML = aspecto;
		}

		function reloj(){
			var n = new Date().toLocaleString();
			document.getElementById("reloj").innerHTML = n

			//document.getElementById("token").innerHTML = Token2
		}
		updatereloj = setInterval(reloj, 1000)
		
		function iptv(){
			console.log("iptv")

			document.getElementById("lCanal").innerHTML = "Activando Token 1"

			document.getElementById("iptv").src = "http://free.iptvcanales.com/view/activacion_1.php"
			document.getElementById("iptv").onload = ""
		}

		function iptvStatus(){
		  console.log("iptvStatus")
		  document.getElementById('frameiptv').src = ''
		  document.getElementById('frameiptv').src = 'http://free.iptvcanales.com/view/activacion_1.php'
		}

		function iptvActivar(){
		  console.log("iptvActivar")
		  window.open('http://iptvcanales.com/index.php/lista-de-canales/')
		}

		var iptvFrame = document.createElement("iframe");
		function onLoad1() {
			console.log("onLoad1")
			console.time("1");
			
			iptvFrame.id = "iptv"
			iptvFrame.src = "http://iptvcanales.com/index.php/lista-de-canales/";
			iptvFrame.onload = function() { onLoad2() };
			iptvFrame.onerror = function() { onLoadError() };
			iptvFrame.scrolling = "no";
			iptvFrame.frameborder = "0";
			iptvFrame.width = "190px";
			iptvFrame.height = "55px";
			document.getElementById("divFrameiptv").appendChild(iptvFrame);
		}

		function onLoad2() {
			document.getElementById("iptv").onload = function() { onLoad3() }
			document.getElementById("iptv").src = "http://free.iptvcanales.com/view/activacion_1.php"
		}
		
		function onLoad3() {
			console.log("onLoad3")
			console.timeEnd("1");		

			document.getElementById("iptv").onload = ""
			divLoad.style.visibility = "hidden"
			menu("visible")
			//document.getElementById("iptv").src = ""
			//console.clear();
			updateToken1 = setInterval(onLoad1, 2*3600*1000)	// 2 horas
//			getToken2()
		}

		function tstIptv() {
			document.getElementById("iptv").onload = function() { onLoadTst() }
			document.getElementById("iptv").src = "http://free.iptvcanales.com/view/activacion_1.php"
		}
		function onLoadTst() {
			var iframe = document.getElementById('iptv');

			console.log("onLoadTst")
			console.log(document.getElementById("iptv").innerHTML)
		}

		
		function onLoadError() {
			document.getElementById("token").innerHTML = "Error al cargar token1..."
		}

		function init() {
			console.log("Init")
			docCanales()
			getToken2()
			//onLoad1()
			divLoad.style.visibility = "hidden"
			menu("visible")
		}
		
		function keyPress() {
			console.log("keyPress")
		}

		var fuente=1
		function fuenteTV(){
			if(fuente==2){
				fuente=1
				f="Fuente Preferida: 1"
			}else{
				fuente++				
				f="Fuente Preferida: 2"
			}
			//document.getElementById("lfuente").innerHTML = fuente;
			document.getElementById("hFuente").innerHTML = f;
		}

	</script> 
</head>

<body onmousemove="onmove()" onload="init()" background="LogoSalzuelaBlogV3.png" style="cursor: none;"> 

	<div id="divLoad" style="visibility: hidden; position: absolute; z-index: initial; top: 45%; margin-left: auto; margin-right: auto; left: 0px; right: 0px;">
		<img src="loading3.gif" width="50px" height="50px" style="position: absolute; margin-left:auto; margin-right:auto; left:0; right:0; ">
		<p id="lCanal" class="texto" style="margin-top:60; text-align: center;">Cargando Canales...</p>
	</div>

	<div id="divVideo1" style="text-align:center; position:absolute; z-index:1; top:0; left:0; right: 0; bottom:0; opacity:1;" onclick="menu('visible')">
		<video id="video1" style=" width:100%; height:100%; margin-right:-0%; margin-left:-0%; margin-top:-0%; overflow:hidden;" onclick="menu('visible')">
			<source src="" type="application/x-mpegURL">
		</video>
	</div>

	<div id="divVideo2" style="visibility:hidden; text-align:center; position:absolute; z-index:0; top:0; left:0; right: 0; bottom:0; opacity:1;" onclick="menu('visible')">
		<iframe id="iVideo2" style="border:0; width:100%; height:100%; margin-right:-0%; margin-left:-0%; margin-top:-0%; overflow:hidden;"></iframe>
	</div>

	<div id="divMain" class="divinvisible" style="text-align: left; background-color: rgba(0, 0, 0, 0.2); overflow-y: scroll; position: absolute; z-index: 2; top: 0px; left: 0px; right: 0px; bottom: 0px; visibility: hidden;" onclick="menu('hidden')">
		<br>
		<h1 id="hFuente" class="texto" style="margin-bottom:0; margin-top:0; text-align:center; display:inline-block;" onclick="fuenteTV()">
			Fuente Preferida: 1
		</h1>
		<hr class="linea">
		
		<div id="divCanales" style="display:inline-block; margin-left:15px;">
		</div>
		
		<hr class="linea">
		<div id="divControl" align="center" >
			<div class="imagen" onclick="stop()" id="pStop" style="background-image: url('img/stop3D.png');"></div>		
			<div class="imagen" onclick="sube()" style="background-image: url('img/arriba3D.png');"></div>
			<div class="imagen" onclick="baja()" style="background-image: url('img/abajo3D.png');"></div>
			<div class="imagen" onclick="jump()" style="background-image: url('img/jump3D.png');"></div>
			<div class="imagen" onclick="update()" style="background-image: url('img/update3D.png');"></div>			
			
			<div class="imagen" onclick="aspect()" style="background-image: url('img/aspect3D.png');" align="center">
				<h1 id="laspect" style="position:relative; padding:0px; opacity: 0.5; cursor: pointer; color:white; font-family: 'Audiowide'; font-size: 50px; " >0</h1>
			</div>

			<input class="imagen" type="image" style="" src="img/salzuela.png" onclick="alterna_modo_de_pantalla()">
		</div>


		<div id="divEstado" class="estado" >
			<span class="texto" id="token" style="float:left;"> </span>
			<span class="texto" id="reloj" style="float:right;"> </span>
			<span class="texto" id="canal" style="margin:auto; display:table;">Canal</span>
		</div>

<!--
		<div style="display:noneXXX; overflow: hidden; margin-top: 0px; margin-left: 0px; width:55px; height:25px;">
			<iframe src="http://iptvcanales.com/index.php/lista-de-canales/" scrolling="yes" style="height: 1500px; border: 0px none; width: 619px; margin-top: -990px; margin-left: -180px; ">
			</iframe>
		</div>
-->

		<div class="frame">
			<input class="" style="width:40px; height:40px;" type="image" src="img/update3D.png" onclick="iptvStatus()">
				<iframe id="frameiptv" class="" src="http://free.iptvcanales.com/view/activacion_1.php" scrolling="no" style="display:inline-block; border:none; height: 35px;  width: 600px; background-color:#0;">
				</iframe>
			<input class="" style="width:40px; height:40px;" type="image" src="img/jump3D.png" onclick="iptvActivar()">
		</div>
			
		<div id="divFrameiptv" style="display:none;">
		</div>

		<script>
			menu("hidden")
		</script>


		<div style="display:none;">
			<hr class="linea">
			<input type="button" id="boton-" value="-" onclick="zapping(--document.getElementById('canalZ').value)" style="text-align:center; width:50; height:50; display:inline-block; font-size:50px; border-radius: 7px; color:white; background-color:#008CBA;">
			<input type="text" id="canalZ" name="canalZ" value="2090" style="text-align:right; width:150; display:inline-block; font-size:50px; border-radius: 7px; color:white; background-color: #008CBA; " min="1" max="500000" height="100px" onchange="zapping(this.value)" onclick="zapping(this.value)">
			<input type="button" id="boton+" value="+" onclick="zapping(++document.getElementById('canalZ').value)" style="text-align:center; width:50; height:50; display:inline-block; font-size:50px; border-radius: 7px; color:white; background-color:#008CBA;">
			
			<script>
				var cambiar
				//var c = 6835
				
				function zapping(c){
					//c--
					console.log("Zapping: " + c)
					// http://161.0.157.9/PLTV/88888888/224/3221226834/index.m3u8
					url = "http://161.0.157.9/PLTV/88888888/224/322122" + c + "/index.m3u8"
					play(c,"","",url,0)
				}
					
				//cambiar = setInterval(zapping, 15000)

				// 6834 Max Prime
				// 6828	Universal Channel
				// 6825 MTV
				// 
			</script>
		</div>
		
	</div>

 

<script>
</script>

</body></html>
