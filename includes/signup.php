<?php
if(isset($_GET['step']) === true && empty($_GET['step']) === false){
include '../core/init.php';
if (isset($_SESSION['user_id']) === false) {
  header('Location: ../index.php');
}

$user_id = $_SESSION['user_id'];
$user = $getFromU->userData($user_id);
$step = $_GET['step'];

if(isset($_POST['next'])){
  $username = $getFromU->checkInput($_POST['username']);

  if (!empty($username)) {
    if(strlen($username) > 20){
      $error = "Username must be between in 6-20 characters";
    }else if(!preg_match('/^[a-zA-Z0-9]{6,}$/', $username)){
      $error = 'Username must be longer than 6 alphanumeric characters without any spaces';
    } else if($getFromU->checkUsername($username) === true){
      $error = "Username is already taken!";
    }else{
      $getFromU->update('users', $user_id, array('username' => $username));
      header('Location: signup.php?step=2');
    }
  }else{
    $error = "Please enter your username to choose";
  }
}
  ?>
  <!doctype html>
  <html>
  	<head>
  		<title>FasipeX</title>
  		<meta charset="UTF-8" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
   		<link rel="stylesheet" href="../assets/css/style-complete.css"/>
   		<link rel="stylesheet" href="../assets/css/font-awesome.css"/>
  	</head>

  <body>
  <div class="wrapper">
  <div class="nav-wrapper">

  	<div class="nav-container">
  		<div class="nav-second">
  			<ul>
  				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"style="color:white;"></i></a></li>
  			</ul>
  		</div>
  	</div>

  </div>

  
  <div class="inner-wrapper">
  	<!-- container main -->
  	<div class="main-container">
  		
    <?php if ($_GET['step'] == '1') {?>
   		<div class="step-wrapper">
  		    <div class="step-container">
  				<form method="post" autocomplete="off">
  					<h2>Escolha um nome de usuário</h2>
  					<h4>Não se preocupe, você sempre pode alterá-lo mais tarde.</h4>
  					<div class="form-group">
  						<input class="form-control"type="text" name="username" placeholder="Nome de usuário" style="font-size: 16px;"/>
  					</div>
  					<div>
  						<ul>
  						  <li><?php if (isset($error)){echo $error;} ?></li>
  						</ul>
  					</div>
  					<div>
  						<input type="submit" name="next" value="Next"/>
  					</div>
  				 </form>
  			</div>
  		</div>
    <?php } ?>
    <?php if ($_GET['step'] == '2'){?>
  	<div class='lets-wrapper'>
  		<div class='step-letsgo'>
  			<h1>Estamos felizes por você estar aqui. <?php echo $user->screenName; ?> </h1>
  			<p style="font-size:22px;">O FasipeX é um fluxo em constante atualização das notícias, mídia, esportes, TV, conversas legais e importantes, tudo feito sob medida para você.</p>
  			<br>
  			<p style="font-size:22px;">
			  	Conte-nos sobre todas as coisas que você adora e nós o ajudaremos a se preparar.
  			</p>
  			<span>
  				<a href='../home.php' class='backButton' style="color:var(--twitter-color);">Vamos!</a>
  			</span>
  		</div>
  	</div>
  <?php } ?>

  	</div><!-- fim container main -->

  </div>
  </div>

  </body>
  </html>

  <?php
}
?>
