 <?php
	$Nom =$Prenom =$Numero =$Message =$Email="";
	$NomErreur =$PrenomErreur =$NumeroErreur =$MessageErreur =$EmailErreur="";
	$OkForm =false;
	$EmailTo="patrick.dagouaga@uvci.edu.ci";
	$Felicitation="";
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$Nom =VerifInfo($_POST['Nom']);
		$Prenom =VerifInfo($_POST['Prenom']);
		$Numero=VerifInfo($_POST['Numero']);
		$Message =VerifInfo($_POST['Message']);
		$Email=VerifInfo($_POST['Email']);
		$EmailText="";
		$OkForm =true;
		if(empty($Prenom)){
			$PrenomErreur="Champion c'est quoi ton Prenom ";
			$OkForm =false;
		}
		else{
			$EmailText.="Salut $Prenom ";
		}
		if(empty($Nom)){
			$NomErreur= "wep  c'est quoi ton nom ";
			$OkForm =false;
		}
		else{
			$EmailText.="$Nom ";
		}
		if(empty($Message)){
			$MessageErreur="Wep tu voullais me dire quoi ??? ";
			$OkForm =false;
		}
		else{
			$EmailText.="\n $Message; ";
		}
		if(!VerifEmail($Email)){
			$EmailErreur="Djo ton Mail n'est pas valide";
			$OkForm =false;
		}
		if(!VerifTel($Numero)){
			$NumeroErreur="Veillez saisir un bon numerot de telephone svp";
			$OkForm =false;
		}
		
	}

	function VerifTel($tel){
		return preg_match("/^[0-9 ]*$/", $tel);
	}
	function VerifEmail($mail){
		return filter_var($mail,FILTER_VALIDATE_EMAIL);
	}
	function VerifInfo($info){
		$info =trim($info);
		$info=stripcslashes($info);
		$info=htmlspecialchars($info);
		return $info;
	}
	if($OkForm){

		$reseve="Email de : $Prenom $Nom Email <$Email>\r\nReplay $Email";
		mail($EmailTo,"Bienvenue",$EmailText,$reseve);
		$Nom =$Prenom =$Numero =$Message =$Email="";
	}
	
	?>



<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width  ,initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="https://fonts.google.com/specimen/Lato?selection.family=Lato">
	</head>
	<body>
		<div class="container">
			<div class="divider"></div>
			<div class="heading">
				<h2>Contactez-moi </h2>
			</div>
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<div id="error"></div>
					<form id="contact-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>" method="post" role="form" >
						<div class="row">
							<div class="col-md-6">
								<label>Prenom<span class="blue">*</span> </label>
								<input type="text" name="Prenom" placeholder="Entre votre Prenom" class="form-control" id="Prenom" value="<?php echo $Prenom?>">
								<p class="coment"><?php echo $PrenomErreur ?></p>
							</div>

							<div class="col-md-6">
								<label>Nom<span class="blue"> *</span></label>
								<input type="text" name="Nom" placeholder="Entre votre Nom" class="form-control" id="Nom"value="<?php echo $Nom?>">
								<p class="coment"><?php echo $NomErreur?></p>
							</div>

							<div class="col-md-6">
								<label>Email<span class="blue"> *</span> </label>
								<input type="email" name="Email"  placeholder="Entre votre Email" class="form-control" id="Prenom" value="<?php echo $Email?>">
								<p class="coment"><?php echo $EmailErreur; ?></p>
							</div>

							<div class="col-md-6">
								<label>Numero<span class="blue"> *</span></label>
								<input type="tel" name="Numero" placeholder="Entre votre Numero" class="form-control" id="Nom" value="<?php echo $Numero?>">
								<p class="coment"><?php echo $NumeroErreur; ?></p>
							</div>

							<div class="col-md-12">
								<label>Message<span class="blue"> *</span></label>
								<textarea class="form-control" name="Message" placeholder="Entre votre message " id="message" rows="4" > 
								<?php echo $Message ?>
								</textarea>
								<p class="coment"><?php echo $MessageErreur ?></p>
							</div>

							<div class="col-md-12">
								<p class="blue"><strong>*</strong> c'est informations sons requises </p>
							</div>

							<div class="col-md-12">
								<input type="submit" value="Valide le formulaire" class="valide">
							</div>

							<p class="merci" style="display:<?php if($OkForm){echo('block');}else{echo('none');}?>"><strong> Votre message a bien ete enregistre merci :-)<strong></p>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src='script.js'></script>
	</body>
</html>