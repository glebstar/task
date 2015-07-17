<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->

    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <!-- Bootstrap Stylesheet -->
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" media="screen">
        <!-- Main Layout Stylesheet -->
        <link rel="stylesheet" href="/assets/css/fonts/icomoon/style.css" media="screen">
        
        <?php foreach ($this->_styles as $_s): ?>
        <link rel="stylesheet" href="<?php echo $_s; ?>?v=<?php echo $this->_pars['script_version'] ?>" media="screen">
        <?php endforeach; ?>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <title><?php echo $this->_pars['page_title'] ?></title>

    </head>

    <body>
        <?php
        require_once TASK_CODE_DIR . '/' . $this->_templateDir . '/' . $this->_template . '.php';
        ?> 

        <!-- Core Scripts -->
        <script src="/assets/js/libs/jquery-1.8.2.min.js"></script>
        <script src="/assets/js/libs/jquery.placeholder.min.js"></script>
        <?php foreach ($this->_scripts as $_s): ?>
        <script src="<?php echo $_s; ?>?v=<?php echo $this->_pars['script_version'] ?>"></script>
        <?php endforeach; ?>

    </body>

</html>


