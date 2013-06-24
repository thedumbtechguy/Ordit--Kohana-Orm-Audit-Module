<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Ordit Log Viewer</title>
    <meta name="description" content="A Kohana module for exploring log files">
    <meta name="Author" content="WNeeds - http://wneeds.com" />

    <style media="all" type="text/css">
    <?php include_once MODPATH .'ordit/assets/bootstrap.min.css' ?>
    <?php include_once MODPATH .'ordit/assets/style.css' ?>
    </style>

    <script type="text/javascript"> BASEURL = "<?php echo URL::base() ?>";</script>
    <script type="text/javascript">
    <?php include_once MODPATH .'ordit/assets/jquery.js' ?>
    </script>

  </head>

  <body>

    <div class="topbar">
      <div class="fill">
        <div class="container">
          <div class="row">
              <div class="span12">
                <h1>Ordit Log Viewer</h1>
              </div>
              <div class="span4">
                <span class="pull-right utility">
                    <!-- <a href="#">Settings</a> -->
                </span>
              </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">

      <div class="content">
        <div class="page-header">
            <?php include(Kohana::find_file('views/ordit', 'monthlist')); ?>
        </div>
        <div class="row">
            <div class="span3">
                <?php include(Kohana::find_file('views/ordit', 'daylist')); ?>
            </div>
            <div class="span13">
                <?php if(isset($content)) echo $content; ?>
            </div>

        </div>
      </div>

      <footer>
        <p>&copy; Stefan Froelich <?php echo date('Y') ?>.</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
