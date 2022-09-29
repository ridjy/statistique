<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bienvenue sur Allo Taxi</title>
<meta name="description" content="La page se rétrécit pour laisser apparaitre le menu sur le coté des 4 que vous avez choisi." />
<meta name="Robots" content="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--
<link rel="shortcut icon" href="img/favicon.png">
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/icons.css" />
<link rel="stylesheet" type="text/css" href="css/style2.css" />
<script src="js/modernizr.custom.js"></script>
--> 

<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
<style>
			#logo
{
   display: inline-block;
    margin-bottom: -63px;
    margin-left: 40px;
	width:200px;
}
@media screen and (max-width : 380px) {
   header.masthead {
      background: transparent url(/img/Oceancall Group.png) no-repeat ;
   }
}

@media screen and (min-width : 381px) {
   header.masthead {
      background: transparent url(/img/Oceancall Group.png) no-repeat ;
   }
}
			#nav {
				list-style: none ;
				padding: 0; 
				margin: 20px;
				text-transform: uppercase;
				opacity:0.8;
				text-align: center; /* centrer le texte */
				overflow: hidden ;	/* Création du contexte de formatage */
				}
			#nav li {
				display: inline;
				
				}
			#nav li a {
				display:inline-block;
				font-family: Varela Round;
				font-weight: 400;
				margin: 0 30px;
				/*background: #900 url(img/pikla.jpg) left top no-repeat ;*/
				color:#e11f31;
				padding: 4px 0 ;
				text-align: center ;
				text-decoration: none ;
				}
			#nav li a:hover, #nav li a:focus, #nav li a:active {
				background: #ffffff ;
				text-decoration: underline ;
				}
				.footer{
				position:fixed;
				float:left;
				width:100%;
				line-height: 60px;
				bottom:0;
				height:120px;
				background-color:#222222;
				}
			.copyright{
				text-align:center;
				color:#FFF;
			}
				@-webkit-keyframes zoomIn {
  from {
    opacity: 0;
    -webkit-transform: scale3d(.3, .3, .3);
    transform: scale3d(.3, .3, .3);
  }

  50% {
    opacity: 1;
  }
}

@keyframes zoomIn {
  from {
    opacity: 0;
    -webkit-transform: scale3d(.3, .3, .3);
    transform: scale3d(.3, .3, .3);
  }

  50% {
    opacity: 1;
  }
}

@-webkit-keyframes zoomOut {
  from {
    opacity: 1;
  }

  50% {
    opacity: 0;
    -webkit-transform: scale3d(.3, .3, .3);
    transform: scale3d(.3, .3, .3);
  }

  to {
    opacity: 0;
  }
}

@keyframes zoomOut {
  from {
    opacity: 1;
  }

  50% {
    opacity: 0;
    -webkit-transform: scale3d(.3, .3, .3);
    transform: scale3d(.3, .3, .3);
  }

  to {
    opacity: 0;
  }
}

@-webkit-keyframes app {
   from  {opacity:0;}
   to {opacity:1;}
}

@keyframes app {
   from  {opacity:0;}
   to {opacity:1;}
}

.banner {
background:#e11f31;
font-family: Varela Round;
font-weight: 400;
color:#ffffff;
width:100%;
height:50px;
border:1px solid white;
text-align:left;
}

.animation {
-webkit-animation: app 1s, zoomIn 1s, zoomOut 1s forwards;
-webkit-animation-delay: 5s, 5s, 10s;
animation: app 1s, zoomIn 1s, zoomOut 1s forwards;
animation-delay: 5s, 5s, 10s;	
}
#principal{
background-color:#eeeeee;
opacity:0.8;
height:170px;
}
			
</style>

</head>
<body onLoad="TexteMultiligne();" onUnload="clearTimeout(Fin2)" bgcolor="#FFFFFF">
<div id="principal">

<div class="banner">
<p  style="font-size: 14px;margin-left:15px;">  
	<span class="fa fa-phone" style="margin-left: 100px;" aria-hidden="true"></span>
 <span class="fa fa-envelope-o fa-fw" style="margin-left: 150px;" aria-hidden="true"></span>
 <a href="../users/deconnect.php" style="margin-left: 200px; color: white; text-decoration: none;" title="retour à la page de connexion">D&eacute;connexion</a></p>
 
</div>


<!--<div id="logo">
            <img src="./img/LOGO2.gif" alt="Oceancall Group" title="Oceancall Group" id="logo"/>
</div>-->
<ul id="nav">
			<!--<li><a href="./bornage_statistique.php" title="aller Ã  la page d'accueil">Accueil</a></li>-->
			<li><a href="./bornage_statistiques.php" title="aller à la page des statistiques">Statistiques</a></li>
			
			<li><a href="../enregistrements/index.php" title="aller à la page des enregistrements">Enregistrements</a></li>
			
			<li><a href="gestion_users.php" title="Aller à la page de gestion des utilisateurs">Utilisateurs</a></li>
			
			<li><!----></li>
		</ul><br>
</div>
<br/>

<table align="center">
	<tr>
		<td height="280">
			<div class="w3-content w3-section" style="max-width:320px">

			  <img class="mySlides w3-animate-fading" src="<?php echo img_url('1.png'); ?>" style="width:100%">
			  <img class="mySlides w3-animate-fading" src="<?php echo img_url('logo.png'); ?>" style="width:100%">
			</div>

			<script>
			var myIndex = 0;
			carousel();

			function carousel() {
				var i;
				var x = document.getElementsByClassName("mySlides");
				for (i = 0; i < x.length; i++) {
				   x[i].style.display = "none";  
				}
				myIndex++;
				if (myIndex > x.length) {myIndex = 1}    
				x[myIndex-1].style.display = "block";  
				setTimeout(carousel, 9000);    
			}
			</script>
		</td>
	</tr>
	<tr>
		<td align="center">
			<font >
			<script language="JavaScript">
			<!-- begin script
			var pos1=0, pos2=0, Fin2;
			MsgN="Bienvenue sur notre site. Consulter, exporter vos statistiques. Ecouter et télécharger vos enregistrements"; 
			delai = 100;
			function TexteMultiligne() {
			   if (pos1 > MsgN.length) {
				  document.formnouv.multi1.value = '';
				  pos1 = 0;
				  pos2 = 0;
			   }
			   else if (MsgN.substring(pos1-2,pos1-1) == '.') {
				 document.formnouv.multi1.value = '';
				 pos2 = pos1-1;
				 pos1++;
			   }
			   else {
				 document.formnouv.multi1.value = MsgN.substring(pos1,pos2);  
				 pos1++;
			   }
			   Fin2 = setTimeout("TexteMultiligne() ", delai);
			}
			// end script
			</script>
			<form name="formnouv">
			<textarea name="multi1" COLS="40" ROWS="1"></textarea>
			</form>
		</td>
	</tr>
</table> 
<!-- source : http://tympanus.net/codrops/ -->

</body>
</html>