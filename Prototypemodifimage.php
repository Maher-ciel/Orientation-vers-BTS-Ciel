<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Télécharger une image</title>
    <style>
        
        body {
            text-align: center;
            background-color: #.........;
            color: #FFFFFF;
        }
        img {
            margin-top: 80px;
            width: 448px;
            height: 248px;
        }
        .container{
            position: relative;
            display : inline;

        }
        .image-front {
            position: relative; 
            z-index: 1; 
        }
        .image-absolute {
            position: absolute; 
            z-index: 2; 
            top: 130px; 
            left: 600px; 
            width: 180px; 
            height: auto; 
        }
    </style>
</head>
<body>
    <h1>Téléchargez une image</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <input type="submit" value="Image de fond">
    </form>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image2" accept="image/*" required>
        <input type="submit" value="Image superposée">
    </form>
    <div>
    <button onclick="telecharger2images()">Télécharger</button>
</div>
</body>
</html>
<?php
session_start();
$Image = "Images/";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_FILES['image']) ) {
        $Image_Fichier = $Image . basename($_FILES["image"]["name"]);
        $_SESSION['image1'] = $Image_Fichier; 
    }
    if (isset($_FILES['image2'])) {
        $Image_Fichier2 = $Image . basename($_FILES["image2"]["name"]);
        $_SESSION['image2'] = $Image_Fichier2; 
    }
}
if (isset($_SESSION['image1'])) {
    echo "<img class='image-front' src='{$_SESSION['image1']}' alt='Image de fond'>";
}
if (isset($_SESSION['image2'])){
    echo "<img class='image-absolute' src='{$_SESSION['image2']}' alt='Image superposée'>";
}
?>
<script>
    function deplacement(){
        document.addEventListener('keydown', function(event) {
            const box = document.querySelector('.image-absolute');
            const step = 10;
            const playground = box.parentNode;

            const currentTop = parseInt(box.style.top, 10) || 0;
            const currentLeft = parseInt(box.style.left, 10) || 0;

            const maxTop = playground.clientHeight - box.offsetHeight;
            const maxLeft = playground.clientWidth - box.offsetWidth;

            if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(event.key)) {
                event.preventDefault();
            }

            switch (event.key) {
                case 'ArrowUp':
                    if (currentTop - step >= 0) {
                        box.style.top = `${currentTop - step}px`;
                    }
                    break;
                case 'ArrowDown':
                    if (currentTop + step <= maxTop) {
                        box.style.top = `${currentTop + step}px`;
                    }
                    break;
                case 'ArrowLeft':
                    if (currentLeft - step >= 0) {
                        box.style.left = `${currentLeft - step}px`;
                    }
                    break;
                case 'ArrowRight':
                    if (currentLeft + step <= maxLeft) {
                        box.style.left = `${currentLeft + step}px`;
                    }
                    break;
            }
        });
    }
    deplacement();

    function telecharger2images() {
        const Image_Obj1 = document.querySelector('.image-front');
        const Image_Obj2 = document.querySelector('.image-absolute');
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = Image_principal.width;
        canvas.height = Image_principal.height;

        ctx.drawImage(Image_principal, 0, 0, canvas.width, canvas.height);

        const link = document.createElement('a');
        link.download = 'image-fusionnee.png'; 
        link.href = canvas.toDataURL('image/png'); 
        link.click(); 
    }
    </script>
