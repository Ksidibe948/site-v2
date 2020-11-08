
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
        
       if (isset($_POST['marchandise'])
          AND isset($_POST['numero_client']) 
          AND isset($_POST['quantite'])
          AND isset($_POST['prix'])
          AND isset($_POST['reduction'])
          AND isset($_POST['taux_reduction'])
          AND isset($_POST['taux_exompte'])
          AND isset($_POST['montant_transport'])
          AND isset($_POST['taux_tva'])  
          AND isset($_POST['montant_emballage'])
          AND isset($_POST['montant_avance'])  
           
       ) {
        echo $numero_client=$_POST['numero_client'];
        echo  $marchandise=$_POST['marchandise'];
        echo  $quantite=$_POST['quantite'];
        echo  $prix=$_POST['prix'];
        echo  $reduction=$_POST['reduction'];
        echo  $taux_reduction=$_POST['taux_reduction'];
        echo  $taux_exompte=$_POST['taux_exompte'];
        echo $montant_transport=$_POST['montant_transport'];
        echo $taux_tva=$_POST['taux_tva'];
        echo $montant_emballage=$_POST['montant_emballage'];
        echo $montant_avance=$_POST['montant_avance'];
        
        $montant=$quantite*$prix;
        $reductions=$taux_reduction/100;
        $montant_reduction=$montant*$reductions;
        $net_commercial=$montant-$montant_reduction;
         $EXOMPTE=$taux_exompte/100;
         $montant_exompte=$net_commercial*$EXOMPTE;
         $net_financier=$net_commercial-$montant_exompte;
         $montant_ht=$net_financier+$montant_transport;
         $TVA=$taux_tva/100;
         $montant_tva=$montant_ht*$TVA;
         $montant_ttc=$montant_tva+$montant_ht;
         $net_à_payer=$montant_ttc+$montant_emballage-$montant_avance;
   
        $stokks_marchandises=$bdd->prepare('INSERT INTO stoks_marchandise
        (id_entrepriseS,id_fournisseurS,marchandiseS,quantiteS,prixS) VALUES(?,?,?,?,?)');
        $stokks_marchandises->execute(array($_SESSION['id'], $numero_client,$marchandise,$quantite,$prix));


        $insert=$bdd->prepare('INSERT INTO achats
      (
        id_fournisseur,
        id_entreprise,
        marchandise,
        quantite,
        prix,
        reduction,
        taux_reduction,
        taux_exompte,
        montant_transport,
        taux_tva,
        montant_emballage,
        montant_avance,
        net_a_payer
        ) 
      VALUES
      (
              ?,? ,?,? ,?,?,  ?, ?,?, ?,?,?,?
        )');
      $insert->execute(array
      (
        $numero_client,$_SESSION['id'], $marchandise,$quantite,$prix,
        $reduction,$taux_reduction,$taux_exompte,$montant_transport,$taux_tva,
        $montant_emballage,$montant_avance, $net_à_payer
        )
    );
    header('Location:index.php?page=achats&id='.$_SESSION['id']);
      

       }
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
  
   <div class="col-lg-12 col-12">     
  <div class="col-12">
                            <!-- la partie inscription -->
                            <div class="col-lg-12">
                            <div class="card  text-dark pb-5 mt-3 bg-white  w-100" style="width: 18rem; ">
                            <div class="card-body">

                               <div class="text-center bg-secondary text-light p-3  mb-5">
                                 
                              <h1>   Enregistre une nouvelle facture Achat marchandise</h1>
                               </div>
                            
                                <form action="" method="POST" enctype="multipart/form-data">
                              <div class="form-group row">
                              <label for="inputPassword" class="col-sm-1 col-form-label"><h6>Fournisseurs :</h6> </label>
                              <div class="col-sm-2">
                              <select id=""  name='numero_client' class="form-control">
                                <?php
                                    $bdd=new PDO('mysql:host=localhost; dbname=w&k;charset=utf8','root','');
                                    $numero_fournisseurs=$bdd->prepare('SELECT * FROM fournisseurs WHERE id_entreprise=? ') ;
                                    $numero_fournisseurs->execute(array($_SESSION['id']));
                                    while ($numero=$numero_fournisseurs->fetch()) {
                                      ?>
                                    <option value='<?= $numero['id'] ?>'><?= $numero['nom'] ?></option>
                                   
                                      <?php
                                    }
                                ?>
                              </select>
                              </div>
                           
                              <label for="inputPassword" class="col-sm-1 col-form-label"><h6>Marchandise</h6></label>
                              <div class="col-sm-2">
                              <input type="text"  name='marchandise'class="form-control" id="inputCity" required placeholder="EX: Tomate">
                              </div>
                              <label for="inputPassword" class="col-sm-1 col-form-label"><h6>Quantite</h6></label>
                              <div class="col-sm-2">
                              <input type="number"  name='quantite'class=" form-control" id="inputCity " required placeholder="EX: 10 pièces">
                              </div>
                              <label for="inputPassword" class="col-sm-1 col-form-label"><h6>Prix</h6></label>
                              <div class="col-sm-2">
                              <input type="number"  name='prix'class="form-control" id="inputCity" required placeholder="Mettez le prix">
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-1 col-form-label"><h6>Réductions: </h6> </label>
                              <div class="col-sm-2">
                              <select id="inputState" name="reduction" class="form-control ">
                                    <option>Réductions</option>
                                    <option>Rémise</option>
                                    <option>Rabais</option>
                                    <option>Ristourne</option>
                                    
                                </select>
                              </div>
                              <label for="inputPassword" class="col-sm-1 col-form-label"><h6>Taux: </h6> </label>
                              <div class="col-sm-2">
                              <select id="inputState"  name="taux_reduction" class="form-control ">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>3</option>
                                    <option>3</option>
                                    <option>3</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                </select>
                              </div>
                   
                              
                     
                              <label for="inputPassword" class="col-sm-1 col-form-label"><h6>Exompte: </h6> </label>
                              <div class="col-sm-2">
                              <select id="inputState" name="taux_exompte" class="form-control">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>3</option>
                                    <option>3</option>
                                    <option>3</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                </select>
                              </div>
                              <label for="inputPassword" class="col-sm-1 col-form-label"><h6>Transport:</h6>  </label>
                              <div class="col-sm-2">
                              <input type="number" value='0' name='montant_transport'class="form-control" id="inputCity "  placeholder="  Ex: 100 ">
                              </div>
                            </div>
                            
                            <div class="form-group row">
                              
                              <label for="inputPassword" class="col-sm-1 col-form-label"><h6>TVA:</h6>  </label>
                              <div class="col-sm-2">
                              <select id="inputState" name="taux_tva" class="form-control">
                                    <option>0</option>
                                    <option>10</option>
                                    <option>16</option>
                                    <option>20</option>
                                </select>
                              </div>
                   
                            
                              <label for="inputPassword" class="col-sm-1 col-form-label"><h6>Emballage  </h6></label>
                              <div class="col-sm-2">
                              <input type="number" value='0' name='montant_emballage'class="form-control" id="inputCity "  placeholder="  Ex: 100 ">
                              </div>
                              <label for="inputPassword" class="col-sm-1 col-form-label"><h6>Avance </h6> </label>
                              <div class="col-sm-2">
                              <input type="number" value='0'  name='montant_avance'class="form-control" id="inputCity "  placeholder="  Ex: 100 ">
                              </div>
                              <div class="col-lg-1 text-center">
                              <input type="submit" class='bg-success text-white' value="Valider">
                              </div>
                            </div> 
                                
                                </form>
                            </div>
                            </div>
                         </div>
         </div>
     </div>
    <script src="../Administration/bootstrap/bootstrap.min.js"></script>
    <script src="../Administration/bootstrap/jquery-3.5.1.js"></script>
</body>
</html>