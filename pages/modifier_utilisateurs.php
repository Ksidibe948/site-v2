<?php 
    session_start();
    if ( isset($_SESSION['id']))

    {
        $getid=intval($_SESSION['id']);
            $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
            $req=$bdd->prepare('SELECT *FROM utilisateurs WHERE id=?');
            $req->execute(array($getid));
            $info=$req->fetch();
            $_SESSION['id']=$info['id'];
            $_SESSION['email']=$info['email'];
            $_SESSION['images']=$info['images'];
            $_SESSION['nom']=$info['nom'];
            $_SESSION['dates']=$info['dates'];
            $_SESSION['numero']=$info['numero'];
            $_SESSION['adresse']=$info['adresse'];
    }
    if (isset($_POST['pseudo'])) 
    { 
        $pseudo=htmlspecialchars($_POST['pseudo']);
        $pseudolenght=strlen($pseudo);
         if ($pseudolenght<=255) {
            $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
            $req=$bdd->prepare('UPDATE utilisateurs SET nom=? WHERE id=?');
            $req->execute(array($pseudo,$_SESSION['id']));
       
          //  partie numero
          if (isset($_POST['numero'])) 
          { 
                  $numero=htmlspecialchars($_POST['numero']);
                  $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
                  $req=$bdd->prepare('UPDATE utilisateurs SET numero=? WHERE id=?');
                  $req->execute(array($numero,$_SESSION['id']));
                  // partie adresse
                  if (isset($_POST['adresse'])) 
                  { 
                          $adresse=htmlspecialchars($_POST['adresse']);
                          $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
                          $req=$bdd->prepare('UPDATE utilisateurs SET adresse=? WHERE id=?');
                          $req->execute(array($adresse,$_SESSION['id']));
                        
            // la partie de email

            if (isset($_POST['email'])) 
            {  
                $email=htmlspecialchars($_POST['email']);
                $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
                $req=$bdd->prepare('SELECT *FROM utilisateurs WHERE email=?');
                $req->execute(array($email));
                $emailexist=$req->rowcount();
                if ( $emailexist==0) {
                            $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
                            $req=$bdd->prepare('UPDATE utilisateurs SET email=? WHERE id=?');
                            $req->execute(array($email,$_SESSION['id']));
                       
                    if (isset($_POST['password']) AND isset($_POST['password2']) ) 
                    {
                       $password=sha1($_POST['password']);
                       $password2=sha1($_POST['password2']);
                       if ($password==$password2)
                        {
                            $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
                            $req=$bdd->prepare('UPDATE utilisateurs SET password=? WHERE id=?');
                            $req->execute(array($password,$_SESSION['id']));
              
                           
                                ?>
                                <?php
                                 if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
                                {
                                        // Testons si le fichier n'est pas trop gros
                                        if ($_FILES['monfichier']['size'] <= 1000000)
                                        {
                                                // Testons si l'extension est autorisée
                                                $infosfichier = pathinfo($_FILES['monfichier']['name']);
                                                $extension_upload = $infosfichier['extension'];
                                                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                                                if (in_array($extension_upload, $extensions_autorisees))
                                                {
                                                        // On peut valider le fichier et le stocker définitivement
                                                        move_uploaded_file($_FILES['monfichier']['tmp_name'], 'images/' . basename($_FILES['monfichier']['name']));
                                                        $image='images/' . $_FILES['monfichier']['name'];
                                                        $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
                                                        $req=$bdd->prepare('UPDATE utilisateurs SET images=? WHERE id=?');
                                                        $req->execute(array( $image,$_SESSION['id']));
                                                        
                                                            header('Location:index.php?page=profil&id='.$_SESSION['id']);   header('Location:index.php?page=profil&id='.$_SESSION['id']);   
                                                        
                                                }
                                        }
                                }else {
                                   $error4='Ajouter une image!';
                                }                 // Testons si le fichier a bien été envoyé et s'il n'y a pas d'error
              
                                ?>
                                <?php
                       } else {
                           $error3='vos mot de passe ne se correspondent pas!';
                       }
                       
                    }
                } else {
                    $error2='Cet email existe déja!';
                }
                
            } else {
                # code...
            }
          }
        }
         } else {
            $error='Votre pseudo ne doit pas depasser 255 caractères!';
         }
         
       
    }
    
?>
 <!-- la partie de connexion -->
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../site/css/autor.css">
    <link rel="stylesheet" href="../Administration/bootstrap/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand ml-5 mr-5" href="#">
  <div class='logo text-white mt-1 bg-white '  style='border:solid #A41FDE 2px; width: 50px; text-decoration:underline #A41FDE double;'><span class='logo1' style='padding-left:5px; color:#A41FDE;'>S</span><svg color='#A41FDE'width="1.5em" height="1.5em" color='white' viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
    <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
    </svg>
    </div>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-5 ">
      <li class="nav-item active">
      <a class="nav-link" href="index.php?page=utilisateurs"> Publications <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
      <a class="nav-link  " href="index.php?page=comptabilite&id=<?=$_SESSION['id'] ?>">Comptabilité</a>
      </li>
      </ul>
      <ul class="navbar-nav ml-auto mr-5 ">
      <li class="nav-item dropdown">
        <a class="nav-link  dropdown-toggle ml-5" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?="<img src='".$_SESSION['images']."' class='images' style='width:2rem ; height:2rem; border-radius:100px ; ' alt=''>" ;?>
       <?= $_SESSION['nom']?>
        </a>
        <div class="dropdown-menu pl-2 mr-5" aria-labelledby="navbarDropdownMenuLink">
        <a class="nav-link " href="index.php?page=donnees_utilisateurs&id=<?=$_SESSION['id'] ?>">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-open" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.818l5.724 3.465L8 8.917l1.276.766L15 6.218V5.4a1 1 0 0 0-.53-.882l-6-3.2zM15 7.388l-4.754 2.877L15 13.117v-5.73zm-.035 6.874L8 10.083l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738zM1 13.117l4.754-2.852L1 7.387v5.73zM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2z"/>
        </svg> Publications 
        </a>
        <a class="nav-link text-dark  " href="index.php?page=publication&id=<?=$_SESSION['id'] ?>">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg> Publier
        </a>
        <a class="nav-link text-dark  " href="index.php?page=publication&id=<?=$_SESSION['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
          </svg> Profil
        </a>
        <a class="nav-link text-dark " href="index.php?page=modifier_utilisateurs&id=<?=$_SESSION['id'] ?>">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
          </svg> Modifier  profil
        </a>
        <a class="nav-link text-dark " href="index.php?page=deconnexion"> 
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder-symlink-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3zM2.19 3c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293L7.586 3H2.19zm9.608 5.271l-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742z"/>
        </svg> Déconnexion</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<div class="row">
  <div class="col-3 ">
  <nav class="navbar sticky-top navbar-expand-md navbar-light ">
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
     <ul class="navbar-nav mr-auto mt-2 mt-md-0">
      <li class="nav-item ">
      <li class="nav-item  ">
      <a class="nav-link " href="index.php?page=comptabilite&id=<?=$_SESSION['id'] ?>">Comptabilité</a>
      <a class="nav-link" href="index.php?page=utilisateurs"> Publications <span class="sr-only">(current)</span></a>
      <a class="nav-link active" href="#"> Modifier Profil <span class="sr-only">(current)</span></a>
    </li>
    </li>
    </ul>
  </div>
  </nav>
  </div>
  <div class="container">
   <div class="col-9  mt-2">
   <div class="card mb-3  bg-light" style="max-width: 500px;">
   <div class="row no-gutters">
    <div class="col-md-12 col-sm-4  ">
   <div class='nom'> <?="<img src='".$_SESSION['images']."' class='images w-100 '  alt=''>" ;?></div>
    </div>
    <div class="col-md-12">
      <div class="card-body">
  <div class='form'><form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
    <label for="formGroupExampleInput">Votre Pseudo:</label><br>
    <?php if (isset($error1)) 
    {
     ?>
     <span class="text-danger"> <?= $error1?></span>
    <?php
      }
    ?>
    <input type="text" value="<?= $_SESSION['nom'] ?>" name="pseudo" class="form-control" id="formGroupExampleInput" placeholder="Example Jean" >
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Ajouter Votre Numéro:</label><br>
    <?php if (isset($error1)) 
    {
     ?>
     <span class="text-danger"> <?= $error1?></span>
    <?php
      }
    ?>
    <input type="text" value="<?= $_SESSION['numero'] ?>" name="numero" class="form-control" id="formGroupExampleInput" placeholder="Example +223 68301034" >
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Ajouter Votre Adresse:</label><br>
    <?php if (isset($error1)) 
    {
     ?>
     <span class="text-danger"> <?= $error1?></span>
    <?php
      }
    ?>
    <input type="text" value="<?= $_SESSION['adresse'] ?>" name="adresse" class="form-control" id="formGroupExampleInput" placeholder="Example bamako Mali" >
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Votre email:</label><br>
    <?php if (isset($error2)) 
     {
    ?>
     <span class="text-danger"> <?= $error2
     ?></span>
    <?php
     }
     ?>
    <input type="email" name="email"  value="<?= $_SESSION['email'] ?>" class="form-control" id="formGroupExampleInput" placeholder="Example Jean@gmail.com" >
    </div>
    <div class="form-group">
    <label for="formGroupExampleInput">Votre mot de passe:</label>
     <input type="password" name="password" class="form-control" id="formGroupExampleInput" >
     </div>
    <div class="form-group">
     <label for="formGroupExampleInput">Confirmer votre mot de passe:</label>
    <input type="password" name="password2" class="form-control" id="formGroupExampleInput" >
     <?php if (isset($error3)) 
      {
       ?>
     <span class="text-danger"> <?= $error3?></span>
    <?php
     }
     ?>
    </div>

     <div class="form-group">
    <label for="formGroupExampleInput"> Ajouter une image:</label>
     <div class="erreur">
    <?php
   if (isset($erreur3)) 
    {
      ?>
     <div class="erreur text-danger"><?php echo $erreur3;?> </div>
    <?php
      }                   
     ?>
     </div>
    <input type="file"  name="monfichier" class="form-control" id="formGroupExampleInput" >
     </div>
     <div class="form-group">
     <div class="row">
      <div class="col-md-12 text-center">
     <input type="submit" value="Confimer" style='border:#D7D7DC;  background-color: #A41FDE; color:white;'  >
     </div>
     </div>
     </div>
    </form></p>
    </div> 
   </div>
    </div>
    </div>
    </div>
    </div>
    </div>
     </div>
    <script src="../Administration/bootstrap/bootstrap.min.js"></script>
    <script src="../Administration/bootstrap/jquery-3.5.1.js"></script>
</body>
</html>