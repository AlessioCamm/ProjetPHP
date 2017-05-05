<?php
    $url = $_SERVER['REQUEST_URI'];
    $parse = parse_url($url);
    if(!empty($parse['query'])){
        $pdo->exec('DELETE FROM fichiers WHERE id_fichier = "'.$parse['query'].'"');
        ?>
        <div class="uploadok">
            Fichier supprimé
        </div>
        <?php
    }
?>