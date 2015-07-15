<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Images</title>

        <!-- CSS -->
        <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
    </head>

    <body>
        <div id="wrap">    
            <?php
            require_once TASK_CODE_DIR . '/' . $this->_templateDir . '/' . $this->_template . '.php';
            ?>   
        </div>

        <script type="text/javascript" src="/js/jquery.js"></script>
        <?php foreach ($this->_scripts as $_s): ?>
        <script type="text/javascript" src="<?php echo $_s; ?>?v=<?php echo $this->_pars['script_version'] ?>"></script>
        <?php endforeach; ?>
    </body>
</html>

