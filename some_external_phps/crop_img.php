<?php
  function CropMyImage($imgSrc,$thumbSize){
    //Your Image

    //getting the image dimensions
    list($width, $height) = getimagesize($imgSrc);

    //saving the image into memory (for manipulation with GD Library)
    $imageFileType = pathinfo($imgSrc,PATHINFO_EXTENSION);
    if ($imageFileType == "png"){
      $myImage = imagecreatefrompng($imgSrc);
    } else if (($imageFileType == "jpg")||($imageFileType == "jpeg")){
      $myImage = imagecreatefromjpeg($imgSrc);
    } else if ($imageFileType == "gif"){
      $myImage = imagecreatefromgif($imgSrc);
    }
    #echo $width.$height;
    // calculating the part of the image to use for thumbnail
    if ($width > $height) {
      $y = 0;
      $x = ($width - $height) / 2;
      $smallestSide = $height;
    } else {
      $x = 0;
      $y = ($height - $width) / 2;
      $smallestSide = $width;
    }

    // copying the part into thumbnail
    $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
    imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);


    #header('Content-Type: image/jpg');

    imagejpeg($thumb, $imgSrc.".jpg", 80);
    imagedestroy($thumb);
    imagedestroy($myImage);
    return $imgSrc.".jpg";
  }
?>
