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
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $CessionImmoFinanciere=$bdd->prepare("SELECT
       CessionImmoFinanciere.id,
       CessionImmoFinanciere.id_client,
       CessionImmoFinanciere. id_entreprise,
       CessionImmoFinanciere.marchandise,
       CessionImmoFinanciere.quantite,
       CessionImmoFinanciere.prix,
       CessionImmoFinanciere.taux_tva,
       CessionImmoFinanciere. monyen_payement,
       CessionImmoFinanciere. montant_payement,
        clients.nom,
        clients.telephone,
        clients. adresse,
        clients.logo,
        DATE_FORMAT(CessionImmoFinanciere.date,'%d/%m/%Y à %Hh%imin%ss') AS date
   FROM  CessionImmoFinanciere,clients WHERE  CessionImmoFinanciere.id_client=clients.id AND  CessionImmoFinanciere. id=? ORDER BY id DESC");
   $CessionImmoFinanciere->execute(array($_GET['id']));
   $compte=  $CessionImmoFinanciere->rowcount();
   $donnees=$CessionImmoFinanciere->fetch();
 ?>

   <!-- la partie de connexion -->

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
   $select =$bdd->prepare('SELECT * FROM banque WHERE id_entreprise=? ORDER BY id DESC');
   $select->execute(array( $_SESSION['id']));?>
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
   $vente_marchandise=$bdd->prepare('SELECT * FROM ventes where id_entreprise=? ORDER BY id DESC');
   $vente_marchandise->execute(array($_SESSION['id']));
   $vente_marchandise= $vente_marchandise->rowcount();
   
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
     <a class="navbar-brand ml-4mr-5" href="#">
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
       <ul class="navbar-nav ml-4">
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
     <a  class="nav-link p-3  mb-1 shadow-sm bg-light bg-light bg-light " style="font-size:1.3rem;"  href="index.php?page=facturesventes&id=<?=$_SESSION['id'] ?>">              
   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
     <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
     <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
     <circle cx="3.5" cy="5.5" r=".5"/>
     <circle cx="3.5" cy="8" r=".5"/>
     <circle cx="3.5" cy="10.5" r=".5"/>
   </svg>
    Factures de Ventes
     </a>
 <a  class="nav-link p-3  mb-1 shadow-sm bg-light "  style="font-size:1.2rem;color:#A41FDE" href="index.php?page=CessionImmoFinanciere&id=<?=$_SESSION['id'] ?>"> 
  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
  <circle cx="3.5" cy="5.5" r=".5"/>
  <circle cx="3.5" cy="8" r=".5"/>
  <circle cx="3.5" cy="10.5" r=".5"/>
</svg>
  Cessions Immobilisations Financières
 </a>
 <a style="font-size:1.2rem; color:orange; font-family:arial" class="nav-link p-3  mb-1 shadow-sm bg-light " href="index.php?page=JournalFactureCessionImmoFinanciere&id=<?=$_GET['id'] ?>"><svg width="1em" height="1.5em" viewBox="0 0 16 16" class="bi bi-book" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M1 2.828v9.923c.918-.35 2.107-.692 3.287-.81 1.094-.111 2.278-.039 3.213.492V2.687c-.654-.689-1.782-.886-3.112-.752-1.234.124-2.503.523-3.388.893zm7.5-.141v9.746c.935-.53 2.12-.603 3.213-.493 1.18.12 2.37.461 3.287.811V2.828c-.885-.37-2.154-.769-3.388-.893-1.33-.134-2.458.063-3.112.752zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
</svg> Voir le Journal de la Facture de  <?=$donnees['marchandise'] ?></a>
  
 <a style=' font-size:1.1rem;;' class="nav-link text-success p-3  mb-1 shadow-sm bg-light " href="index.php?page=ModifierFacatureCessionImmoFinanciere&id=<?=$donnees['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
  </svg> Modifier la facute de <?=$donnees['marchandise'] ?></a>
  <a style='font-size:1.1rem;; ' class="nav-link p-3  mb-1 shadow-sm bg-light text-danger " href="index.php?page=SupprimerFactureCessionImmoFinanciere&id=<?=$donnees['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
 <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
 </svg> Supprimer la facute de <?=$donnees['marchandise'] ?></a>
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
<?php
        $montant=$donnees['quantite']*$donnees['prix'];
         $TVA=$donnees['taux_tva']/100;
         $montant_tva=$montant*$TVA;
         $montant_ttc=$montant_tva+$montant;
         $net_à_payer=$montant_ttc;
         $reste=$net_à_payer-$donnees['montant_payement'];
                  
       ?>
      
       <div class="container">
        <div class="row mb-2">
         <div class="col-12">
          <div class="card shadow-lg  w-100">
            <hr><div class="row mr-5">
            <div class="col-12 text-right">
                 <?= $donnees['date'] ?>
              </div>
              </div>
              <hr><div class="row ml-3">
              <div class="col-12 text-left ">
             <em>Fournisseur</em><br>
             <?="<img src='".$_SESSION['images']."' class='images' style='width:3rem ; height:3rem;  ' alt=''>" ;?>
            </div>
             <div class="col-12 text-left">
              <div style='font-size:1.5em'><?= $_SESSION['nom'] ?></div>
             </div>
             <div class="col-12 text-left ">
              <em>Adresse: </em> <?= $_SESSION['adresse'] ?>
             </div>
             <div class="col-12 text-left">
               <em>Tél: </em><?= $_SESSION['numero'] ?>
             </div>
            </div><hr>

              <hr><div class="row mr-3">
              <div class="col-12 text-right ">
              <em>Client</em><br>
             <?="<img src='".$donnees['logo']."' class='images' style='width:3rem ; height:3rem;  ' alt=''>" ;?>
             </div>
             <div class="col-12 text-right">
              <div style='font-size:1.5em'><?= $donnees['nom'] ?></div>
             </div>
             <div class="col-12 text-right ">
              <em>Adresse: </em> <?= $donnees['adresse'] ?>
             </div>
             <div class="col-12 text-right">
               <em>Tél: </em><?= $donnees['telephone'] ?>
             </div>
            </div><hr>

            <div class="row ml-2 mr-3">
              <div class="col-12 text-center">
                 <h5>Facture N°<?= $donnees['id'] ?></h5>
              </div><hr>
              
              <div class="col-3 text-center " style='border:solid black 0.5px'>
                 Produit
              </div>
              <div class="col-3 text-center " style='border:solid black 0.5px'>
                 Nombres
              </div>
              <div class="col-3 text-center " style='border:solid black 0.5px'>
                 Prix
              </div>
              <div class="col-3 text-center " style='border:solid black 0.5px'>
                 Montant
              </div>
            </div>
            <div class="row ml-2 mr-3 ">
              <div class="col-3 text-center " style='border:solid black 0.5px'>
              <?= $donnees['marchandise'] ?>
              </div>
              <div class="col-3 text-center " style='border:solid black 0.5px'>
              <?= $donnees['quantite'] ?>
              </div>
              <div class="col-3 text-right " style='border:solid black 0.5px'>
              <?= $donnees['prix'] ?> dh
              </div>
              <div class="col-3 text-right" style='border:solid black 0.5px'>
              <?= $montant ?> dh
              </div>
            </div><hr>
            <div class="row ml-2 mr-2 ">
              <div class="col-12">
                <div class="row">
                  <div class="col-6 text-center" style='border:solid black 0.5px'>
                    <h6>Elements</h6>
                  </div>
                  <div class="col-6 text-center"style='border:solid black 0.5px'>
                    <h6>Montants</h6>
                  </div>
                  <div class="col-6" style='border:solid black 0.5px'>
                  <h6><?= $donnees['marchandise'] ?></h6> 
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$montant ?> dh
                  </div>
                  <?php
                   if ($donnees['taux_tva']>0) {
                     ?>
                     <div class="col-6" style='border:solid black 0.5px'>
                   TVA (<?= $donnees['taux_tva'] ?> %)
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$montant_tva?> dh
                  </div>
                     <?php
                   }
                  ?>   
                  <div class="col-6" style='border:solid black 0.5px'>
                  <h6>Net à payer</h6> 
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$net_à_payer?> dh 
                  </div>
                  <?php
                   if ($donnees['montant_payement']>0) {
                     ?>
                     <div class="col-6" style='border:solid black 0.5px'>
                  <h6>Montant payer </h6> 
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$donnees['montant_payement'] ?> dh 
                  </div>
                     <?php
                   }
                  ?>                   
                  <?php
                   if ($reste>0) {
                     ?>
                  <div class="col-6" style='border:solid black 0.5px'>
                  <h6>Reste à Recevoir</h6> 
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$reste?> dh 
                  </div>
                 
                     <?php
                   }else {
                     ?>
                    <div class="col-6 text-left" style='border:solid black 0.5px'>
                    <h6>Montant à  Retourner </h6> 
                    </div>
                    <div class="col-6 text-right"style='border:solid black 0.5px'>
                    <?=$reste?> dh 
                    </div>
                    
                    <?php
                   }
                  ?>  
                                       
                  
                

                </div>
              </div>
             
            </div><hr><br>

          </div>
        
         </div>
        </div>
       </div>
      
       <?php


   ?>
  
 </div>
</div>
</div>
  
        <script src="https://kit.fontawesome.com/3d9f317c2d.js" crossorigin="anonymous"></script>
    <script src="../Administration/bootstrap/bootstrap.min.js"></script>
    <script src="../Administration/bootstrap/jquery-3.5.1.js"></script>
</body>
</html>