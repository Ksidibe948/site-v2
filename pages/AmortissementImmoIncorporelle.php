
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
if (isset($_GET['id'])) {
    $getid=$_GET['id'];
}
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $amortissemnt_immoCoporelle=$bdd->prepare("SELECT * FROM stocksimmoincorporelle
 WHERE  id=? ");
   $amortissemnt_immoCoporelle->execute(array($getid));
  $resultat= $amortissemnt_immoCoporelle->fetch();
 ?>
      <?php
         $cent='100';
         $dureeS='';
        $montant=$resultat['quantiteS']*$resultat['prixS'];


         $cout_acquisition=   $montant +$resultat['frais_accessoireS'] ;
       
        $dureeS=$resultat['dureeS'];
        if( $dureeS > 0)
        {
            $taux_amortissement = 100/$dureeS ;
        }else {
            $taux_amortissement = 100/1 ;
        }
   ?>
      
<?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $achamarchandises=$bdd->prepare("SELECT
        AchatsImmoIncorporelle.id,
        AchatsImmoIncorporelle.id_client,
        AchatsImmoIncorporelle. id_entreprise,
        AchatsImmoIncorporelle.marchandise,
        AchatsImmoIncorporelle.quantite,
        AchatsImmoIncorporelle.prix,
        AchatsImmoIncorporelle.taux_tva,
        AchatsImmoIncorporelle. monyen_payement,
        AchatsImmoIncorporelle. montant_payement,
      fournisseurs.nom,
      fournisseurs.telephone,
      fournisseurs. adresse,
      fournisseurs.logo,
        DATE_FORMAT(  AchatsImmoIncorporelle.date,'%d/%m/%Y à %Hh%imin%ss') AS date
   FROM AchatsImmoIncorporelle,fournisseurs WHERE AchatsImmoIncorporelle.id_client=fournisseurs.id AND AchatsImmoIncorporelle. id=? ORDER BY id DESC");
   $achamarchandises->execute(array( $_GET['id']));
   $donnees=$achamarchandises->fetch();
 ?>
 
<?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $select=$bdd->prepare('SELECT * FROM actionnaires where id_entreprise=? ORDER BY id DESC');
   $select->execute(array($_SESSION['id']));
   ?>

<?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
    $banques=$bdd->prepare('SELECT * FROM banque where id_entreprise=? ORDER BY id DESC');
    $banques->execute(array($_SESSION['id']));
    $bq=$banques->rowcount();
  ?>

<?php
$bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $actionnaires=$bdd->prepare('SELECT * FROM actionnaires where id_entreprise=? ORDER BY id DESC');
   $actionnaires->execute(array($_SESSION['id']));
   $count=$actionnaires->rowcount();
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
   $cp=$capi->rowcount();
   ?>
  
      <?php
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $banques=$bdd->prepare('SELECT * FROM banque WHERE id_entreprise=? ORDER BY id DESC');
  $banques->execute(array( $_SESSION['id']));?>
 
   <?php
 $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $stocks_marchandises=$bdd->prepare('SELECT * FROM AchatsImmoIncorporelle where id_entreprise=? ORDER BY id DESC');
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
        <div class='logo text-white mt-1 bg-light '  style='border:solid #A41FDE 2px; width: 50px; text-decoration:underline #A41FDE double;'><span class='logo1' style='padding-left:5px; color:#A41FDE;'>S</span><svg color='#A41FDE'width="1.5em" height="1.5em" color='white' viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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
              <a class="nav-link text-secondary bg-light bg-light  " href="index.php?page=publication&id=<?=$_SESSION['id'] ?>">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
              <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
              </svg> Publier
              </a>
              <a class="nav-link text-secondary bg-light bg-light  " href="index.php?page=profil&id=<?=$_SESSION['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg> Profil
              </a>
              <a class="nav-link text-secondary bg-light bg-light " href="index.php?page=modifier_utilisateurs&id=<?=$_SESSION['id'] ?>">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg> Modifier  profil
              </a>
              <a class="nav-link text-secondary bg-light bg-light " href="index.php?page=deconnexion"> 
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder-symlink-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3zM2.19 3c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293L7.586 3H2.19zm9.608 5.271l-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742z"/>
              </svg> Déconnexion</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
   <div class="row">
        <div class="col-lg-3 col-12 ">
        <nav class="navbar sticky-top navbar-expand-lg navbar-light ">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <div class="overflow-auto" style='width:72%;
          height:800px;'>
           <ul  class="navbar-nav  mr-auto ">
            <li class="nav-item ">
            <a   class="nav-link p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light   " style='  font-size:1.3rem'  href="index.php?page=utilisateurs">
            <svg width="1.3rem" height="1.3rem" viewBox="0 0 16 16" class="bi bi-globe" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
           <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4H2.255a7.025 7.025 0 0 1 3.072-2.472 6.7 6.7 0 0 0-.597.933c-.247.464-.462.98-.64 1.539zm-.582 3.5h-2.49c.062-.89.291-1.733.656-2.5H3.82a13.652 13.652 0 0 0-.312 2.5zM4.847 5H7.5v2.5H4.51A12.5 12.5 0 0 1 4.846 5zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5H7.5V11H4.847a12.5 12.5 0 0 1-.338-2.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12H7.5v2.923c-.67-.204-1.335-.82-1.887-1.855A7.97 7.97 0 0 1 5.145 12zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11H1.674a6.958 6.958 0 0 1-.656-2.5h2.49c.03.877.138 1.718.312 2.5zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12h2.355a7.967 7.967 0 0 1-.468 1.068c-.552 1.035-1.218 1.65-1.887 1.855V12zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5h-2.49A13.65 13.65 0 0 0 12.18 5h2.146c.365.767.594 1.61.656 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4H8.5V1.077c.67.204 1.335.82 1.887 1.855.173.324.33.682.468 1.068z"/>
           </svg> Publications <span class="sr-only">(current)</span></a>
            <a  class="nav-link  p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light  " style="font-size:1.3rem"  href="index.php?page=comptabilite&id=<?=$_SESSION['id'] ?>">
            <svg width="1.3rem" height="1.3rem" viewBox="0 0 16 16" class="bi bi-calculator-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
           <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z"/>
           </svg> Comptabilité</a>
           <a  class="nav-link  p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light " style="font-size:1.3rem;  " href="index.php?page=comptabilité_generale&id=<?=$_SESSION['id'] ?>">
           <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-justify" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
          </svg>
         Comptabilités générales
        </a>
      <a  class="nav-link p-3  mb-1 shadow-sm bg-light bg-light bg-light " style="font-size:1.3rem; "  href="index.php?page=factures&id=<?=$_SESSION['id'] ?>">              
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
        <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
        <circle cx="3.5" cy="5.5" r=".5"/>
        <circle cx="3.5" cy="8" r=".5"/>
        <circle cx="3.5" cy="10.5" r=".5"/>
      </svg>
       Factures
        </a>
        <a  class="nav-link p-3  mb-1 shadow-sm bg-light bg-light bg-light " style="font-size:1.3rem; "  href="index.php?page=facturesachats&id=<?=$_SESSION['id'] ?>">              
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
        <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
        <circle cx="3.5" cy="5.5" r=".5"/>
        <circle cx="3.5" cy="8" r=".5"/>
        <circle cx="3.5" cy="10.5" r=".5"/>
      </svg>
       Factures Achats
        </a>
     <a  class="nav-link p-3  mb-1 shadow-sm bg-light "  style="font-size:1.2rem;color:#A41FDE" href="index.php?page=AchatsImmobilisationsIncorporelles&id=<?=$_SESSION['id'] ?>"> 
   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
    <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
    <circle cx="3.5" cy="5.5" r=".5"/>
    <circle cx="3.5" cy="8" r=".5"/>
    <circle cx="3.5" cy="10.5" r=".5"/>
  </svg>
   Achats Immobilisations Incoorporelles
   </a>
  <a style="font-size:1.2rem; color:red; font-family:arial" class="nav-link p-3  mb-1 shadow-sm bg-light " href="index.php?page=AmortissementImmoIncorporelle&id=<?=$_GET['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-graph-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
   <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 11.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-1 0v2.6l-3.613-4.417a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61L13.445 11H10.5a.5.5 0 0 0-.5.5z"/>
 </svg> Tableau de  <?=$donnees['marchandise'] ?></a>
        <a  class="nav-link p-3  mb-1 shadow-sm bg-light  bg-light "  style="font-size:1.2rem;" href="index.php?page=produits&id=<?=$_SESSION['id'] ?>"> 
       <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-fullscreen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
       <path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4A1.5 1.5 0 0 1 1.5 0h4a.5.5 0 0 1 0 1h-4zM10 .5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 16 1.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5zM.5 10a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 0 14.5v-4a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5z"/>
     </svg>
      Produits
      </a>
         <a  class="nav-link p-3  mb-1 shadow-sm bg-light "  style="font-size:1.3rem;" href="index.php?page=charges&id=<?=$_SESSION['id'] ?>"> 
       <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-fullscreen-exit" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M5.5 0a.5.5 0 0 1 .5.5v4A1.5 1.5 0 0 1 4.5 6h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5zm5 0a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 10 4.5v-4a.5.5 0 0 1 .5-.5zM0 10.5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 6 11.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5zm10 1a1.5 1.5 0 0 1 1.5-1.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4z"/>
      </svg>
       Charges
       </a>
       <a style="font-size:1.3rem; " class="nav-link p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light " href="index.php?page=banque&id=<?=$_SESSION['id'] ?>">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-credit-card-2-back" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M14 3H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
        <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1zM1 9h14v2H1V9z"/>
      </svg> Banque 
      </a>
      <a   class="nav-link p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light " style="font-size:1.3rem;" href="index.php?page=capital&id=<?=$_SESSION['id'] ?>">
       <svg width="1em"  height="1em" viewBox="0 0 16 16" class="bi bi-cash-stack" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M14 3H1a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1h-1z"/>
        <path fill-rule="evenodd" d="M15 5H1v8h14V5zM1 4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H1z"/>
        <path d="M13 5a2 2 0 0 0 2 2V5h-2zM3 5a2 2 0 0 1-2 2V5h2zm10 8a2 2 0 0 1 2-2v2h-2zM3 13a2 2 0 0 0-2-2v2h2zm7-4a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
      </svg>
       Capital   
      </a>
      
      <a  class="nav-link p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light " style="font-size:1.3rem;" href="index.php?page=actionnaires&id=<?=$_SESSION['id'] ?>">
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
      </svg>
       Actionnaire
      
      </a>   
      <a class="nav-link p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light " style="font-size:1.3rem; "   href="index.php?page=clients&id=<?=$_SESSION['id'] ?>">              
      <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-people" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1h7.956a.274.274 0 0 0 .014-.002l.008-.002c-.002-.264-.167-1.03-.76-1.72C13.688 10.629 12.718 10 11 10c-1.717 0-2.687.63-3.24 1.276-.593.69-.759 1.457-.76 1.72a1.05 1.05 0 0 0 .022.004zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10c-1.668.02-2.615.64-3.16 1.276C1.163 11.97 1 12.739 1 13h3c0-1.045.323-2.086.92-3zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                </svg>         
                  Clients <?php if ($client>0) {
                 ?>
                  <span style='color:green'>(<?= $client?>)</span>
                 <?php
                }else {
                  echo '(0)';
                }?>
              </a>
      <a  class="nav-link p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light" style="font-size:1.3rem; " href="index.php?page=fournisseurs&id=<?=$_SESSION['id'] ?>">              
           
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1h7.956a.274.274 0 0 0 .014-.002l.008-.002c-.002-.264-.167-1.03-.76-1.72C13.688 10.629 12.718 10 11 10c-1.717 0-2.687.63-3.24 1.276-.593.69-.759 1.457-.76 1.72a1.05 1.05 0 0 0 .022.004zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10c-1.668.02-2.615.64-3.16 1.276C1.163 11.97 1 12.739 1 13h3c0-1.045.323-2.086.92-3zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                </svg>
                Fournisseurs  <?php if ($fournisseurs>0) {
                 ?>
                  <span style='color:green'>(<?= $fournisseurs?>)</span>
                 <?php
                }else {
                  echo '(0)';
                }?>
      </a>
      
         <a  class="nav-link p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light " style="font-size:1.3rem;" href="index.php?page=Stocks&id=<?=$_SESSION['id'] ?>"> 
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
       </svg>
       Stocks
      </a>
      <a  class="nav-link p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light "style="font-size:1.3rem;"  href="index.php?page=balance&id=<?=$_SESSION['id'] ?>">
       <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-hourglass-split" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0c0 .701.478 1.236 1.011 1.492A3.5 3.5 0 0 1 11.5 13s-.866-1.299-3-1.48V8.35z"/>
      </svg>
       Balances
      </a>
      <a  class="nav-link p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light" style="font-size:1.3rem;" href="index.php?page=Bilan&id=<?=$_SESSION['id'] ?>">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
         </svg>
        Bilan
         </a>
       <a  class="nav-link p-3  mb-1 shadow-sm bg-light text-secondary bg-light bg-light  " style="font-size:1.3rem;" href="index.php?page=cpc&id=<?=$_SESSION['id'] ?>"> 
       <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
        <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
      </svg>
       CPC
       </a>
      </li>
      </ul>
      </div>
      </div>
      </nav>
      </div> 
      <div class="col-lg-6 col-12"> 
      <div class="col-12">   
  <?php
   if ($resultat['systemeS']=='Lineaire') {
       ?>
      
        <div class="col-10 text-left bg-secondary text-light p-4 ">
        
        <h1>Tableau d'Amortissement de <?=$donnees['marchandise'] ?></h1> 
  </div>
       <?php
   }else {
       ?>
       <div class="col-12 text-left bg-secondary text-light p-4">
        <h1>Tableau d'Amortissement de <?=$donnees['marchandise'] ?></h1> 
  </div>
       <?php
   }
  ?>
    <?php
    if ($resultat['dureeS']==1 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;
            $annuite2=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;

            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                     <br><div class="row ">
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div><br>
        
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?> 
            
    <?php
    if ($resultat['dureeS']==2 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;
            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
         
    

            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
      


     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
        
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>  
            
    <?php
    if ($resultat['dureeS']==3 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;
            
            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
    
            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            


     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
               

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?> 
           
    <?php
    if ($resultat['dureeS']==4 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;


            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;


     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div><br>

                   
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>

            
<?php
    if ($resultat['dureeS']==5 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;


            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition-$annuite_cumule_6;


     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                         
                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>

                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div><br>

                   
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
            
    <?php
    if ($resultat['dureeS']==6 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;

       
            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition - $annuite_cumule_7;

     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>       
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div><br>
                   
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
    <?php
    if ($resultat['dureeS']==7 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>
                     <div class="row">
                     <div >
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>        
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div> <br>
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
                             
    
    <?php
    if ($resultat['dureeS']==8 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;
            $annuite_cumule_9=$annuite_cumule_8+$annuite9;

            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;

     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div><br>
            
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
                      
    
    <?php
    if ($resultat['dureeS']==9 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;
            $annuite10=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;

            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;

       
    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>

                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div><br>
                  
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
    
                   
    
    <?php
    if ($resultat['dureeS']==10 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;
            $annuite10=$cout_acquisition*$taux_amortissement/100;
            $annuite11=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;
            $annuite_cumule_11=$annuite_cumule_10+$annuite11;

            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;
            $vnc11=$cout_acquisition-$annuite_cumule_11;
       
    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div>
                                        
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                     </div><br>

                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
   
                  
    
    <?php
    if ($resultat['dureeS']==11 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;

            $annuite10=$cout_acquisition*$taux_amortissement/100;
            $annuite11=$cout_acquisition*$taux_amortissement/100;
            $annuite12=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;
            $annuite_cumule_11=$annuite_cumule_10+$annuite11;
            $annuite_cumule_12=$annuite_cumule_11+$annuite12;

            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;
            $vnc11=$cout_acquisition-$annuite_cumule_11;
            $vnc12=$cout_acquisition - $annuite_cumule_12;




    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                     </div><br>
                    
               
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
    
      
    
    <?php
    if ($resultat['dureeS']==12 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;

            $annuite10=$cout_acquisition*$taux_amortissement/100;
            $annuite11=$cout_acquisition*$taux_amortissement/100;
            $annuite12=$cout_acquisition*$taux_amortissement/100;
            $annuite13=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;
            $annuite_cumule_11=$annuite_cumule_10+$annuite11;
            $annuite_cumule_12=$annuite_cumule_11+$annuite12;
            $annuite_cumule_13=$annuite_cumule_12+$annuite13;

            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;
            $vnc11=$cout_acquisition-$annuite_cumule_11;
            $vnc12=$cout_acquisition - $annuite_cumule_12;
            $vnc13=$cout_acquisition-$annuite_cumule_13;



    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                     </div><br>
            
               
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
    
    
    
    <?php
    if ($resultat['dureeS']==13 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;

            $annuite10=$cout_acquisition*$taux_amortissement/100;
            $annuite11=$cout_acquisition*$taux_amortissement/100;
            $annuite12=$cout_acquisition*$taux_amortissement/100;
            $annuite13=$cout_acquisition*$taux_amortissement/100;
            $annuite14=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;
            $annuite_cumule_11=$annuite_cumule_10+$annuite11;
            $annuite_cumule_12=$annuite_cumule_11+$annuite12;
            $annuite_cumule_13=$annuite_cumule_12+$annuite13;
            $annuite_cumule_14=$annuite_cumule_13+$annuite14;

            
        
  

  



            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;
            $vnc11=$cout_acquisition-$annuite_cumule_11;
            $vnc12=$cout_acquisition - $annuite_cumule_12;
            $vnc13=$cout_acquisition-$annuite_cumule_13;
            $vnc14=$cout_acquisition-$annuite_cumule_14;


    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                     </div><br>
               
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
    
    
    <?php
    if ($resultat['dureeS']==14 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;

            $annuite10=$cout_acquisition*$taux_amortissement/100;
            $annuite11=$cout_acquisition*$taux_amortissement/100;
            $annuite12=$cout_acquisition*$taux_amortissement/100;
            $annuite13=$cout_acquisition*$taux_amortissement/100;
            $annuite14=$cout_acquisition*$taux_amortissement/100;
            $annuite15=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;
            $annuite_cumule_11=$annuite_cumule_10+$annuite11;
            $annuite_cumule_12=$annuite_cumule_11+$annuite12;
            $annuite_cumule_13=$annuite_cumule_12+$annuite13;
            $annuite_cumule_14=$annuite_cumule_13+$annuite14;
            $annuite_cumule_15=$annuite_cumule_14+$annuite15;
            
        
  

  



            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;
            $vnc11=$cout_acquisition-$annuite_cumule_11;
            $vnc12=$cout_acquisition - $annuite_cumule_12;
            

            $vnc13=$cout_acquisition-$annuite_cumule_13;
            $vnc14=$cout_acquisition-$annuite_cumule_14;
            $vnc15=$cout_acquisition-$annuite_cumule_15;

    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                     </div><br>
                 
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
    
    
    <?php
    if ($resultat['dureeS']==15 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;

            $annuite10=$cout_acquisition*$taux_amortissement/100;
            $annuite11=$cout_acquisition*$taux_amortissement/100;
            $annuite12=$cout_acquisition*$taux_amortissement/100;
            $annuite13=$cout_acquisition*$taux_amortissement/100;
            $annuite14=$cout_acquisition*$taux_amortissement/100;
            $annuite15=$cout_acquisition*$taux_amortissement/100;
            $annuite16=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;
            $annuite_cumule_11=$annuite_cumule_10+$annuite11;
            $annuite_cumule_12=$annuite_cumule_11+$annuite12;
            $annuite_cumule_13=$annuite_cumule_12+$annuite13;
            $annuite_cumule_14=$annuite_cumule_13+$annuite14;
            $annuite_cumule_15=$annuite_cumule_14+$annuite15;
            
            $annuite_cumule_16=$annuite_cumule_15+$annuite16;
  

  



            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;
            $vnc11=$cout_acquisition-$annuite_cumule_11;
            $vnc12=$cout_acquisition - $annuite_cumule_12;
            

            $vnc13=$cout_acquisition-$annuite_cumule_13;
            $vnc14=$cout_acquisition-$annuite_cumule_14;
            $vnc15=$cout_acquisition-$annuite_cumule_15;
            $vnc16=$cout_acquisition-$annuite_cumule_16;
      


            
    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                     </div><br>

                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
    
    <?php
    if ($resultat['dureeS']==16 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;

            $annuite10=$cout_acquisition*$taux_amortissement/100;
            $annuite11=$cout_acquisition*$taux_amortissement/100;
            $annuite12=$cout_acquisition*$taux_amortissement/100;
            $annuite13=$cout_acquisition*$taux_amortissement/100;
            $annuite14=$cout_acquisition*$taux_amortissement/100;
            $annuite15=$cout_acquisition*$taux_amortissement/100;
            $annuite16=$cout_acquisition*$taux_amortissement/100;
            $annuite17=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;
            $annuite_cumule_11=$annuite_cumule_10+$annuite11;
            $annuite_cumule_12=$annuite_cumule_11+$annuite12;
            $annuite_cumule_13=$annuite_cumule_12+$annuite13;
            $annuite_cumule_14=$annuite_cumule_13+$annuite14;
            $annuite_cumule_15=$annuite_cumule_14+$annuite15;
            
            $annuite_cumule_16=$annuite_cumule_15+$annuite16;
            $annuite_cumule_17=$annuite_cumule_16+$annuite17;

  



            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;
            $vnc11=$cout_acquisition-$annuite_cumule_11;
            $vnc12=$cout_acquisition - $annuite_cumule_12;
            

            $vnc13=$cout_acquisition-$annuite_cumule_13;
            $vnc14=$cout_acquisition-$annuite_cumule_14;
            $vnc15=$cout_acquisition-$annuite_cumule_15;
            $vnc16=$cout_acquisition-$annuite_cumule_16;
            $vnc17=$cout_acquisition-$annuite_cumule_17;


            
    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             17ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc17?> </h6>
                         </div>
                     </div><br>
                
                 
                    
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
 
    
    <?php
    if ($resultat['dureeS']==17 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;

            $annuite10=$cout_acquisition*$taux_amortissement/100;
            $annuite11=$cout_acquisition*$taux_amortissement/100;
            $annuite12=$cout_acquisition*$taux_amortissement/100;
            $annuite13=$cout_acquisition*$taux_amortissement/100;
            $annuite14=$cout_acquisition*$taux_amortissement/100;
            $annuite15=$cout_acquisition*$taux_amortissement/100;
            $annuite16=$cout_acquisition*$taux_amortissement/100;
            $annuite17=$cout_acquisition*$taux_amortissement/100;
            $annuite18=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;
            $annuite_cumule_11=$annuite_cumule_10+$annuite11;
            $annuite_cumule_12=$annuite_cumule_11+$annuite12;
            $annuite_cumule_13=$annuite_cumule_12+$annuite13;
            $annuite_cumule_14=$annuite_cumule_13+$annuite14;
            $annuite_cumule_15=$annuite_cumule_14+$annuite15;
            
            $annuite_cumule_16=$annuite_cumule_15+$annuite16;
            $annuite_cumule_17=$annuite_cumule_16+$annuite17;
            $annuite_cumule_18=$annuite_cumule_17+$annuite18;
    
  



            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;
            $vnc11=$cout_acquisition-$annuite_cumule_11;
            $vnc12=$cout_acquisition - $annuite_cumule_12;
            

            $vnc13=$cout_acquisition-$annuite_cumule_13;
            $vnc14=$cout_acquisition-$annuite_cumule_14;
            $vnc15=$cout_acquisition-$annuite_cumule_15;
            $vnc16=$cout_acquisition-$annuite_cumule_16;
            $vnc17=$cout_acquisition-$annuite_cumule_17;
            $vnc18=$cout_acquisition - $annuite_cumule_18;
 
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             17ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc17?> </h6>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             18ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc18?> </h6>
                         </div>
                     </div><br>
             
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
 
    
    <?php
    if ($resultat['dureeS']==18 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;

            $annuite10=$cout_acquisition*$taux_amortissement/100;
            $annuite11=$cout_acquisition*$taux_amortissement/100;
            $annuite12=$cout_acquisition*$taux_amortissement/100;
            $annuite13=$cout_acquisition*$taux_amortissement/100;
            $annuite14=$cout_acquisition*$taux_amortissement/100;
            $annuite15=$cout_acquisition*$taux_amortissement/100;
            $annuite16=$cout_acquisition*$taux_amortissement/100;
            $annuite17=$cout_acquisition*$taux_amortissement/100;
            $annuite18=$cout_acquisition*$taux_amortissement/100;
            $annuite19=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;
            $annuite_cumule_11=$annuite_cumule_10+$annuite11;
            $annuite_cumule_12=$annuite_cumule_11+$annuite12;
            $annuite_cumule_13=$annuite_cumule_12+$annuite13;
            $annuite_cumule_14=$annuite_cumule_13+$annuite14;
            $annuite_cumule_15=$annuite_cumule_14+$annuite15;
            
            $annuite_cumule_16=$annuite_cumule_15+$annuite16;
            $annuite_cumule_17=$annuite_cumule_16+$annuite17;
            $annuite_cumule_18=$annuite_cumule_17+$annuite18;
            $annuite_cumule_19=$annuite_cumule_18+$annuite19;
  



            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;
            $vnc11=$cout_acquisition-$annuite_cumule_11;
            $vnc12=$cout_acquisition - $annuite_cumule_12;
            

            $vnc13=$cout_acquisition-$annuite_cumule_13;
            $vnc14=$cout_acquisition-$annuite_cumule_14;
            $vnc15=$cout_acquisition-$annuite_cumule_15;
            $vnc16=$cout_acquisition-$annuite_cumule_16;
            $vnc17=$cout_acquisition-$annuite_cumule_17;
            $vnc18=$cout_acquisition - $annuite_cumule_18;
            $vnc19=$cout_acquisition - $annuite_cumule_19;

            
    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             17ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc17?> </h6>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             18ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc18?> </h6>
                         </div>
                     </div><br>
                                                           
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             19ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc19?> </h6>
                         </div>
                     </div><br>
                 
                 
                    
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
 
    <?php
    if ($resultat['dureeS']==19 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;

            $annuite10=$cout_acquisition*$taux_amortissement/100;
            $annuite11=$cout_acquisition*$taux_amortissement/100;
            $annuite12=$cout_acquisition*$taux_amortissement/100;
            $annuite13=$cout_acquisition*$taux_amortissement/100;
            $annuite14=$cout_acquisition*$taux_amortissement/100;
            $annuite15=$cout_acquisition*$taux_amortissement/100;
            $annuite16=$cout_acquisition*$taux_amortissement/100;
            $annuite17=$cout_acquisition*$taux_amortissement/100;
            $annuite18=$cout_acquisition*$taux_amortissement/100;
            $annuite19=$cout_acquisition*$taux_amortissement/100;
            $annuite20=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;
            $annuite_cumule_11=$annuite_cumule_10+$annuite11;
            $annuite_cumule_12=$annuite_cumule_11+$annuite12;
            $annuite_cumule_13=$annuite_cumule_12+$annuite13;
            $annuite_cumule_14=$annuite_cumule_13+$annuite14;
            $annuite_cumule_15=$annuite_cumule_14+$annuite15;
            
            $annuite_cumule_16=$annuite_cumule_15+$annuite16;
            $annuite_cumule_17=$annuite_cumule_16+$annuite17;
            $annuite_cumule_18=$annuite_cumule_17+$annuite18;
            $annuite_cumule_19=$annuite_cumule_18+$annuite19;
            $annuite_cumule_20=$annuite_cumule_19+$annuite20;



            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;
            $vnc11=$cout_acquisition-$annuite_cumule_11;
            $vnc12=$cout_acquisition - $annuite_cumule_12;
            

            $vnc13=$cout_acquisition-$annuite_cumule_13;
            $vnc14=$cout_acquisition-$annuite_cumule_14;
            $vnc15=$cout_acquisition-$annuite_cumule_15;
            $vnc16=$cout_acquisition-$annuite_cumule_16;
            $vnc17=$cout_acquisition-$annuite_cumule_17;
            $vnc18=$cout_acquisition - $annuite_cumule_18;
            $vnc19=$cout_acquisition-$annuite_cumule_19;
            $vnc20=$cout_acquisition-$annuite_cumule_20;
            
    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             17ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc17?> </h6>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             18ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc18?> </h6>
                         </div>
                     </div>
                                                                
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             19ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc19?> </h6>
                         </div>
                     </div>
                                                            
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             20ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite20?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_20?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc20?> </h6>
                         </div>
                     </div><br>
                    
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>

    <?php
    if ($resultat['dureeS']==20 AND$resultat['systemeS']=='Lineaire') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }
            $annuite=$cout_acquisition*$taux_amortissement*$a1/1200;

            $annuite2=$cout_acquisition*$taux_amortissement/100;
            $annuite3=$cout_acquisition*$taux_amortissement/100;
            $annuite4=$cout_acquisition*$taux_amortissement/100;
            $annuite5=$cout_acquisition*$taux_amortissement/100;
            $annuite6=$cout_acquisition*$taux_amortissement/100;
            $annuite7=$cout_acquisition*$taux_amortissement/100;
            $annuite8=$cout_acquisition*$taux_amortissement/100;
            $annuite9=$cout_acquisition*$taux_amortissement/100;

            $annuite10=$cout_acquisition*$taux_amortissement/100;
            $annuite11=$cout_acquisition*$taux_amortissement/100;
            $annuite12=$cout_acquisition*$taux_amortissement/100;
            $annuite13=$cout_acquisition*$taux_amortissement/100;
            $annuite14=$cout_acquisition*$taux_amortissement/100;
            $annuite15=$cout_acquisition*$taux_amortissement/100;
            $annuite16=$cout_acquisition*$taux_amortissement/100;
            $annuite17=$cout_acquisition*$taux_amortissement/100;
            $annuite18=$cout_acquisition*$taux_amortissement/100;
            $annuite19=$cout_acquisition*$taux_amortissement/100;
            $annuite20=$cout_acquisition*$taux_amortissement/100;
            $annuite21=$cout_acquisition*$taux_amortissement*$a2/1200;
             
            $annuite_cumule_1=$annuite;
            $annuite_cumule_2=$annuite_cumule_1+$annuite2;
            $annuite_cumule_3=$annuite_cumule_2+$annuite3;
            $annuite_cumule_4=$annuite_cumule_3+$annuite4;
            $annuite_cumule_5=$annuite_cumule_4+$annuite5;
            $annuite_cumule_6=$annuite_cumule_5+$annuite6;
            $annuite_cumule_7=$annuite_cumule_6+$annuite7;
            $annuite_cumule_8=$annuite_cumule_7+$annuite8;

            $annuite_cumule_9=$annuite_cumule_8+$annuite9;
            $annuite_cumule_10=$annuite_cumule_9+$annuite10;
            $annuite_cumule_11=$annuite_cumule_10+$annuite11;
            $annuite_cumule_12=$annuite_cumule_11+$annuite12;
            $annuite_cumule_13=$annuite_cumule_12+$annuite13;
            $annuite_cumule_14=$annuite_cumule_13+$annuite14;
            $annuite_cumule_15=$annuite_cumule_14+$annuite15;
            
            $annuite_cumule_16=$annuite_cumule_15+$annuite16;
            $annuite_cumule_17=$annuite_cumule_16+$annuite17;
            $annuite_cumule_18=$annuite_cumule_17+$annuite18;
            $annuite_cumule_19=$annuite_cumule_18+$annuite19;
            $annuite_cumule_20=$annuite_cumule_19+$annuite20;
            $annuite_cumule_21=$annuite_cumule_20+$annuite21;



            $vnc1=$cout_acquisition-$annuite_cumule_1;
            $vnc2=$cout_acquisition-$annuite_cumule_2;
            $vnc3=$cout_acquisition-$annuite_cumule_3;
            $vnc4=$cout_acquisition-$annuite_cumule_4;
            $vnc5=$cout_acquisition-$annuite_cumule_5;
            $vnc6=$cout_acquisition - $annuite_cumule_6;
            $vnc7=$cout_acquisition-$annuite_cumule_7;
            $vnc8=$cout_acquisition-$annuite_cumule_8;
            $vnc9=$cout_acquisition-$annuite_cumule_9;
            $vnc10=$cout_acquisition-$annuite_cumule_10;
            $vnc11=$cout_acquisition-$annuite_cumule_11;
            $vnc12=$cout_acquisition - $annuite_cumule_12;
            

            $vnc13=$cout_acquisition-$annuite_cumule_13;
            $vnc14=$cout_acquisition-$annuite_cumule_14;
            $vnc15=$cout_acquisition-$annuite_cumule_15;
            $vnc16=$cout_acquisition-$annuite_cumule_16;
            $vnc17=$cout_acquisition-$annuite_cumule_17;
            $vnc18=$cout_acquisition - $annuite_cumule_18;
            $vnc19=$cout_acquisition-$annuite_cumule_19;
            $vnc20=$cout_acquisition-$annuite_cumule_20;
            $vnc21=$cout_acquisition-$annuite_cumule_21;
            
    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row ">
                        
                         <div class="col-2  mt-2 pt-1 "style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux</h6>
                         </div>
                     </div>
                     <div class="row ">
                         
                     <div class="col-2   pt-1 "style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             17ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc17?> </h6>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             18ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc18?> </h6>
                         </div>
                     </div>
                                                                
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             19ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc19?> </h6>
                         </div>
                     </div>
                                                            
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             20ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite20?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_20?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc20?> </h6>
                         </div>
                     </div>
                                                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             21ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite21?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_21?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc21?> </h6>
                         </div>
                     </div><br>
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
    <!-- pour le syteme degessif -->
 <?php
    if ($resultat['dureeS']==3 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  


             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

         
   
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div><br>
                    
                
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>

        <?php
    if ($resultat['dureeS']==4 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 



             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
    
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div><br>
            
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
     <?php
    if ($resultat['dureeS']==5 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 


             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

  
   
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                      
                
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
      <?php
    if ($resultat['dureeS']==6 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 

             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

   
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> <br>

                   
                
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
     <?php
    if ($resultat['dureeS']==7 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
 
             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                        
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
       
     <?php
    if ($resultat['dureeS']==8 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 



             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;


   
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div><br>
                  
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
      <?php
    if ($resultat['dureeS']==9 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 

             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
     <?php
    if ($resultat['dureeS']==10 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 
  $moist11= $moist10-12;
  $t11=12/$moist11 *100 ; 

             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

                           
    $vo11=$vnc10;
    if ($taux_degressif>$t11) {
       $annuite11=$vo11 * $taux_degressif/100;
       
   }else {
       $annuite11=$vo11 *$t11/100;
   }
   $annuite_cumule_11=$annuite_cumule_10+$annuite11;
   $vnc11=$vo11-$annuite11;
   
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo11?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist11= $moist10-12;
                               echo $t11=12/$moist11 *100 .'%';
                          ?>
                         </div>
                     </div>
                
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
         
<?php
    if ($resultat['dureeS']==11 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 
  $moist11= $moist10-12;
  $t11=12/$moist11 *100 ; 
  $moist12= $moist11-12;
  $t12=12/$moist12 *100 ; 
  



             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

                           
    $vo11=$vnc10;
    if ($taux_degressif>$t11) {
       $annuite11=$vo11 * $taux_degressif/100;
       
   }else {
       $annuite11=$vo11 *$t11/100;
   }
   $annuite_cumule_11=$annuite_cumule_10+$annuite11;
   $vnc11=$vo11-$annuite11;
   
                           
   $vo12=$vnc11;
   if ($taux_degressif>$t12) {
      $annuite12=$vo12 * $taux_degressif/100;
      
  }else {
      $annuite12=$vo12 *$t12/100;
  }
  $annuite_cumule_12=$annuite_cumule_11+$annuite12;
  $vnc12=$vo12-$annuite12;


     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo11?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist11= $moist10-12;
                               echo $t11=12/$moist11 *100 .'%';
                          ?>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo12?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist12= $moist11-12;
                               echo $t12=12/$moist12 *100 .'%';
                          ?>
                         </div>
                     </div><br>
                                  
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
      
      <?php
    if ($resultat['dureeS']==12 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 
  $moist11= $moist10-12;
  $t11=12/$moist11 *100 ; 
  $moist12= $moist11-12;
  $t12=12/$moist12 *100 ; 
  
  $moist13= $moist12-12;
  $t13=12/$moist13 *100 ; 

             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

                           
    $vo11=$vnc10;
    if ($taux_degressif>$t11) {
       $annuite11=$vo11 * $taux_degressif/100;
       
   }else {
       $annuite11=$vo11 *$t11/100;
   }
   $annuite_cumule_11=$annuite_cumule_10+$annuite11;
   $vnc11=$vo11-$annuite11;
   
                           
   $vo12=$vnc11;
   if ($taux_degressif>$t12) {
      $annuite12=$vo12 * $taux_degressif/100;
      
  }else {
      $annuite12=$vo12 *$t12/100;
  }
  $annuite_cumule_12=$annuite_cumule_11+$annuite12;
  $vnc12=$vo12-$annuite12;
                             
  $vo13=$vnc12;
  if ($taux_degressif>$t13) {
     $annuite13=$vo13 * $taux_degressif/100;
     
 }else {
     $annuite13=$vo13 *$t13/100;
 }
 $annuite_cumule_13=$annuite_cumule_12+$annuite13;
 $vnc13=$vo13-$annuite13;
     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo11?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist11= $moist10-12;
                               echo $t11=12/$moist11 *100 .'%';
                          ?>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo12?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist12= $moist11-12;
                               echo $t12=12/$moist12 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo13?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist13= $moist12-12;
                               echo $t13=12/$moist13 *100 .'%';
                          ?>
                         </div>
                     </div><br>
                  
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>   
     
    <?php
    if ($resultat['dureeS']==13 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 
  $moist11= $moist10-12;
  $t11=12/$moist11 *100 ; 
  $moist12= $moist11-12;
  $t12=12/$moist12 *100 ; 
  
  $moist13= $moist12-12;
  $t13=12/$moist13 *100 ; 
  $moist14= $moist13-12;
  $t14=12/$moist14 *100 ; 

             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

                           
    $vo11=$vnc10;
    if ($taux_degressif>$t11) {
       $annuite11=$vo11 * $taux_degressif/100;
       
   }else {
       $annuite11=$vo11 *$t11/100;
   }
   $annuite_cumule_11=$annuite_cumule_10+$annuite11;
   $vnc11=$vo11-$annuite11;
   
                           
   $vo12=$vnc11;
   if ($taux_degressif>$t12) {
      $annuite12=$vo12 * $taux_degressif/100;
      
  }else {
      $annuite12=$vo12 *$t12/100;
  }
  $annuite_cumule_12=$annuite_cumule_11+$annuite12;
  $vnc12=$vo12-$annuite12;
                             
  $vo13=$vnc12;
  if ($taux_degressif>$t13) {
     $annuite13=$vo13 * $taux_degressif/100;
     
 }else {
     $annuite13=$vo13 *$t13/100;
 }
 $annuite_cumule_13=$annuite_cumule_12+$annuite13;
 $vnc13=$vo13-$annuite13;

                            
 $vo14=$vnc13;
 if ($taux_degressif>$t14) {
    $annuite14=$vo14 * $taux_degressif/100;
    
}else {
    $annuite14=$vo14 *$t14/100;
}
$annuite_cumule_14=$annuite_cumule_13+$annuite14;
$vnc14=$vo14-$annuite14;

     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo11?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist11= $moist10-12;
                               echo $t11=12/$moist11 *100 .'%';
                          ?>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo12?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist12= $moist11-12;
                               echo $t12=12/$moist12 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo13?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist13= $moist12-12;
                               echo $t13=12/$moist13 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo14?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist14= $moist13-12;
                               echo $t14= 12/$moist14 *100 .'%';
                          ?>
                         </div>
                     </div><br>
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>

    <?php
    if ($resultat['dureeS']==14 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 
  $moist11= $moist10-12;
  $t11=12/$moist11 *100 ; 
  $moist12= $moist11-12;
  $t12=12/$moist12 *100 ; 
  
  $moist13= $moist12-12;
  $t13=12/$moist13 *100 ; 
  $moist14= $moist13-12;
  $t14=12/$moist14 *100 ; 
  $moist15= $moist14-12;
  $t15=12/$moist15 *100 ; 

             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

                           
    $vo11=$vnc10;
    if ($taux_degressif>$t11) {
       $annuite11=$vo11 * $taux_degressif/100;
       
   }else {
       $annuite11=$vo11 *$t11/100;
   }
   $annuite_cumule_11=$annuite_cumule_10+$annuite11;
   $vnc11=$vo11-$annuite11;
   
                           
   $vo12=$vnc11;
   if ($taux_degressif>$t12) {
      $annuite12=$vo12 * $taux_degressif/100;
      
  }else {
      $annuite12=$vo12 *$t12/100;
  }
  $annuite_cumule_12=$annuite_cumule_11+$annuite12;
  $vnc12=$vo12-$annuite12;
                             
  $vo13=$vnc12;
  if ($taux_degressif>$t13) {
     $annuite13=$vo13 * $taux_degressif/100;
     
 }else {
     $annuite13=$vo13 *$t13/100;
 }
 $annuite_cumule_13=$annuite_cumule_12+$annuite13;
 $vnc13=$vo13-$annuite13;

                            
 $vo14=$vnc13;
 if ($taux_degressif>$t14) {
    $annuite14=$vo14 * $taux_degressif/100;
    
}else {
    $annuite14=$vo14 *$t14/100;
}
$annuite_cumule_14=$annuite_cumule_13+$annuite14;
$vnc14=$vo14-$annuite14;
                          
$vo15=$vnc14;
if ($taux_degressif>$t15) {
   $annuite15=$vo15 * $taux_degressif/100;
   
}else {
   $annuite15=$vo15 *$t15/100;
}
$annuite_cumule_15=$annuite_cumule_14+$annuite15;
$vnc15=$vo15-$annuite15;


     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo11?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist11= $moist10-12;
                               echo $t11=12/$moist11 *100 .'%';
                          ?>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo12?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist12= $moist11-12;
                               echo $t12=12/$moist12 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo13?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist13= $moist12-12;
                               echo $t13=12/$moist13 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo14?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist14= $moist13-12;
                               echo $t14= 12/$moist14 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo15?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist15= $moist14-12;
                               echo $t15=12/$moist15 *100 .'%';
                          ?>
                         </div>
                     </div><br>

                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>

   <?php
    if ($resultat['dureeS']==15 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 
  $moist11= $moist10-12;
  $t11=12/$moist11 *100 ; 
  $moist12= $moist11-12;
  $t12=12/$moist12 *100 ; 
  
  $moist13= $moist12-12;
  $t13=12/$moist13 *100 ; 
  $moist14= $moist13-12;
  $t14=12/$moist14 *100 ; 
  $moist15= $moist14-12;
  $t15=12/$moist15 *100 ; 
  $moist16= $moist15-12;
  $t16=12/$moist16 *100 ;  

             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

                           
    $vo11=$vnc10;
    if ($taux_degressif>$t11) {
       $annuite11=$vo11 * $taux_degressif/100;
       
   }else {
       $annuite11=$vo11 *$t11/100;
   }
   $annuite_cumule_11=$annuite_cumule_10+$annuite11;
   $vnc11=$vo11-$annuite11;
   
                           
   $vo12=$vnc11;
   if ($taux_degressif>$t12) {
      $annuite12=$vo12 * $taux_degressif/100;
      
  }else {
      $annuite12=$vo12 *$t12/100;
  }
  $annuite_cumule_12=$annuite_cumule_11+$annuite12;
  $vnc12=$vo12-$annuite12;
                             
  $vo13=$vnc12;
  if ($taux_degressif>$t13) {
     $annuite13=$vo13 * $taux_degressif/100;
     
 }else {
     $annuite13=$vo13 *$t13/100;
 }
 $annuite_cumule_13=$annuite_cumule_12+$annuite13;
 $vnc13=$vo13-$annuite13;

                            
 $vo14=$vnc13;
 if ($taux_degressif>$t14) {
    $annuite14=$vo14 * $taux_degressif/100;
    
}else {
    $annuite14=$vo14 *$t14/100;
}
$annuite_cumule_14=$annuite_cumule_13+$annuite14;
$vnc14=$vo14-$annuite14;
                          
$vo15=$vnc14;
if ($taux_degressif>$t15) {
   $annuite15=$vo15 * $taux_degressif/100;
   
}else {
   $annuite15=$vo15 *$t15/100;
}
$annuite_cumule_15=$annuite_cumule_14+$annuite15;
$vnc15=$vo15-$annuite15;
                          
$vo16=$vnc15;
if ($taux_degressif>$t16) {
   $annuite16=$vo16 * $taux_degressif/100;
   
}else {
   $annuite16=$vo16 *$t16/100;
}
$annuite_cumule_16=$annuite_cumule_15+$annuite16;
$vnc16=$vo16-$annuite16;

     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo11?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist11= $moist10-12;
                               echo $t11=12/$moist11 *100 .'%';
                          ?>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo12?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist12= $moist11-12;
                               echo $t12=12/$moist12 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo13?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist13= $moist12-12;
                               echo $t13=12/$moist13 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo14?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist14= $moist13-12;
                               echo $t14= 12/$moist14 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo15?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist15= $moist14-12;
                               echo $t15=12/$moist15 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo16?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist16= $moist15-12;
                               echo $t16=12/$moist16 *100 .'%';
                          ?>
                         </div>
                     </div><br>
                   
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>


   <?php
    if ($resultat['dureeS']==16 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 
  $moist11= $moist10-12;
  $t11=12/$moist11 *100 ; 
  $moist12= $moist11-12;
  $t12=12/$moist12 *100 ; 
  
  $moist13= $moist12-12;
  $t13=12/$moist13 *100 ; 
  $moist14= $moist13-12;
  $t14=12/$moist14 *100 ; 
  $moist15= $moist14-12;
  $t15=12/$moist15 *100 ; 
  $moist16= $moist15-12;
  $t16=12/$moist16 *100 ; 
  $moist17= $moist16-12;
  $t17=12/$moist17 *100 ; 

             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

                           
    $vo11=$vnc10;
    if ($taux_degressif>$t11) {
       $annuite11=$vo11 * $taux_degressif/100;
       
   }else {
       $annuite11=$vo11 *$t11/100;
   }
   $annuite_cumule_11=$annuite_cumule_10+$annuite11;
   $vnc11=$vo11-$annuite11;
   
                           
   $vo12=$vnc11;
   if ($taux_degressif>$t12) {
      $annuite12=$vo12 * $taux_degressif/100;
      
  }else {
      $annuite12=$vo12 *$t12/100;
  }
  $annuite_cumule_12=$annuite_cumule_11+$annuite12;
  $vnc12=$vo12-$annuite12;
                             
  $vo13=$vnc12;
  if ($taux_degressif>$t13) {
     $annuite13=$vo13 * $taux_degressif/100;
     
 }else {
     $annuite13=$vo13 *$t13/100;
 }
 $annuite_cumule_13=$annuite_cumule_12+$annuite13;
 $vnc13=$vo13-$annuite13;

                            
 $vo14=$vnc13;
 if ($taux_degressif>$t14) {
    $annuite14=$vo14 * $taux_degressif/100;
    
}else {
    $annuite14=$vo14 *$t14/100;
}
$annuite_cumule_14=$annuite_cumule_13+$annuite14;
$vnc14=$vo14-$annuite14;
                          
$vo15=$vnc14;
if ($taux_degressif>$t15) {
   $annuite15=$vo15 * $taux_degressif/100;
   
}else {
   $annuite15=$vo15 *$t15/100;
}
$annuite_cumule_15=$annuite_cumule_14+$annuite15;
$vnc15=$vo15-$annuite15;
                          
$vo16=$vnc15;
if ($taux_degressif>$t16) {
   $annuite16=$vo16 * $taux_degressif/100;
   
}else {
   $annuite16=$vo16 *$t16/100;
}
$annuite_cumule_16=$annuite_cumule_15+$annuite16;
$vnc16=$vo16-$annuite16;

                          
$vo17=$vnc16;
if ($taux_degressif>$t17) {
   $annuite17=$vo17 * $taux_degressif/100;
   
}else {
   $annuite17=$vo17 *$t17/100;
}
$annuite_cumule_17=$annuite_cumule_16+$annuite17;
$vnc17=$vo17-$annuite17;


     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo11?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist11= $moist10-12;
                               echo $t11=12/$moist11 *100 .'%';
                          ?>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo12?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist12= $moist11-12;
                               echo $t12=12/$moist12 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo13?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist13= $moist12-12;
                               echo $t13=12/$moist13 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo14?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist14= $moist13-12;
                               echo $t14= 12/$moist14 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo15?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist15= $moist14-12;
                               echo $t15=12/$moist15 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo16?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist16= $moist15-12;
                               echo $t16=12/$moist16 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             17ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo17?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc17?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist17= $moist16-12;
                               echo $t17=12/$moist17 *100 .'%';
                          ?>
                         </div>
                     </div><br>
                          
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>

   
<?php
    if ($resultat['dureeS']==17 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 
  $moist11= $moist10-12;
  $t11=12/$moist11 *100 ; 
  $moist12= $moist11-12;
  $t12=12/$moist12 *100 ; 
  
  $moist13= $moist12-12;
  $t13=12/$moist13 *100 ; 
  $moist14= $moist13-12;
  $t14=12/$moist14 *100 ; 
  $moist15= $moist14-12;
  $t15=12/$moist15 *100 ; 
  $moist16= $moist15-12;
  $t16=12/$moist16 *100 ; 
  $moist17= $moist16-12;
  $t17=12/$moist17 *100 ; 
  $moist18= $moist17-12;
  $t18=12/$moist18 *100 ; 
  $moist19= $moist18-12;

             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

                           
    $vo11=$vnc10;
    if ($taux_degressif>$t11) {
       $annuite11=$vo11 * $taux_degressif/100;
       
   }else {
       $annuite11=$vo11 *$t11/100;
   }
   $annuite_cumule_11=$annuite_cumule_10+$annuite11;
   $vnc11=$vo11-$annuite11;
   
                           
   $vo12=$vnc11;
   if ($taux_degressif>$t12) {
      $annuite12=$vo12 * $taux_degressif/100;
      
  }else {
      $annuite12=$vo12 *$t12/100;
  }
  $annuite_cumule_12=$annuite_cumule_11+$annuite12;
  $vnc12=$vo12-$annuite12;
                             
  $vo13=$vnc12;
  if ($taux_degressif>$t13) {
     $annuite13=$vo13 * $taux_degressif/100;
     
 }else {
     $annuite13=$vo13 *$t13/100;
 }
 $annuite_cumule_13=$annuite_cumule_12+$annuite13;
 $vnc13=$vo13-$annuite13;

                            
 $vo14=$vnc13;
 if ($taux_degressif>$t14) {
    $annuite14=$vo14 * $taux_degressif/100;
    
}else {
    $annuite14=$vo14 *$t14/100;
}
$annuite_cumule_14=$annuite_cumule_13+$annuite14;
$vnc14=$vo14-$annuite14;
                          
$vo15=$vnc14;
if ($taux_degressif>$t15) {
   $annuite15=$vo15 * $taux_degressif/100;
   
}else {
   $annuite15=$vo15 *$t15/100;
}
$annuite_cumule_15=$annuite_cumule_14+$annuite15;
$vnc15=$vo15-$annuite15;
                          
$vo16=$vnc15;
if ($taux_degressif>$t16) {
   $annuite16=$vo16 * $taux_degressif/100;
   
}else {
   $annuite16=$vo16 *$t16/100;
}
$annuite_cumule_16=$annuite_cumule_15+$annuite16;
$vnc16=$vo16-$annuite16;

                          
$vo17=$vnc16;
if ($taux_degressif>$t17) {
   $annuite17=$vo17 * $taux_degressif/100;
   
}else {
   $annuite17=$vo17 *$t17/100;
}
$annuite_cumule_17=$annuite_cumule_16+$annuite17;
$vnc17=$vo17-$annuite17;
                          
$vo18=$vnc17;
if ($taux_degressif>$t18) {
   $annuite18=$vo18 * $taux_degressif/100;
   
}else {
   $annuite18=$vo18 *$t18/100;
}
$annuite_cumule_18=$annuite_cumule_17+$annuite18;
$vnc18=$vo18-$annuite18;
 

     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo11?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist11= $moist10-12;
                               echo $t11=12/$moist11 *100 .'%';
                          ?>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo12?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist12= $moist11-12;
                               echo $t12=12/$moist12 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo13?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist13= $moist12-12;
                               echo $t13=12/$moist13 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo14?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist14= $moist13-12;
                               echo $t14= 12/$moist14 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo15?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist15= $moist14-12;
                               echo $t15=12/$moist15 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo16?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist16= $moist15-12;
                               echo $t16=12/$moist16 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             17ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo17?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc17?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist17= $moist16-12;
                               echo $t17=12/$moist17 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             18ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo18?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc18?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist18= $moist17-12;
                               echo $t18=12/$moist18 *100 .'%';
                          ?>
                         </div>
                     </div><br>
                          
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
    
<?php
    if ($resultat['dureeS']==18 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 
  $moist11= $moist10-12;
  $t11=12/$moist11 *100 ; 
  $moist12= $moist11-12;
  $t12=12/$moist12 *100 ; 
  
  $moist13= $moist12-12;
  $t13=12/$moist13 *100 ; 
  $moist14= $moist13-12;
  $t14=12/$moist14 *100 ; 
  $moist15= $moist14-12;
  $t15=12/$moist15 *100 ; 
  $moist16= $moist15-12;
  $t16=12/$moist16 *100 ; 
  $moist17= $moist16-12;
  $t17=12/$moist17 *100 ; 
  $moist18= $moist17-12;
  $t18=12/$moist18 *100 ; 
  $moist19= $moist18-12;
  $t19=12/$moist19 *100 ;


             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

                           
    $vo11=$vnc10;
    if ($taux_degressif>$t11) {
       $annuite11=$vo11 * $taux_degressif/100;
       
   }else {
       $annuite11=$vo11 *$t11/100;
   }
   $annuite_cumule_11=$annuite_cumule_10+$annuite11;
   $vnc11=$vo11-$annuite11;
   
                           
   $vo12=$vnc11;
   if ($taux_degressif>$t12) {
      $annuite12=$vo12 * $taux_degressif/100;
      
  }else {
      $annuite12=$vo12 *$t12/100;
  }
  $annuite_cumule_12=$annuite_cumule_11+$annuite12;
  $vnc12=$vo12-$annuite12;
                             
  $vo13=$vnc12;
  if ($taux_degressif>$t13) {
     $annuite13=$vo13 * $taux_degressif/100;
     
 }else {
     $annuite13=$vo13 *$t13/100;
 }
 $annuite_cumule_13=$annuite_cumule_12+$annuite13;
 $vnc13=$vo13-$annuite13;

                            
 $vo14=$vnc13;
 if ($taux_degressif>$t14) {
    $annuite14=$vo14 * $taux_degressif/100;
    
}else {
    $annuite14=$vo14 *$t14/100;
}
$annuite_cumule_14=$annuite_cumule_13+$annuite14;
$vnc14=$vo14-$annuite14;
                          
$vo15=$vnc14;
if ($taux_degressif>$t15) {
   $annuite15=$vo15 * $taux_degressif/100;
   
}else {
   $annuite15=$vo15 *$t15/100;
}
$annuite_cumule_15=$annuite_cumule_14+$annuite15;
$vnc15=$vo15-$annuite15;
                          
$vo16=$vnc15;
if ($taux_degressif>$t16) {
   $annuite16=$vo16 * $taux_degressif/100;
   
}else {
   $annuite16=$vo16 *$t16/100;
}
$annuite_cumule_16=$annuite_cumule_15+$annuite16;
$vnc16=$vo16-$annuite16;

                          
$vo17=$vnc16;
if ($taux_degressif>$t17) {
   $annuite17=$vo17 * $taux_degressif/100;
   
}else {
   $annuite17=$vo17 *$t17/100;
}
$annuite_cumule_17=$annuite_cumule_16+$annuite17;
$vnc17=$vo17-$annuite17;
                          
$vo18=$vnc17;
if ($taux_degressif>$t18) {
   $annuite18=$vo18 * $taux_degressif/100;
   
}else {
   $annuite18=$vo18 *$t18/100;
}
$annuite_cumule_18=$annuite_cumule_17+$annuite18;
$vnc18=$vo18-$annuite18;
                          
$vo19=$vnc18;
if ($taux_degressif>$t19) {
   $annuite19=$vo19 * $taux_degressif/100;
   
}else {
   $annuite19=$vo19 *$t19/100;
}
$annuite_cumule_19=$annuite_cumule_18+$annuite19;
$vnc19=$vo19-$annuite19;


  
  
  
 
   
   
    
     
      
    

     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo11?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist11= $moist10-12;
                               echo $t11=12/$moist11 *100 .'%';
                          ?>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo12?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist12= $moist11-12;
                               echo $t12=12/$moist12 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo13?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist13= $moist12-12;
                               echo $t13=12/$moist13 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo14?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist14= $moist13-12;
                               echo $t14= 12/$moist14 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo15?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist15= $moist14-12;
                               echo $t15=12/$moist15 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo16?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist16= $moist15-12;
                               echo $t16=12/$moist16 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             17ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo17?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc17?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist17= $moist16-12;
                               echo $t17=12/$moist17 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             18ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo18?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc18?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist18= $moist17-12;
                               echo $t18=12/$moist18 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                                
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             19ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo19?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc19?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist19= $moist18-12;
                               echo $t19=12/$moist19 *100 .'%';
                          ?>
                         </div>
                     </div><br>
                                                            
                    
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
    
<?php
    if ($resultat['dureeS']==19 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 
  $moist11= $moist10-12;
  $t11=12/$moist11 *100 ; 
  $moist12= $moist11-12;
  $t12=12/$moist12 *100 ; 
  
  $moist13= $moist12-12;
  $t13=12/$moist13 *100 ; 
  $moist14= $moist13-12;
  $t14=12/$moist14 *100 ; 
  $moist15= $moist14-12;
  $t15=12/$moist15 *100 ; 
  $moist16= $moist15-12;
  $t16=12/$moist16 *100 ; 
  $moist17= $moist16-12;
  $t17=12/$moist17 *100 ; 
  $moist18= $moist17-12;
  $t18=12/$moist18 *100 ; 
  $moist19= $moist18-12;
  $t19=12/$moist19 *100 ;
  
  $moist20= $moist19-12;
  $t20=12/$moist20 *100 ; 
  $moist21= $moist20-12;

 

    

             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

                           
    $vo11=$vnc10;
    if ($taux_degressif>$t11) {
       $annuite11=$vo11 * $taux_degressif/100;
       
   }else {
       $annuite11=$vo11 *$t11/100;
   }
   $annuite_cumule_11=$annuite_cumule_10+$annuite11;
   $vnc11=$vo11-$annuite11;
   
                           
   $vo12=$vnc11;
   if ($taux_degressif>$t12) {
      $annuite12=$vo12 * $taux_degressif/100;
      
  }else {
      $annuite12=$vo12 *$t12/100;
  }
  $annuite_cumule_12=$annuite_cumule_11+$annuite12;
  $vnc12=$vo12-$annuite12;
                             
  $vo13=$vnc12;
  if ($taux_degressif>$t13) {
     $annuite13=$vo13 * $taux_degressif/100;
     
 }else {
     $annuite13=$vo13 *$t13/100;
 }
 $annuite_cumule_13=$annuite_cumule_12+$annuite13;
 $vnc13=$vo13-$annuite13;

                            
 $vo14=$vnc13;
 if ($taux_degressif>$t14) {
    $annuite14=$vo14 * $taux_degressif/100;
    
}else {
    $annuite14=$vo14 *$t14/100;
}
$annuite_cumule_14=$annuite_cumule_13+$annuite14;
$vnc14=$vo14-$annuite14;
                          
$vo15=$vnc14;
if ($taux_degressif>$t15) {
   $annuite15=$vo15 * $taux_degressif/100;
   
}else {
   $annuite15=$vo15 *$t15/100;
}
$annuite_cumule_15=$annuite_cumule_14+$annuite15;
$vnc15=$vo15-$annuite15;
                          
$vo16=$vnc15;
if ($taux_degressif>$t16) {
   $annuite16=$vo16 * $taux_degressif/100;
   
}else {
   $annuite16=$vo16 *$t16/100;
}
$annuite_cumule_16=$annuite_cumule_15+$annuite16;
$vnc16=$vo16-$annuite16;

                          
$vo17=$vnc16;
if ($taux_degressif>$t17) {
   $annuite17=$vo17 * $taux_degressif/100;
   
}else {
   $annuite17=$vo17 *$t17/100;
}
$annuite_cumule_17=$annuite_cumule_16+$annuite17;
$vnc17=$vo17-$annuite17;
                          
$vo18=$vnc17;
if ($taux_degressif>$t18) {
   $annuite18=$vo18 * $taux_degressif/100;
   
}else {
   $annuite18=$vo18 *$t18/100;
}
$annuite_cumule_18=$annuite_cumule_17+$annuite18;
$vnc18=$vo18-$annuite18;
                          
$vo19=$vnc18;
if ($taux_degressif>$t19) {
   $annuite19=$vo19 * $taux_degressif/100;
   
}else {
   $annuite19=$vo19 *$t19/100;
}
$annuite_cumule_19=$annuite_cumule_18+$annuite19;
$vnc19=$vo19-$annuite19;
                          
$vo20=$vnc19;
if ($taux_degressif>$t20) {
   $annuite20=$vo20 * $taux_degressif/100;
   
}else {
   $annuite20=$vo20 *$t20/100;
}
$annuite_cumule_20=$annuite_cumule_19+$annuite20;
$vnc20=$vo20-$annuite20;

  
  
  
 
   
   
    
     
      
    

     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=  $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo11?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist11= $moist10-12;
                               echo $t11=12/$moist11 *100 .'%';
                          ?>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo12?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist12= $moist11-12;
                               echo $t12=12/$moist12 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo13?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist13= $moist12-12;
                               echo $t13=12/$moist13 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo14?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist14= $moist13-12;
                               echo $t14= 12/$moist14 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo15?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist15= $moist14-12;
                               echo $t15=12/$moist15 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo16?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist16= $moist15-12;
                               echo $t16=12/$moist16 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             17ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo17?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc17?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist17= $moist16-12;
                               echo $t17=12/$moist17 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             18ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo18?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc18?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist18= $moist17-12;
                               echo $t18=12/$moist18 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                                
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             19ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo19?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc19?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist19= $moist18-12;
                               echo $t19=12/$moist19 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                            
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             20ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo20?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite20?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_20?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc20?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist20= $moist19-12;
                               echo $t20=12/$moist20 *100 .'%';
                          ?>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
    
<?php
    if ($resultat['dureeS']==20 AND$resultat['systemeS']=='Dégréssif') {
            if ($resultat['moisS']>0) 
            {
                $a1=12-$resultat['moisS'];
                $a2=12-$a1;
            }


            if ($resultat['dureeS']== 5 OR$resultat['dureeS']== 6)
                           {
                           $taux_degressif= $taux_amortissement *2 ;

                          }elseif ($resultat['dureeS']== 3 OR$resultat['dureeS'] ==4 )
                          {
                          $taux_degressif= $taux_amortissement * 1.5 ;
                          }
                          else {
                             $taux_degressif= $taux_amortissement*3 ;
                          }

        
           
  $totalmois=$resultat['dureeS']*12;
  $taux_linaire =$resultat['moisS']/$totalmois *100;          
  $moist2=$totalmois-$resultat['moisS'];
  $t2= 12/$moist2 *100 ;

  $moist3=$totalmois-12;
  $t3= 12/$moist3 *100 ;

  $moist4= $moist3-12;
  $t4=12/$moist4 *100 ;  
  
  $moist5= $moist4-12;
  $t5=12/$moist5 *100 ; 
  $moist6= $moist5-12;
  $t6=12/$moist6 *100 ; 
  $moist7= $moist6-12;
  $t7=12/$moist7 *100 ; 
  $moist8= $moist7-12;
  $t8=12/$moist8 *100 ; 
  $moist9= $moist8-12;
  $t9=12/$moist9 *100 ; 
  $moist10= $moist9-12;
  $t10=12/$moist10 *100 ; 
  $moist11= $moist10-12;
  $t11=12/$moist11 *100 ; 
  $moist12= $moist11-12;
  $t12=12/$moist12 *100 ; 
  
  $moist13= $moist12-12;
  $t13=12/$moist13 *100 ; 
  $moist14= $moist13-12;
  $t14=12/$moist14 *100 ; 
  $moist15= $moist14-12;
  $t15=12/$moist15 *100 ; 
  $moist16= $moist15-12;
  $t16=12/$moist16 *100 ; 
  $moist17= $moist16-12;
  $t17=12/$moist17 *100 ; 
  $moist18= $moist17-12;
  $t18=12/$moist18 *100 ; 
  $moist19= $moist18-12;
  $t19=12/$moist19 *100 ;
  
  $moist20= $moist19-12;
  $t20=12/$moist20 *100 ; 
  $moist21= $moist20-12;
  $t21=12/$moist21 *100 ; 
 

    

             if ($taux_degressif>$taux_linaire ) {
                 $annuite1= $cout_acquisition* $taux_degressif*$a1/1200;
                 
             }else {
                $annuite=$cout_acquisition*$taux_linaire *$a1/1200;
             }
             $annuite_cumule_1=$annuite1;
             $vnc1=$cout_acquisition-$annuite_cumule_1;

             $vo2=$vnc1;
             if ($taux_degressif>$t2) {
                $annuite2=$vo2 * $taux_degressif/100;
                
            }else {
                $annuite2=$vo2 *$t2/100;
            }
            $annuite_cumule_2=$annuite1+$annuite2;
            $vnc2=$vo2-$annuite2;
            
            $vo3=$vnc2;
            if ($taux_degressif>$t3) {
               $annuite3=$vo3 * $taux_degressif/100;
               
           }else {
               $annuite3=$vo3 *$t3/100;
           }
           $annuite_cumule_3=$annuite_cumule_2+$annuite3;
           $vnc3=$vo3-$annuite3;

                       
           $vo4=$vnc3;
           if ($taux_degressif>$t4) {
              $annuite4=$vo4 * $taux_degressif/100;
              
          }else {
              $annuite4=$vo4 *$t4/100;
          }
          $annuite_cumule_4=$annuite_cumule_3+$annuite4;
          $vnc4=$vo4-$annuite4;

                        
          $vo5=$vnc4;
          if ($taux_degressif>$t5) {
             $annuite5=$vo5 * $taux_degressif/100;
             
         }else {
             $annuite5=$vo5 *$t5/100;
         }
         $annuite_cumule_5=$annuite_cumule_4+$annuite5;
         $vnc5=$vo5-$annuite5;
                       
         $vo6=$vnc5;
         if ($taux_degressif>$t6) {
            $annuite6=$vo6 * $taux_degressif/100;
            
        }else {
            $annuite6=$vo6 *$t6/100;
        }
        $annuite_cumule_6=$annuite_cumule_5+$annuite6;
        $vnc6=$vo6-$annuite6;

                        
        $vo7=$vnc6;
        if ($taux_degressif>$t7) {
           $annuite7=$vo7 * $taux_degressif/100;
           
       }else {
           $annuite7=$vo7 *$t7/100;
       }
       $annuite_cumule_7=$annuite_cumule_6+$annuite7;
       $vnc7=$vo7-$annuite7;

                         
       $vo8=$vnc7;
       if ($taux_degressif>$t8) {
          $annuite8=$vo8 * $taux_degressif/100;
          
      }else {
          $annuite8=$vo8 *$t8/100;
      }
      $annuite_cumule_8=$annuite_cumule_7+$annuite8;
      $vnc8=$vo8-$annuite8;

                         
      $vo9=$vnc8;
      if ($taux_degressif>$t9) {
         $annuite9=$vo9 * $taux_degressif/100;
         
     }else {
         $annuite9=$vo9 *$t9/100;
     }
     $annuite_cumule_9=$annuite_cumule_8+$annuite9;
     $vnc9=$vo9-$annuite9;
                         
     $vo10=$vnc9;
     if ($taux_degressif>$t10) {
        $annuite10=$vo10 * $taux_degressif/100;
        
    }else {
        $annuite10=$vo10 *$t10/100;
    }
    $annuite_cumule_10=$annuite_cumule_9+$annuite10;
    $vnc10=$vo10-$annuite10;

                           
    $vo11=$vnc10;
    if ($taux_degressif>$t11) {
       $annuite11=$vo11 * $taux_degressif/100;
       
   }else {
       $annuite11=$vo11 *$t11/100;
   }
   $annuite_cumule_11=$annuite_cumule_10+$annuite11;
   $vnc11=$vo11-$annuite11;
   
                           
   $vo12=$vnc11;
   if ($taux_degressif>$t12) {
      $annuite12=$vo12 * $taux_degressif/100;
      
  }else {
      $annuite12=$vo12 *$t12/100;
  }
  $annuite_cumule_12=$annuite_cumule_11+$annuite12;
  $vnc12=$vo12-$annuite12;
                             
  $vo13=$vnc12;
  if ($taux_degressif>$t13) {
     $annuite13=$vo13 * $taux_degressif/100;
     
 }else {
     $annuite13=$vo13 *$t13/100;
 }
 $annuite_cumule_13=$annuite_cumule_12+$annuite13;
 $vnc13=$vo13-$annuite13;

                            
 $vo14=$vnc13;
 if ($taux_degressif>$t14) {
    $annuite14=$vo14 * $taux_degressif/100;
    
}else {
    $annuite14=$vo14 *$t14/100;
}
$annuite_cumule_14=$annuite_cumule_13+$annuite14;
$vnc14=$vo14-$annuite14;
                          
$vo15=$vnc14;
if ($taux_degressif>$t15) {
   $annuite15=$vo15 * $taux_degressif/100;
   
}else {
   $annuite15=$vo15 *$t15/100;
}
$annuite_cumule_15=$annuite_cumule_14+$annuite15;
$vnc15=$vo15-$annuite15;
                          
$vo16=$vnc15;
if ($taux_degressif>$t16) {
   $annuite16=$vo16 * $taux_degressif/100;
   
}else {
   $annuite16=$vo16 *$t16/100;
}
$annuite_cumule_16=$annuite_cumule_15+$annuite16;
$vnc16=$vo16-$annuite16;

                          
$vo17=$vnc16;
if ($taux_degressif>$t17) {
   $annuite17=$vo17 * $taux_degressif/100;
   
}else {
   $annuite17=$vo17 *$t17/100;
}
$annuite_cumule_17=$annuite_cumule_16+$annuite17;
$vnc17=$vo17-$annuite17;
                          
$vo18=$vnc17;
if ($taux_degressif>$t18) {
   $annuite18=$vo18 * $taux_degressif/100;
   
}else {
   $annuite18=$vo18 *$t18/100;
}
$annuite_cumule_18=$annuite_cumule_17+$annuite18;
$vnc18=$vo18-$annuite18;
                          
$vo19=$vnc18;
if ($taux_degressif>$t19) {
   $annuite19=$vo19 * $taux_degressif/100;
   
}else {
   $annuite19=$vo19 *$t19/100;
}
$annuite_cumule_19=$annuite_cumule_18+$annuite19;
$vnc19=$vo19-$annuite19;
                          
$vo20=$vnc19;
if ($taux_degressif>$t20) {
   $annuite20=$vo20 * $taux_degressif/100;
   
}else {
   $annuite20=$vo20 *$t20/100;
}
$annuite_cumule_20=$annuite_cumule_19+$annuite20;
$vnc20=$vo20-$annuite20;
                          
$vo21=$vnc20;
if ($taux_degressif>$t21) {
   $annuite21=$vo21 * $taux_degressif/100;
   
}else {
   $annuite21=$vo21 *$t21/100;
}
$annuite_cumule_21=$annuite_cumule_20+$annuite21;
$vnc21=$vo21-$annuite21;
  
  
  
 
   
   
    
     
      
    

     ?>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 

                     <br><div class="row   ">
                        
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Mis en Service</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Coût</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Système</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Durée</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Linéaire</h6>
                         </div>
                         <div class="col-2  mt-2 pt-1"style='border:solid gray 0.5px'>
                             <h6>Taux Dégresif</h6>
                         </div>
                     </div>
                     <div class="row  ">
                         
                     <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                     <?php
                      if ($resultat['moisS']==1) {?>
                       <?=$resultat['moisS'] ?> èr moisS
                        <?php
                      } else {
                        ?>
                        <?=$resultat['moisS'] ?>  ème moisS
                        <?php
                      }
                      ?>

                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                             <?=$cout_acquisition?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['systemeS'] ?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$resultat['dureeS'] ?> ans
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_amortissement?> %
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$taux_degressif
                          
                         ?>
                    
                             
                              </div>
                      
                     
                     </div><br>


                     <div class="row">
                     <div >
                             
                         </div>
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             <h6>Période</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Valeur d'origine</h6>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Annuité Cumule</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>   Valuer Net Comptable</h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6>Taux Lineaire</h6>
                         </div>
                     </div>
                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             1er Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$cout_acquisition?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         
                            <?=$annuite1?>
                         
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_1?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc1?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?= $taux_linaire 
                              
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             2ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo2?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_2?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc2?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                                $moist2=$totalmois-$resultat['moisS'];
                               echo $t2= 12/$moist2 *100 .'%';
                          ?>
                         </div>

                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             3ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo3?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_3?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc3?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?=$t3?>
                         </div>
                     </div>
                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             4ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo4?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_4?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc4?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist4= $moist3-12;
                               echo $t4=12/$moist4 *100 .'%';
                          ?>
                         </div>
                     </div>
                                   
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             5ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo5?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_5?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc5?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist5= $moist4-12;
                               echo $t5=12/$moist5 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             6ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo6?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_6?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc6?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist6= $moist5-12;
                               echo $t6=12/$moist6 *100 .'%';
                          ?>
                         </div>
                     </div>
                                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             7ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo7?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_7?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc7?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist7= $moist6-12;
                               echo $t7=12/$moist7 *100 .'%';
                          ?>
                         </div>
                     </div> 

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             8ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo8?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_8?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc8?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist8= $moist7-12;
                               echo $t8=12/$moist8 *100 .'%';
                          ?>
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             9ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo9?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_9?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc9?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist9= $moist8-12;
                               echo $t9=12/$moist9 *100 .'%';
                          ?>
                         </div>
                     </div>
                                         
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             10ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo10?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_10?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc10?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist10= $moist9-12;
                               echo $t10=12/$moist10 *100 .'%';
                          ?>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             11ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo11?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_11?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc11?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist11= $moist10-12;
                               echo $t11=12/$moist11 *100 .'%';
                          ?>
                         </div>
                     </div>
                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             12ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo12?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_12?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc12?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist12= $moist11-12;
                               echo $t12=12/$moist12 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                    
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             13ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo13?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_13?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc13?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist13= $moist12-12;
                               echo $t13=12/$moist13 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                          
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             14ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo14?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_14?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc14?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist14= $moist13-12;
                               echo $t14= 12/$moist14 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             15ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo15?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_15?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc15?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist15= $moist14-12;
                               echo $t15=12/$moist15 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                             
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             16ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo16?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_16?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc16?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist16= $moist15-12;
                               echo $t16=12/$moist16 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             17ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo17?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_17?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc17?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist17= $moist16-12;
                               echo $t17=12/$moist17 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                               
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             18ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo18?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_18?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc18?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist18= $moist17-12;
                               echo $t18=12/$moist18 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                                
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             19ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo19?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_19?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc19?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist19= $moist18-12;
                               echo $t19=12/$moist19 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                            
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             20ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo20?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite20?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_20?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc20?> </h6>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                          <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist20= $moist19-12;
                               echo $t20=12/$moist20 *100 .'%';
                          ?>
                         </div>
                     </div>
                                                      
                     <div class="row">
                         <div class="col-2  pt-1 "style='border:solid gray 0.5px'>
                             21ème Année
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$vo21?>
                         </div>
                         <div class="col-2  pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite21?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <?=$annuite_cumule_21?>
                         </div>
                         <div class="col-2   pt-1"style='border:solid gray 0.5px'>
                         <h6> <?=$vnc21?> </h6>
                         </div>
                         <?php
                               $totalmois=$resultat['dureeS']*12;
                               
                               $moist21= $moist20-12;
                               echo 12/$moist21 *100 .'%';
                          ?>
                         </div>
                     </div><br>
                 </div>
             </div>
         </div>
     </div>
     <?php
      }
    ?>
        
    <script src="../Administration/bootstrap/bootstrap.min.js"></script>
    <script src="../Administration/bootstrap/jquery-3.5.1.js"></script>
</body>
</html>