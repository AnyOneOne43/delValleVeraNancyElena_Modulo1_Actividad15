<?php
    $ruta_carpeta="./Statics";
    if(isset($_FILES["Imagen"])){
        $nombre=$_POST["Obra"];

        if(isset($_POST["Autor"])&& $_POST["Autor"] != ""){
            $autor=$_POST["Autor"];
        }
        else{
            $autor="Sin Autor";
        }

        if(isset($_POST["Año"]) && $_POST["Año"] != "" ){
            $año=$_POST["Año"];
        }
        else{
            $año="Sin Año";
        }
        
        $arch=$_FILES["Imagen"]['tmp_name'];
        $name=$_FILES["Imagen"]['name'];

        if(file_exists('Statics/'.$nombre .'$'.$autor .'$'.$año .'.' .pathinfo($name,PATHINFO_EXTENSION))){
            echo "<h1>El archivo que intenta subir ya existe.</h1>";
            echo "<form action='info.html' method='post'>";
            echo "<input type='Submit' name='Subir' value='Agregar Obra a la Galeria'>";
            echo "</form>";
        }else{
            if(((pathinfo($name,PATHINFO_EXTENSION)=="JPG")||pathinfo($name,PATHINFO_EXTENSION)=="PNG")||pathinfo($name,PATHINFO_EXTENSION)=="JPEG"){
                rename($arch, 'Statics/'.$nombre .'$'.$autor .'$'.$año .'.' .pathinfo($name,PATHINFO_EXTENSION));
                echo "<h1>Se subio correctamente tu imagen.</h1>";
                echo "<br>";
                echo "<form action='Galeria.php' method='post'>";
                echo "<input type='Submit' name='Subir' value='Ver Galeria'>";
                echo "</form>";
            }
            else if(((pathinfo($name,PATHINFO_EXTENSION)=="jpg")||pathinfo($name,PATHINFO_EXTENSION)=="png")||pathinfo($name,PATHINFO_EXTENSION)=="jpeg"){
                rename($arch, 'Statics/'.$nombre .'$'.$autor .'$'.$año .'.' .pathinfo($name,PATHINFO_EXTENSION));
                echo "<h1>Se subio correctamente tu imagen.</h1>";
                echo "<br>";
                echo "<form action='Galeria.php' method='post'>";
                echo "<input type='Submit' name='Subir' value='Ver Galeria'>";
                echo "</form>";
            }
            else{
                echo "<h1>El archivo que intenta subir no corresponde con el formato .JPG .PNG o .JPEG</h1>";
                echo "<form action='info.html' method='post'>";
                echo "<input type='Submit' name='Subir' value='Agregar Obra a la Galeria'>";
                echo "</form>";
            }
        }
        
    }    
    else{
        $ruta_carpeta="./Statics";
        $carpeta=opendir($ruta_carpeta);
        $archivos=array();
        $hayarchivos=true;
        $vacio= @scandir($ruta_carpeta);

        if (count($vacio) > 2)
        {
            while($hayarchivos){
                $archivo=readdir($carpeta);
                if($archivo!=false){
                    if($archivo !="." && $archivo !="..")
                    {
                        $ext=pathinfo($archivo,PATHINFO_EXTENSION);
                        array_push($archivos, $archivo);
                    }
                    
                }else if($archivo==false){
                    $hayarchivos=false;
                }
            }
    
            echo "<h1>Imagenes en la Galeria de Arte</h1>";
            foreach($archivos as $key => $value)
            {
                echo "<table border='1' style='margin: 0 auto'>";
                $modulo=($key % 2);
                    if($modulo==1){
                        echo "<tr>";
                    }
                        echo "<td>";
                            echo "<img src='./Statics/".$value."' width='250'>";
                            echo "<br>";
                            $cadena1=$archivos[$key];
                            $arrglo1=explode("$",$cadena1);
                            echo "<strong>Titulo de la Pintura:</strong>" .$arrglo1[0];
                            echo "<br>";
                            echo "<strong>Nombre del Pintor:</strong>" .$arrglo1[1];
                            echo "<br>";
                            $cadena2=$arrglo1[2];
                            $arrglo2=explode(".",$cadena2);
                            echo "<strong>Año en que se realizo:</strong>" .$arrglo2[0];
                        echo "</td>";
                    if($modulo==1){
                        echo "</tr>";
                    }
                echo "</table>";
            } 

        }else {
            echo '<h1>TU GALERIA DE ARTE NO TIENE NINGUNA IMAGEN</h1>';
        }
        closedir($carpeta);
        echo "<br>";
        echo "<form action='info.html' method='post'>";
            echo "<input type='Submit' name='Subir' value='Agregar Obra a la Galeria'>";
        echo "</form>";
    }
?>