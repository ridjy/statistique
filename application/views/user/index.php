<!DOCTYPE html >
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login</title>
	<meta name="description" content="La page se rêµ²ê¤©t pour laisser apparaitre le menu sur le coté¡¤es 4 que vous avez choisi." />
	<meta name="Robots" content="all"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo img_url('logo.png'); ?>">
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="<?php echo css_url('bouton_style'); ?>" /> 
	<style>
	.login{
		position: absolute; /* postulat de départ */
  		top: 50%; left: 50%; /* à 50%/50% du parent référent */
 		transform: translate(-50%, -50%);
	}
	</style>
</head>
<body bgcolor="#F8F8F8">
    <div id="principal" style="background-color:#F8F8F8">

    <br><br></div>
    <section id="login">
        <div class="container">
        	<div class="login">
                    	<?php  
                    		echo "<div class='alert'>";
                    		echo "<p style='color:red'>".$e."</p>";
                    		echo "</div>";
                    	?> 
                        <form role="form" action="<?php echo site_url('users/redirect') ?>" method="post" id="login-form" autocomplete="on">
                            <table>
                            <tr>
                                <td><label for="log" class="sr-only">Login</label></td>
                                <td><input type="text" name="log" id="log" class="form-control" placeholder="Votre login" value="<?php echo set_value('log'); ?>" required></td>
                            </tr>
                            <tr><td></td><td></td></tr>
                            <tr>
                                <td><label for="mdp" class="sr-only">Mot de passe</label></td>
                                <td><input type="password" name="mdp" id="mdp" class="form-control" placeholder="Votre mot de passe" value="<?php //echo set_value('mdp'); ?>" required></td>
                            </tr>
                            
                            <tr><td></td><td></td></tr>
                            <tr>
                            	<td><input type="submit" id="btn-login" class="btn btn-primary btn-lg" value="Log in"> </td>
                            	<td><input type="reset" id="btn-reset" class="btn btn-danger btn-sm" value="Reset"></td>
                            </tr>
                            </table>
                         
                        
                        </form>
                        <hr>
            	    </div>
        		
        	</div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <!--<footer class="footer">
            <div class="copyright">
                <p>&copy; 2017 BPOOI  Tous droits r&eacute;serv&eacute;s.</p>
            </div>
        </footer>-->





