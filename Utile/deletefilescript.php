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
        <script type="text/javascript">
            function notifRed(){
                $(".notifRed").stop(true,true).fadeIn();
            }
            setTimeout(notifRed, 200);

            function notifRedGo(){
                $(".notifRed").stop(true,true).fadeOut();
            }
            setTimeout(notifRedGo, 3000);
        </script>
        <?php
    }
?>