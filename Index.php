
<?php
//Indicamos las imágenes a utilizar y donde se vá a guardar
$src = "imegenes/log1.png";
$guardar_en="imegenes/imagen_resultante.png";
         
if(isset($_POST["w"])){
    $targ_w = $_POST['w'];
    $targ_h = $_POST['h'];
 
  //Recortamos la imagen con las cordenas que nos pasa el formulario
  require_once('PHPThumb/ThumbLib.inc.php');
  $thumb = PhpThumbFactory::create($src);
  $thumb->crop($_POST['x'],$_POST['y'],$_POST['w'],$_POST['h']);
  $thumb->save($src);
   
  //Redirigimos a la página de la que proviene el formulario
    header("Location:".$_SERVER["HTTP_REFERER"]);
}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
   
  <!--Incluimos jQuery y jCrop-->
  <script src="jquery.min.js"></script>
  <script src="jquery.Jcrop.js"></script>
  <link rel="stylesheet" href="jquery.Jcrop.css" type="text/css" />
    <!--Incluimos jQuery y jCrop-->
   
   
	<link href="http://edge1y.tapmodo.com/deepliq/global.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.min.css" type="text/css">
	<link href="http://edge1u.tapmodo.com/deepliq/jcrop_demos.css" rel="stylesheet" type="text/css">

	<script src="http://edge1u.tapmodo.com/global/js/jquery.min.js"></script>
  <script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
	<script src="http://edge1v.tapmodo.com/deepliq/jcrop_demos.js"></script>
<script src="/include/jquery.Jcrop.js"></script>
 <link rel="stylesheet" href="/include/jquery.Jcrop.css" type="text/css" />

</head>
  <title>Recortar imágenes con jCrop y PHPThumb</title>
 
  <script type="text/javascript">
  //Utilizamos jCrop en los elementos con el id cropbox
  $(function(){
 
    $('#cropbox').Jcrop({
      aspectRatio: 0,
      onSelect: updateCoords
    });
 
  });
 
  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };
 
  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Selecciona una región en la imágen');
    return false;
  };
 
  $(document).ready(function(){
      //Mostrar alto y ancho en px del area seleccionada
      $("#target").mousemove(function(){
          var ancho=$("#w").val();
          var alto=$("#h").val();
          $("#ancho_seleccionado").html(ancho);
          $("#alto_seleccionado").html(alto);
      });
  });
 
</script>
<style type="text/css">
  #cropbox{
     max-width:100%;
  }
  .imagen{
    float:left;
  }
  .clear{
    clear:both;
  }
</style>
</head>
<body>
 
<h3>Recortar imágen</h3>
      <div class="imagen" id="target">
            <p>Original</p>
          <img src="<?=$src?>" id="cropbox" />
    </div>
    <?php if(file_exists($src)){ ?>
    <div class="imagen">
          <p>Recortada</p>
          <img src="<?=$src?>" />
      </div>
      <br/>
      <?php } ?>
    <div class="clear"></div>
    <form action="" method="post" onsubmit="return checkCoords();">
      <input type="hidden" id="x" name="x" />
      <input type="hidden" id="y" name="y" />
      <input type="hidden" id="w" name="w" />
      <input type="hidden" id="h" name="h" />
      <input type="submit" value="Recortar" class="btn btn-large btn-inverse" />
          <span style="display:none" id="ancho_seleccionado">0</span> 
           <span style="display:none"  id="alto_seleccionado">0</span>  
    </form>
</body>
</html>