<!--Script de suppression des fichiers-->
<?php
    $url = $_SERVER['REQUEST_URI'];//Récupère l'URL
    $parse = parse_url($url);//Découpe l'URL
    if(!empty($parse['query'])){//Si partie de l'URL vide, alors..
        $pdo->exec('DELETE FROM fichiers WHERE id_fichier = "'.$parse['query'].'"');
        ?>
        <div class="uploadok">
            Fichier supprimé
        </div>
        <?php
    }
?>