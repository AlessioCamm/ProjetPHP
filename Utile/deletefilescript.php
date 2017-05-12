<!--Script de suppression des fichiers-->
<?php
    $url = $_SERVER['REQUEST_URI'];
    $parse = parse_url($url);
    if(!empty($parse['query'])){
        $suppfile = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
        $ok = $suppfile->query('SELECT nomfichier FROM fichiers WHERE id_fichier = "'.$parse['query'].'"');
        while($okok = $ok->fetch()){
            unlink("Uploads/" . $okok['nomfichier']);
        }
        $pdo->exec('DELETE FROM fichiers WHERE id_fichier = "'.$parse['query'].'"');
        ?>
        <div class="uploadok">
            Fichier supprimé
        </div>
        <?php
    }
?>