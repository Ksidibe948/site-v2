
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
   $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
   $achamarchandises=$bdd->prepare("SELECT
        AchatsImmoCorporelle.id,
        AchatsImmoCorporelle.id_client,
        AchatsImmoCorporelle. id_entreprise,
        AchatsImmoCorporelle.marchandise,
        AchatsImmoCorporelle.quantite,
        AchatsImmoCorporelle.prix,
        AchatsImmoCorporelle.reduction,
        AchatsImmoCorporelle.taux_reduction,
        AchatsImmoCorporelle.taux_exompte,
        AchatsImmoCorporelle.montant_transport,
        AchatsImmoCorporelle.taux_tva,
        AchatsImmoCorporelle. montant_emballage,
        AchatsImmoCorporelle. montant_avance,
        AchatsImmoCorporelle.net_a_payer,
      fournisseurs.nom,
      fournisseurs.telephone,
      fournisseurs. adresse,
      fournisseurs.logo,
        DATE_FORMAT(  AchatsImmoCorporelle.date,'%d/%m/%Y à %Hh%imin%ss') AS date
   FROM AchatsImmoCorporelle,fournisseurs WHERE AchatsImmoCorporelle.id_client=fournisseurs.id AND AchatsImmoCorporelle. id=? ORDER BY id DESC");
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
   $stocks_marchandises=$bdd->prepare('SELECT * FROM AchatsImmoCorporelle where id_entreprise=? ORDER BY id DESC');
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
            <a class="nav-link" href="index.php?page=utilisateurs"> <h5>Publications</h5> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active ">
            <a class="nav-link  " href="index.php?page=comptabilite&id=<?=$_SESSION['id'] ?>"><h5>Comptabilité</h5></a>
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
     
   </nav>  <div class="row">
     <div class="col-lg-3 col-12 pl-5  ">
     <nav class="navbar sticky-top navbar-expand-lg navbar-light ">
     <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul  class="navbar-nav  mr-auto ">
         <li class="nav-item ">
         <?php if ($donnees['net_a_payer']>0) {
        ?>
         <a style="font-size:1.2rem; font-family:arial" class="nav-link  p-3  mt-2   text-info" href="index.php?page=payementAchatImmoCorporelle&id=<?=$_GET['id'] ?>">
         <svg width="1.5em"  height="1.5em" viewBox="0 0 16 16" class="bi bi-credit-card-2-back" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
     <path fill-rule="evenodd" d="M14 3H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
     <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1zM1 9h14v2H1V9z"/>
   </svg> Payer  </a> 
  
   <?php
       }else {
         ?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Cette facture a été payé</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
         <?php
       }
       ?>
         <a style="font-size:1.2rem; font-family:arial" class="nav-link  p-3   "href="index.php?page=JournalFactureAchatImmoCorporelle&id=<?=$_GET['id'] ?>"><svg width="1.5em"  height="1.5em" viewBox="0 0 16 16" class="bi bi-book" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M1 2.828v9.923c.918-.35 2.107-.692 3.287-.81 1.094-.111 2.278-.039 3.213.492V2.687c-.654-.689-1.782-.886-3.112-.752-1.234.124-2.503.523-3.388.893zm7.5-.141v9.746c.935-.53 2.12-.603 3.213-.493 1.18.12 2.37.461 3.287.811V2.828c-.885-.37-2.154-.769-3.388-.893-1.33-.134-2.458.063-3.112.752zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
      </svg>  Journal  </a>
<a style="font-size:1.2rem; font-family:arial" class="nav-link text-primary p-3   "href="index.php?page=amortissement_materiel&id=<?=$_GET['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-graph-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 11.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-1 0v2.6l-3.613-4.417a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61L13.445 11H10.5a.5.5 0 0 0-.5.5z"/>
</svg> Amortissement</a>
        <a style="font-size:1.2rem;" class="nav-link  p-3     text-success" href="index.php?page=modifierFAImmoCorporelle&id=<?=$_GET['id'] ?>"><svg width="1.5em"  height="1.5em" viewBox="0 0 16 16" class="bi bi-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
          </svg> Modifier </a>
          <a  style="font-size:1.2rem;" class="nav-link  p-3    text-danger"  href="index.php?page=supprimeFAImmocorporelle&id=<?=$_GET['id'] ?>"><svg width="1.5em"  height="1.5em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
         <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
         </svg> Supprimer  </a>  

         <a style="font-size:1.2rem;color:#A41FDE" class="nav-link  p-3   "    href="index.php?page=AchatsImmobilisationsCorporelles&id=<?=$_SESSION['id'] ?>">
         <svg width="1.5em"  height="1.5em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
          <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
          <circle cx="3.5" cy="5.5" r=".5"/>
          <circle cx="3.5" cy="8" r=".5"/>
          <circle cx="3.5" cy="10.5" r=".5"/>
        </svg> Factures
        </a> 
   </li>
   </ul>
   </div>
   </div>

   </nav>
   <div class="col-lg-6 col-12 ">    
  <div class="col-12">
     <?php
 
        $montant=$donnees['quantite']*$donnees['prix'];
        $reductions=$donnees['taux_reduction']/100;
        $montant_reduction=$montant*$reductions;
        $net_commercial=$montant-$montant_reduction;
         $EXOMPTE=$donnees['taux_exompte']/100;
         $montant_exompte=$net_commercial*$EXOMPTE;
         $net_financier=$net_commercial-$montant_exompte;
         $montant_ht=$net_financier+$donnees['montant_transport'];
         $TVA=$donnees['taux_tva']/100;
         $montant_tva=$montant_ht*$TVA;
         $montant_ttc=$montant_tva+$montant_ht;
         $net_à_payer=$montant_ttc+$donnees['montant_emballage']-$donnees['montant_avance'];
       ?>
       
        <div class="rowmb-1 ">
         <div class="col-lg-12">
           <div class="col-12">
           </div>
         <div class="card w-100 bg-white mt-2  bg-white" >
           <div class="row ml-1 mt-2 ">
             <div class="col-lg-12 text-left ">
             <?="<img src='".$donnees['logo']."' class='images' style='width:5rem ; height:5rem;  ' alt=''>" ;?><br>
            <?= $donnees['nom'] ?><br>
              <em>Adresse: </em> <?= $donnees['adresse'] ?><br>
               <em>Tél: </em><?= $donnees['telephone'] ?><br>
             </div>
            </div>
            <div class="row mr-1">
             <div class="col-lg-12 text-right ">
             <?="<img src='".$_SESSION['images']."' class='images' style='width:5rem ; height:5rem;  ' alt=''>" ;?><br>
            <?= $donnees['nom'] ?><br>
              <em>Adresse: </em> <?= $_SESSION['adresse'] ?><br>
               <em>Tél: </em><?= $_SESSION['numero'] ?><br>
               <em>Tél: </em><?= $_SESSION['email'] ?><br>
             </div>
            </div><hr>
            <div class="row ml-2 mr-2">
          <div class="col-lg-12 text-center ">
                 
               <h5> Facture N°<?= $donnees['id'] ?> </h5>
               <?= $donnees['date'] ?> 
               
              </div>
              </div><hr>
              <div class="row ml-2 mr-2">
              <div class="col-lg-12 text-center">
                 
              </div>
 
              <div class="col-3 text-center text-dark bg-light " style='border:solid black 0.5px'>
                 Produit
              </div>
              <div class="col-3 text-center text-dark bg-light " style='border:solid black 0.5px'>
                 Quantité
              </div>
              <div class="col-3 text-center " style='border:solid black 0.5px'>
                 Prix
              </div>
              <div class="col-3 text-center  text-dark bg-light" style='border:solid black 0.5px'>
                 Montant
              </div>
            </div>
            <div class="row ml-2 mr-2 ">
 
              <div class="col-3 text-center " style='border:solid black 0.5px'>
              <?= $donnees['marchandise'] ?>
              </div>
              <div class="col-3 text-right " style='border:solid black 0.5px'>
              <?= $donnees['quantite'] ?>
              </div>
              <div class="col-3 text-right " style='border:solid black 0.5px'>
              <?= $donnees['prix'] ?> dh
              </div>
              <div class="col-3 text-right " style='border:solid black 0.5px'>
              <?= $montant ?> dh
              </div>
            </div><br>
            
            <div class="row ml-2 mr-2 ">
              <div class="col-lg-12">
                <div class="row">
     
                  <div class="col-6 col-xl-6  text-dark bg-light text-center" style='border:solid black 0.5px'>
                    <h6>Elements</h6>
                  </div>
                  <div class="col-6 text-center text-dark bg-light"style='border:solid black 0.5px'>
                    <h6>Montants</h6>
                  </div>
                  </div>
                  <div class="row">
     
                   </div>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                  <h6><?= $donnees['marchandise'] ?></h6> 
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$montant ?> dh
                  </div>
                  <?php
                   if ($donnees['taux_reduction']>0) {
                     ?>
                   </div>
                  <div class="row">
                  
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                  <?= $donnees['reduction'] ?> (<?= $donnees['taux_reduction'] ?>%)
                  </div>
                  <div class="col-6  text-right" style='border:solid black 0.5px'>
                  <?=$montant_reduction ?> dh
                  </div>
                     <?php
                   }
                  ?>
                   </div>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                  Net commercial
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$net_commercial ?> dh
                  </div>

                  <?php
                   if ($donnees['taux_exompte']>0) {
                     ?>
                        </div>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                      Exompte (<?= $donnees['taux_exompte'] ?> %)
                      </div>
                      <div class="col-6 text-right"style='border:solid black 0.5px'>
                      <?=$montant_exompte ?> dh
                  </div>
                     <?php
                   }
                  ?>
                    <?php
                   if (isset($donnees['reduction'])) {
                     ?>
                     
                     <?php
                   }
                  ?>
                         
                
                     
                   </div>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                  Net Financier
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$net_financier ?> dh
                  </div>

                  <?php
                   if ($donnees['montant_transport']>0) {
                     ?>
                         </div>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                      Transport
                      </div>
                      <div class="col-6 text-right"style='border:solid black 0.5px'>
                      <?=$donnees['montant_transport'] ?> dh
                  </div>
                     <?php
                   }
                  ?>
                  
                           
                   </div>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                  <h6>Montant HT</h6> 
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$montant_ht?> dh
                  </div>
                  <?php
                   if ($donnees['taux_tva']>0) {
                     ?>
                      </div>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                   TVA (<?= $donnees['taux_tva'] ?> %)
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$montant_tva?> dh
                  </div>
                     <?php
                   }
                  ?>     
                  
                               
                   </div>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                  <h6> Montant TTC</h6>
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$montant_ttc?> dh
                  </div>
                  <?php
                   if ($donnees['montant_emballage']>0) {
                     ?>
                       </div>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                   Emballage
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$donnees['montant_emballage'] ?> dh
                  </div>
                     <?php
                   }
                  ?>          
                 
                  <?php
                   if ($donnees['montant_avance']>0) {
                     ?>
                      </div>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                   Avance
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$donnees['montant_avance'] ?> dh
                  </div>
                     <?php
                   }
                  ?>               
                               
                   </div>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                  <h6>Net à payer</h6> 
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$net_à_payer?> dh 
                  </div>
                </div>
                <?php if ($donnees['net_a_payer']>0){
                  ?>
                  <div class="row">
                  <div class="col-6 col-xl-6 " style='border:solid black 0.5px'>
                  <h6>Reste à payer</h6> 
                  </div>
                  <div class="col-6 text-right"style='border:solid black 0.5px'>
                  <?=$donnees['net_a_payer']?> dh 
                  </div>
                </div>
                  <?php
                }
                ?>
              </div>
            </div><hr><br>
            </div>
          
         </div>
         
        </div>
       </div>
       <?php


   ?>
    <script src="../Administration/bootstrap/bootstrap.min.js"></script>
    <script src="../Administration/bootstrap/jquery-3.5.1.js"></script>
</body>
</html>