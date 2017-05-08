<!--Script d'upload-->
<?php
    if(!empty($_FILES)){//Si le sélécteur de fichier n'est pas vide
        $errors = array();//Gestion des erreurs

        $date = date('Y/m/d H:i:s');//Récupération de la date actuelle
        $commentaire = $_POST['commentaire'];

        $file_name = $_FILES['file']['name'];//Nom du fichier
        $file_extension = strrchr($file_name, ".");//Récupération de l'extension du fichier
        //Liste des extensions autorisées
        $extensions_autorisees = array('.docx', '.DOCX','.docm', '.DOCM', '.dotx', '.DOTX', '.doc', '.DOC', '.ppt', '.PPT', '.pptx', '.PPTX','.pdf', '.PDF', '.txt', '.TXT', '.html', '.HTML', '.css', '.CSS', '.js', '.JS', '.afdesign', '.AFDESIGN', '.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG', '.gif', '.GIF', '.zip', '.ZIP', '.rar', '.RAR');
        $file_taille = $_FILES['file']['size'];//Récupération de la taille du fichier
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_dest = 'Uploads/'.$file_name;//Dossier de destination

        if(in_array($file_extension, $extensions_autorisees)){//Si l'extension fait partie des extensions autorisées
            if($file_taille < 25000000){//Si la taille fait moins de 25 Mo
                if(!preg_match('/[]#&§Çø_°|$*€%£+∞÷≠±•¿#‰/', $_POST['commentaire'])) {//Si le commentaire n'est pas composé de certains caractères
                    if (move_uploaded_file($file_tmp_name, $file_dest)) {//Alors il est déplacé dans le dossier et dans la base de données
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