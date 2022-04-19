<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=Style.css>
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_POST['Delete'])) {

        array_map('unlink', glob("public/uploads/*.PNG")); // delete all files in some/dir
    }
  
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
       
        $uploadDir = 'public/uploads/';
        $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $maxFileSize = 1000000;
        $authorizedExtensions = ['jpg', 'PNG', 'gif', 'webp'];

        if ((!in_array($extension, $authorizedExtensions))) {
            $errors[] = 'Veuillez sélectionner une image de type Jpg,Png,Gif ou Webp !';
        }

        if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
            $errors[] = "Votre fichier doit faire moins de 1M !";
        }

    
        if(empty($errors)){

            $newFileName = uniqid('',true) . '.' . $extension;
            $uploadFile = $uploadDir . $newFileName;
            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
            echo 'Votre fichier a bien été envoyé !';
            echo '<h1>'. "SPRINGFIELD, IL".'</h1>';
            echo '<div class="angry-grid">'
            .'<div id="item-0">'.'<li>'."License #64209".'</li>'.'</div>'
            .'<div id="item-1">'.'<li>'."BIRTH DATE 4-24-56".'</li>'.'</div>'
            .'<div id="item-2">'.'<li>'."EXPRIRES 4-24-2015".'</li>'.'</div>'
            .'<div id="item-3">'.'<li>'."CLASS NONE".'</li>'.'</div>'
            .'<div id="item-4">'.'<img src="' . $uploadFile . '" alt="">'.'</div>'
            .'<div id="item-5">'.'<h3>'."Homer Simpson".'</h3>'.'<h3>'."69 old PLUMTREE BLVD".'</h3>'.'<h3>'."SPRINGFIELD, IL 62701".'</h3>'.'</div>'
            .'<div id="item-7">'.'<li>'."SEX OK".'</li>'.'</div>'
            .'<div id="item-8">'.'<li>'."HEIGHT MEDEIUM".'</li>'.'</div>'
            .'<div id="item-9">'.'<li>'."WEIGHT 239".'</li>'.'</div>'
            .'<div id="item-10">'.'<li>'."HAIR NONE".'</li>'.'</div>'
            .'<div id="item-11">SIGNATURE</div>'
            .'</div>';
        }

        else{
            echo '<ul>';
            foreach($errors as $error){
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
        }
    }
    ?>

    <form method="POST" enctype="multipart/form-data">
        <label for="imageUpload">Upload an profile image</label>
        <input type="file" name="avatar" id="imageUpload" />
        <button name="send">Send</button>
        <button name="Delete">Delete</button>
    </form>



    

</body>

</html>
