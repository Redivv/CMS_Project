<?php
  function show($val = ''){
    echo '<pre>';
    print_r($val);
    die;
  }

  function upload_image(array $image=array()) : string{

      $uploaddir = '../img/uploads/';

      /* Generates random filename and extension */
      function tempnam_sfx($path, $suffix){
          do {
              $file = $path."/".mt_rand().$suffix;
              $fp = @fopen($file, 'x');
          }while(!$fp);

          fclose($fp);
          return $file;
      }

      /* Process image with GD library */
      $verifyimg = getimagesize($image['tmp_name']);

      /* Make sure the MIME type is an image */
      $pattern = "#^(image/)[^\s\n<]+$#i";

      if(!preg_match($pattern, $verifyimg['mime'])){
          die("Only image files are allowed!");
      }

      $type =explode('/',$image['type']);
      $type[1] = ".".$type[1];
      /* Rename both the image and the extension */
      $uploadfile = tempnam_sfx($uploaddir, $type[1]);

      /* Upload the file to a secure directory with the new name and extension */
      if (move_uploaded_file($image['tmp_name'], $uploadfile)) {
          return basename($uploadfile);
      }
    }

    function send_verification_mail(string $target, string $title, string $mail) : bool{

      $to      = $target;
      $subject = $title;
      $message = $mail;
      $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'Content-type: text/html; charset=utf-8' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        if(mail($to, $subject, $message, $headers)){
          return true;
        }else{
          return false;
        }

    }
 ?>
