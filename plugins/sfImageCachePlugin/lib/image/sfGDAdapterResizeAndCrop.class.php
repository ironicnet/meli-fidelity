<?php

   /**
   * Class to allow for cropping of images to fill entire space of maxWidth and maxHeight
   */
   class sfGDAdapterResizeAndCrop extends sfGDAdapter
   {
      public function loadData($thumbnail, $image, $mime)
      {
         if (in_array($mime,$this->imgTypes))
         {
            $this->source = imagecreatefromstring($image);
            $this->sourceWidth = imagesx($this->source);
            $this->sourceHeight = imagesy($this->source);
            $this->sourceMime = $mime;

            $this->calculateProportions();
            $this->doCreateImage();

            return true;
         }
         else
         {
            throw new Exception(sprintf('Image MIME type %s not supported', $mime));
         }
      }

      public function loadFile($thumbnail, $image)
      {
         $imgData = @GetImageSize($image);

         if (!$imgData)
         {
            throw new Exception(sprintf('Could not load image %s', $image));
         }

         if (in_array($imgData['mime'], $this->imgTypes))
         {
            $loader = $this->imgLoaders[$imgData['mime']];
            if(!function_exists($loader))
            {
               throw new Exception(sprintf('Function %s not available. Please enable the GD extension.', $loader));
            }

            $this->source = $loader($image);
            $this->sourceWidth = $imgData[0];
            $this->sourceHeight = $imgData[1];
            $this->sourceMime = $imgData['mime'];

            $this->calculateProportions();
            $this->doCreateImage($imgData);

            return true;
         }
         else
         {
            throw new Exception(sprintf('Image MIME type %s not supported', $imgData['mime']));
         }
      }

      public function calculateProportions()
      {
         // Si se especifica sólo el ancho o sólo el alto
         if(is_null($this->maxWidth) OR is_null($this->maxHeight))
         {
            if(is_null($this->maxWidth)) // Calculate ancho basado en el alto
            {
               // Broad format
               $this->thumbWidth = ($this->sourceWidth * $this->maxHeight) / $this->sourceHeight;
               $this->thumbHeight = $this->maxHeight;
            }
            elseif(is_null($this->maxHeight)) // Calculo alto basado en el ancho
            {
               // High format
               $this->thumbWidth = $this->maxWidth;
               $this->thumbHeight = ($this->sourceHeight * $this->maxWidth) / $this->sourceWidth;
            }
         }
         // Se especifica ancho y alto
         elseif($this->maxWidth && $this->maxHeight)
         {
            if ($this->sourceWidth / $this->maxWidth > $this->sourceHeight / $this->maxHeight)
            {
               // Broad format
               $this->thumbWidth = ($this->sourceWidth * $this->maxHeight) / $this->sourceHeight;
               $this->thumbHeight = $this->maxHeight;
            }
            else
            {
               // High format
               $this->thumbWidth = $this->maxWidth;
               $this->thumbHeight = ($this->sourceHeight * $this->maxWidth) / $this->sourceWidth;
            }
         }
         // No se especifica nada
         else
         {
            throw new Exception("Please specify either width or height");
         }
      }

      protected function doCreateImage($imgData)
      {
         $this->thumb = imagecreatetruecolor($this->thumbWidth, $this->thumbHeight);

         // Allocate for colors / transparency
         imagealphablending($this->thumb, false);
         $color = imagecolortransparent($this->thumb, imagecolorallocatealpha($this->thumb, 0, 0, 0, 127));
         imagefill($this->thumb, 0, 0, $color);
         imagesavealpha($this->thumb, true);


         if ($imgData[0] == $this->maxWidth && $imgData[1] == $this->maxHeight)
         {
            $this->thumb = $this->source;
         }
         else
         {
            imagecopyresampled($this->thumb, $this->source, 0, 0, 0, 0, $this->thumbWidth, $this->thumbHeight, $this->sourceWidth, $this->sourceHeight);
         }
      }
   }
