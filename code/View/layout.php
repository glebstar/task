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

        <!-- jquery-ui Stylesheets -->
        <link rel="stylesheet" href="/assets/jui/css/jquery.ui.all.css" media="screen">
        <link rel="stylesheet" href="/assets/jui/jquery-ui.custom.css" media="screen">
        <link rel="stylesheet" href="/assets/jui/timepicker/jquery-ui-timepicker.css" media="screen">

        <!-- Uniform Stylesheet -->
        <link rel="stylesheet" href="/plugins/uniform/css/uniform.default.css">

        <!-- Plugin Stylsheets first to ease overrides -->

        <!-- iButton -->
        <link rel="stylesheet" href="/plugins/ibutton/jquery.ibutton.css" media="screen">

        <!-- Circular Stat -->
        <link rel="stylesheet" href="/custom-plugins/circular-stat/circular-stat.css">

        <!-- Fullcalendar -->
        <link rel="stylesheet" href="/plugins/fullcalendar/fullcalendar.css" media="screen">
        <link rel="stylesheet" href="/plugins/fullcalendar/fullcalendar.print.css" media="print">

        <!-- End Plugin Stylesheets -->

        <!-- Main Layout Stylesheet -->
        <link rel="stylesheet" href="/assets/css/fonts/icomoon/style.css" media="screen">
        <link rel="stylesheet" href="/assets/css/main-style.css" media="screen">

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
        <div id="wrapper">
            <header id="header" class="navbar navbar-inverse">
                <div class="navbar-inner">
                    <div class="container">
                        <div class="brand-wrap pull-left">
                            <div class="brand-img">
                                <a class="brand" href="/">
                                    Менеджер задач
                                </a>
                            </div>
                        </div>

                        <div id="header-right" class="clearfix">
                            <div id="nav-toggle" data-toggle="collapse" data-target="#navigation" class="collapsed">
                                <i class="icon-caret-down"></i>
                            </div>

                            <div id="dropdown-lists">
                                <a class="item" href="/">
                                    <span class="item-icon"><i class="icol-lightbulb"></i></span>
                                    <span class="item-label">Мои задачи</span>
                                    <span class="item-count">4</span>
                                </a>
                                <a class="item" href="/messages">
                                    <span class="item-icon"><i class="icon-envelope"></i></span>
                                    <span class="item-label">Сообщения</span>
                                    <span class="item-count">0</span>
                                </a>
                            </div>

                            <div id="header-functions" class="pull-right">
                                <div id="user-info" class="clearfix">
                                    <span class="info">
                                        Добро пожаловать
                                        <span class="name">Вася Пупкин</span>
                                    </span>
                                </div>
                                <div id="logout-ribbon">
                                    <a href="/?logout=1"><i class="icon-off"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div id="content-wrap">
                <div id="content">
                    <div id="content-outer">
                        <div id="content-inner">
                            <aside id="sidebar">
                                <nav id="navigation" class="collapse">
                                    <ul>
                                        <?php foreach ($this->_nav as $_n): ?>
                                        <li<?php if ($_n['active']): ?> class="active"<?php endif; ?>>
                                            <span title="<?php echo $_n['title']; ?>">
                                                <i class="<?php echo $_n['icon']; ?>"></i>
                                                <span class="nav-title"><?php echo $_n['title']; ?></span>
                                            </span>
                                            <ul class="inner-nav">
                                                <?php foreach ($_n['items'] as $_i): ?>
                                                <li<?php if ($_i['active']): ?> class="active"<?php endif; ?>><a href="<?php echo $_i['href']; ?>"><i class="<?php echo $_i['icon']; ?>"></i> <?php if ($_i['active']): ?><b><?php endif; ?><?php echo $_i['title']; ?><?php if ($_i['active']): ?></b><?php endif; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </nav>
                            </aside>

                            <div id="sidebar-separator"></div>

                            <section id="main" class="clearfix">
                                <div id="main-header" class="page-header">
                                    <ul class="breadcrumb">
                                        <li>
                                            <i class="icon-home"></i>Главная
                                            <span class="divider">&raquo;</span>
                                        </li>
                                        <li>
                                            <a href="#">Мои задачи</a>
                                        </li>
                                    </ul>

                                    <h1 id="main-heading">
                                        <?php echo $this->_pageTitle['title']; ?> <span><?php echo $this->_pageTitle['sub']; ?></span>
                                    </h1>
                                </div>

                                <div id="main-content">
                                    <?php
                                    require_once TASK_CODE_DIR . '/' . $this->_templateDir . '/' . $this->_template . '.php';
                                    ?> 
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>

            <footer id="footer">
                <div class="footer-left">Task Manager</div>
                <div class="footer-right"><p>Copyright 2015. All Rights Reserved.</p></div>
            </footer>

        </div>

        <!-- Core Scripts -->
        <script src="/assets/js/libs/jquery-1.8.2.min.js"></script>
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets/js/libs/jquery.placeholder.min.js"></script>
        <script src="/assets/js/libs/jquery.mousewheel.min.js"></script>

        <!-- Template Script -->
        <script src="/assets/js/template.js"></script>
        <script src="/assets/js/setup.js"></script>

        <!-- Customizer, remove if not needed -->
        <script src="/assets/js/customizer.js"></script>

        <!-- Uniform Script -->
        <script src="/plugins/uniform/jquery.uniform.min.js"></script>

        <!-- jquery-ui Scripts -->
        <script src="/assets/jui/js/jquery-ui-1.8.24.min.js"></script>
        <script src="/assets/jui/jquery-ui.custom.min.js"></script>
        <script src="/assets/jui/timepicker/jquery-ui-timepicker.min.js"></script>
        <script src="/assets/jui/jquery.ui.touch-punch.min.js"></script>

        <!-- Plugin Scripts -->

        <!-- Flot -->
        <!--[if lt IE 9]>
        <script src="assets/js/libs/excanvas.min.js"></script>
        <![endif]-->
        <script src="/plugins/flot/jquery.flot.min.js"></script>
        <script src="/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
        <script src="/plugins/flot/plugins/jquery.flot.pie.min.js"></script>
        <script src="/plugins/flot/plugins/jquery.flot.resize.min.js"></script>

        <!-- Circular Stat -->
        <script src="/custom-plugins/circular-stat/circular-stat.min.js"></script>

        <!-- SparkLine -->
        <script src="/plugins/sparkline/jquery.sparkline.min.js"></script>

        <!-- iButton -->
        <script src="/plugins/ibutton/jquery.ibutton.min.js"></script>

        <!-- Full Calendar -->
        <script src="/plugins/fullcalendar/fullcalendar.min.js"></script>

        <!-- DataTables -->
        <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatables/TableTools/js/TableTools.min.js"></script>
        <script src="/plugins/datatables/dataTables.bootstrap.js"></script>

        <!-- Demo Scripts -->
        <script src="/assets/js/demo/dashboard.js"></script>

    </body>

</html>

