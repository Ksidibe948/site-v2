
 <!-- la partie de connexion -->
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
  }
  
?>

<?php
           if ( isset($_POST['nom'])
             AND isset($_POST['telephone'])
             AND isset($_POST['adresse'])
           )
          
                                {
                                       
                                                       $nom=$_POST['nom'];
                                                       $telephone=$_POST['telephone'];
                                                       $adresse=$_POST['adresse'];
                                                      
                                                       $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
                                                       
                                                       $req=$bdd->prepare('UPDATE clients SET nom=? WHERE id=?');
                                                       $req->execute(array($nom,$_GET['id']));
                                                       header('Location:index.php?page=clients&id='.$donnees['id']);            
                                                       $req=$bdd->prepare('UPDATE clients SET telephone=? WHERE id=?');
                                                       $req->execute(array($telephone,$_GET['id']));
                                                       header('Location:index.php?page=clients&id='.$donnees['id']);

                                                       $req=$bdd->prepare('UPDATE clients SET adresse=? WHERE id=?');
                                                       $req->execute(array($adresse,$_GET['id']));
                                                       header('Location:index.php?page=clients&id='.$donnees['id']);
                                                     

                                                        
                                                }
              
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
                                                       
                                                        $req=$bdd->prepare('UPDATE clients SET logo=? WHERE id=?');
                                                        $req->execute(array($image,$_GET['id']));
                                                        header('Location:index.php?page=clients&id='.$donnees['id']);
                                                }
                                        }
                                }else {
                                   $error4='Ajouter une image!';
                                }                 // Testons si le fichier a bien été envoyé et s'il n'y a pas d'error
              
                                ?>
<?php
if (isset($_GET['id'])) {
  $getid=$_GET['id'];

   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $select=$bdd->prepare('SELECT * FROM clients where id=? ORDER BY id DESC');
   $select->execute(array($_GET['id']));
   $donnees=$select->fetch();
  
}
   ?>



<?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
    $banques=$bdd->prepare('SELECT * FROM banque where id_entreprise=? ORDER BY id DESC');
    $banques->execute(array($_SESSION['id']));
  ?>

<?php
$bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $actionnaires=$bdd->prepare('SELECT * FROM actionnaires where id_entreprise=? ORDER BY id DESC');
   $actionnaires->execute(array($_SESSION['id']));
   ?>
     <?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $capitals=$bdd->prepare('SELECT * FROM capitals where id_entreprise=? ORDER BY id DESC');
   $capitals->execute(array( $_SESSION['id']));
   $capital=$capitals->fetch();
 
   ?>
        <?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $capi=$bdd->prepare('SELECT * FROM capitals where id_entreprise=? ORDER BY id DESC');
   $capi->execute(array( $_SESSION['id']));
   ?>
  
      <?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $banques=$bdd->prepare('SELECT * FROM banque WHERE id_entreprise=? ORDER BY id DESC');
  $banques->execute(array( $_SESSION['id']));?>
 
   <?php
$bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $stocks_marchandises=$bdd->prepare('SELECT * FROM achats where id_entreprise=? ORDER BY id DESC');
   $stocks_marchandises->execute(array($_SESSION['id']));
   $stok_marchandise=$stocks_marchandises->rowcount();

   ?>
     <?php
$bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $stocks_marteriels=$bdd->prepare('SELECT * FROM achats_immobilisation where id_entreprise=? ORDER BY id DESC');
   $stocks_marteriels->execute(array($_SESSION['id']));
   $stok_materiel= $stocks_marteriels->rowcount();
   
   ?>
        <?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $vente_marchandise=$bdd->prepare('SELECT * FROM ventes_marchandise where id_entreprise=? ORDER BY id DESC');
   $vente_marchandise->execute(array($_SESSION['id']));
   $vente_marchandise= $vente_marchandise->rowcount();
    $vente_marchandise;
   
   ?>
  <?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $vente_materiels=$bdd->prepare('SELECT * FROM ventes_materiels where id_entreprise=? ORDER BY id DESC');
   $vente_materiels->execute(array($_SESSION['id']));
   $vente_materiels= $vente_materiels->rowcount();
   ?>
   <?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $autres_charges=$bdd->prepare('SELECT * FROM autres_charges where id_entreprise=? ORDER BY id DESC');
   $autres_charges->execute(array($_SESSION['id']));
   $autres_charges=  $autres_charges->rowcount();
   ?>
   <?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $autres_produits=$bdd->prepare('SELECT * FROM autre_produits where id_entreprise=? ORDER BY id DESC');
   $autres_produits->execute(array($_SESSION['id']));
   $autres_produits=$autres_produits->rowcount();
   

   ?>
   
   <?php
     $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
     $clients=$bdd->prepare('SELECT * FROM clients where id_entreprise=? ORDER BY id DESC');
     $clients->execute(array($_SESSION['id']));
       $client=$clients->rowcount();
     
     ?>
         <?php
     $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
     $fournisseur=$bdd->prepare('SELECT * FROM fournisseurs where id_entreprise=? ORDER BY id DESC');
     $fournisseur->execute(array($_SESSION['id']));
     $fournisseurs=$fournisseur->rowcount();
     
     ?>
  
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
        <li class="nav-item ">
        <a class="nav-link" href="index.php?page=utilisateurs"> Publications <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active ">
        <a class="nav-link  " href="index.php?page=comptabilite&id=<?=$_SESSION['id'] ?>">Comptabilité</a>
        </li>
        </ul>
        <ul class="navbar-nav ml-auto mr-5 ">
        <li class="nav-item dropdown">
          <a class="nav-link  dropdown-toggle ml-5" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?="<img src='".$_SESSION['images']."' class='images' style='width:2rem ; height:2rem; border-radius:100px ; ' alt=''>" ;?>
         <?= $_SESSION['nom']?>
          </a>
          <div class="dropdown-menu mr-5" aria-labelledby="navbarDropdownMenuLink">
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
          <a class="nav-link text-dark  " href="index.php?page=profil&id=<?=$_SESSION['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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

                            
                            <!-- la partie inscription -->
                            <div class="card  bg-light  w-100" style="width: 18rem; ">
                            <div class="card-body">
                                <h1 class="card-title pb-3 text-center">
                                Modifier  le compte de <?=  $donnees['nom'] ?>
                                </h1>
                                <form action="" method="POST" enctype="multipart/form-data">
                                
                              <div class="form-row">
                              <div class="form-group col-lg-1">
                              <label for="inputZip"><h5>Nom:</h5></label>
                              </div>
                              <div class="form-group col-lg-2">
                                <input type="text" value='<?=  $donnees['nom'] ?>' name='nom'class="form-control mr-5" id="inputCity" required placeholder="GOOGLE">
                              </div>
                              <div class="form-group col-lg-1">
                              <label for="inputZip"><h5>téléphone:</h5></label>
                              </div>
                              <div class="form-group col-lg-2">
                                <input type="tel"value='<?=  $donnees['telephone'] ?>'  name='telephone'class="form-control mr-5" id="inputCity" required placeholder="EX: +212 6 40 63 71 57">
                              </div>
                              <div class="form-group col-lg-1">
                              <label for="inputZip"><h5>Adresse</h5></label>
                              </div>
                              <div class="form-group col-lg-2">
                                <input type="text"value='<?=  $donnees['adresse'] ?>'  name='adresse'class="form-control mr-5" id="inputCity" required placeholder="Paris5, rue=2, porte=20">
                              </div>
                             
                               
                              <div class="form-group col-lg-1">
                              <label for="inputZip"><h5>Images:</h5></label>
                              </div>
                              <div class="form-group col-lg-2">
                                <input type="file"  name='monfichier'class="form-control mr-5" id="inputCity" >
                              </div>
                              </div> 

                                <div class="form-group text-center">
                                    <input type="submit" class='bg-success text-white' value="Confirmer">
                                </div>
                                </form>
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6">
                                    <?="<img src='".$donnees['logo']."' class='card-img' alt=''>" ;?>
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