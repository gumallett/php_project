<?php ob_start(); ?>
<!doctype html>
<html lang="en">
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta charset="UTF-8">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
      <!-- Optional bootstrap CSS theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
      <!-- Our stylesheet -->
      <link rel="stylesheet" type="text/css" href="css/<?php echo $this->css; ?>"/>

      <title><?php echo $this->title; ?></title>
   </head>

   <body>
      <div class="container">
       <?php include $this->content; ?>
      </div>

      <?php if($this->scriptFile != null) { ?>
          <script type="text/javascript" src="<?php echo $this->scriptFile; ?>"></script>
      <?php } ?>
      <script type="text/javascript"><?php echo $this->script; ?></script>
   </body>
</html>
<?php ob_end_flush(); ?>