<!--Barre ou menu latérale (en fonction de la taille) présent(e) pour la séléction des catégories-->
<div class="barrenom">
    <a href="informatique.php" class="BarreMenuInfo"><img src="Utile/ImagesHeader/IconPC.png" alt="" class="ImageMenu"> Informatique</a>

    <a href="dev.php" class="BarreMenuDev"><img src="Utile/ImagesHeader/IconDev.png" alt="" class="ImageMenu"> Développement</a>

    <a href="elec.php" class="BarreMenuElec"><img src="Utile/ImagesHeader/IconElec.png" alt="" class="ImageMenu"> Électronique</a>

    <a href="graph.php" class="BarreMenuGraph"><img src="Utile/ImagesHeader/IconGraph.png" alt="" class="ImageMenu"> Graphisme</a>

    <a href="pdf.php" class="BarreMenuPDF"><img src="Utile/ImagesHeader/pdf.png" alt="" class="ImageMenu"> PDF</a>

    <a href="word.php" class="BarreMenuWord"><img src="Utile/ImagesHeader/word.png" alt="" class="ImageMenu"> Word</a>
    -----
    <a href="account.php" class="BarreMenuAcc"><img src="Images/projetPHP.png" alt="" class="ImageMenu"> Accueil</a>
</div>
<?php if($_SESSION['auth']->id == '19'){
    ?>
    <style>.barrenom{
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }</style>
    <?php
}
?>

<div class="barrenom2">
    <a href="informatique.php" class="BarreMenuInfo">Informatique</a>
    <br>
    <a href="dev.php" class="BarreMenuDev">Développement</a>
    <br>
    <a href="elec.php" class="BarreMenuElec">Électronique</a>
    <br>
    <a href="graph.php" class="BarreMenuGraph">Graphisme</a>
    <br>
    <a href="pdf.php" class="BarreMenuPDF">PDF</a>
    <br>
    <a href="word.php" class="BarreMenuWord">Word</a>
    <br>
    <br>
    <a href="account.php" class="BarreMenuAcc">Accueil</a>
</div>
