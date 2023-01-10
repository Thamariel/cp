<?php
class marca_dagua

{

// Construtor, verifica se a biblioteca GD tá no sistema



function marca_dagua()

{

    // Verifica se há biblioteca GD no PHP

    if(!function_exists("ImageCreateTrueColor")) // GD versão 2.*

    {

        if(!function_exists("ImageCreate")) // GD versão 1.*

        {

            echo "Você não possui a biblioteca GD carregada no PHP!";

            exit;

        }

    }

}

// Começamos a criar a marca com a função Gera

function gera($imagemfonte, $marcadagua, $imagemdestino, $pos = 0, $transicao = 100)

{

    // Obtém o cabeçalho de ambas as imagens

    $funcao = $this->verifica_tipo($marcadagua, "abrir");

    $marcadagua_id = $funcao($marcadagua);

    $funcao = $this->verifica_tipo($imagemfonte, "abrir");

    $imagemfonte_id = $funcao($imagemfonte);



    // Obtém os tamanhos de ambas as imagens

    $imagemfonte_data = getimagesize($imagemfonte);

    $marcadagua_data = getimagesize($marcadagua);

    $imagemfonte_largura = $imagemfonte_data[0];

    $imagemfonte_altura = $imagemfonte_data[1];

    $marcadagua_largura = $marcadagua_data[0];

    $marcadagua_altura = $marcadagua_data[1];



    // Aqui, defini-se a posição onde a marca deve aparecer na foto



    // Centralizado

    if( $pos == 0 )

    {

        $dest_x = ( $imagemfonte_largura / 2 ) - ( $marcadagua_largura / 2 );

        $dest_y = ( $imagemfonte_altura / 2 ) - ( $marcadagua_altura / 2 );

    }



    // Topo Esquerdo

    if( $pos == 1 )

    {

        $dest_x = 0;

        $dest_y = 0;

    }



    // Topo Direito

    if( $pos == 2 )

    {

        $dest_x = $imagemfonte_largura - $marcadagua_largura;

        $dest_y = 0;

    }



    // Rodapé Direito

    if( $pos == 3 )

    {

        $dest_x = ($imagemfonte_largura - $marcadagua_largura) - 5;

        $dest_y = ($imagemfonte_altura - $marcadagua_altura) - 5;

    }



    // Rodapé Esquerdo

    if( $pos == 4 )

    {

        $dest_x = 0;

        $dest_y = $imagemfonte_altura - $marcadagua_altura;

    }



    // Topo Centralizado

    if( $pos == 5 )

    {

        $dest_x = ( ( $imagemfonte_largura - $marcadagua_largura ) / 2 );

        $dest_y = 0;

    }



    // Centro Direito

    if( $pos == 6 )

    {

        $dest_x = $imagemfonte_largura - $marcadagua_largura;

        $dest_y = ( $imagemfonte_altura / 2 ) - ( $marcadagua_altura / 2 );

    }



    // Rodapé Centralizado

    if( $pos == 7 )

    {

        $dest_x = ( ( $imagemfonte_largura - $marcadagua_largura ) / 2 );

        $dest_y = $imagemfonte_altura - $marcadagua_altura;

    }



    // Centro Esquerdo

    if( $pos == 8 )

    {

        $dest_x = 0;

        $dest_y = ( $imagemfonte_altura / 2 ) - ( $marcadagua_altura / 2 );

    }

    // A função principal: misturar as duas imagens

    imageCopyMerge($imagemfonte_id, $marcadagua_id, $dest_x, $dest_y, 0, 0, $marcadagua_largura, $marcadagua_altura, $transicao);



    // Cria a imagem com a marca da agua

    $funcao = $this->verifica_tipo($imagemdestino, 'salvar');

    $funcao($imagemfonte_id, $imagemdestino, 100);

}



// Verifica o tipo da imagem e retorna a função para uso

function verifica_tipo($nome, $acao)

{

    if(eregi("^(.*).(jpeg|jpg)$", $nome))

    {

        if($acao == 'abrir')

        {

            return "imageCreateFromJPEG";

        }

        else

        {

            return "imagejpeg";

        }

    }

    elseif(eregi("^(.*).(png)$", $nome))

    {

        if($acao == "abrir")

        {

        return "imageCreateFromPNG";

        }

        else

        {

        return "imagepng";

        }

    }

    else

    {

        echo "Formato de Imagem Inválido!<br>A imagem deve ser PNG ou JPEG!";

        die;

    }

}

}

class SimpleImage {
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
 
}
?>