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
 if (isset($_GET['id'] ) ) 
 {
   $getid=$_GET['id'];
    {
        $req=$bdd->prepare('DELETE  FROM  autre_produits WHERE id=?');
         $req->execute(array($getid));

    }
    header('Location:index.php?page=autres_produits&id='.$getid);
 }
?>
