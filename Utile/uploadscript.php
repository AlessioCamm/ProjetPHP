<!--Script d'upload-->
<?php
    if(!empty($_FILES)){
        $errors = array();

        $date = date('Y/m/d H:i:s');
        $commentaire = $_POST['commentaire'];

        $file_name = $_FILES['file']['name'];
        $file_extension = strrchr($file_name, ".");
        $extensions_autorisees = array('.docx', '.DOCX','.docm', '.DOCM', '.dotx', '.DOTX', '.doc', '.DOC', '.ppt', '.PPT', '.pptx', '.PPTX','.pdf', '.PDF', '.txt', '.TXT', '.html', '.HTML', '.css', '.CSS', '.js', '.JS', '.afdesign', '.AFDESIGN', '.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG', '.gif', '.GIF', '.zip', '.ZIP', '.rar', '.RAR');
        $file_taille = $_FILES['file']['size'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_dest = 'Uploads/'.$file_name;

        if(in_array($file_extension, $extensions_autorisees)){
            if($file_taille < 25000000){
                if(!preg_match('/[]#&§Çø_°|$*€%£+∞÷≠±•¿#‰/', $_POST['commentaire'])) {
                    if (move_uploaded_file($file_tmp_name, $file_dest)) {
                        $req = $pdo->prepare('INSERT INTO fichiers SET id_user = ?, prenom_user = ?, nom_user = ?, photo_user = ?, nomfichier = ?, extension = ?, taille = ?, dateT = ?, url = ?, commentaire = ?, categorie = ?');
                        $req->execute(array($_SESSION['auth']->id, $_SESSION['auth']->prenom, $_SESSION['auth']->nom, $_SESSION['auth']->photoprofil, $file_name, $file_extension, $file_taille, $date, $file_dest, $commentaire, $_POST['choixCat']));

                        ?>
                        <div class="uploadok">
                            Et voilà !<br>
                            Votre fichier a été téléchargé avec succès.
                        </div>
                        <?php
                    }
                    else{
                        $errors['3'] = 'Un problème innatendu est survenu';
                    }
                }
                else{
                    $errors['2'] = 'Veuillez n\'écrire que des caractères alphanumériques en commentaire';
                }
            }
            else{
                $errors['1'] = 'Votre fichier est trop volumineux';
            }
        }
        else{
            $errors['0'] = 'Fichier non séléctionné ou extension non autorisée';
        }
    }
?>