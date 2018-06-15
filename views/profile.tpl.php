<!DOCTYPE html>
<html lang="ru" data-ng-app="profile">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $pageData['title']; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/css/admin/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/admin/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/css/admin/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Кабинет</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/cabinet/profile"><i class="fa fa-user fa-fw"></i> Профиль</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/cabinet/logout"><i class="fa fa-sign-out fa-fw"></i> Выйти</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="/cabinet"><i class="fa fa-area-chart"></i> Статистика</a>
                        </li>
                        <li>
                            <a href="/cabinet/products"><i class="fa fa-cart-plus"></i> Товары</a>
                        </li>
                        <li>
                            <a href="/cabinet/users"><i class="fa fa-user-o"></i> Пользователи</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper" data-ng-controller="profileController">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?php echo $pageData['title']; ?></h2>
                        <form class="form-horizontal" method="post" data-ng-submit="saveProfileData()">
                            <input type="hidden" name="userId" id="userId" value="<?php echo $pageData['userInfo']['id']; ?>">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="login">Логин</label>
                                    <div class="col-md-4">
                                        <input id="login" name="login" value="<?php echo $pageData['userInfo']['login']; ?>" class="form-control input-md" required="true" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="email">Email</label>
                                    <div class="col-md-4">
                                        <input id="email" name="email" value="<?php echo $pageData['userInfo']['email']; ?>" class="form-control input-md" required="true" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4">
                                        <button class="btn btn-success">Сохранить</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Сменить пароль</h2>
                        <form class="form-horizontal" method="post" data-ng-submit="updatePassword()">
                        <input type="hidden" name="userId" id="userId" value="<?php echo $pageData['userInfo']['id']; ?>">
                        <div class="form-group">
                                    <label class="col-md-4 control-label" for="newpass">Новый пароль</label>
                                    <div class="col-md-4">
                                        <input id="newpass" data-ng-model="newpass" name="newpass" class="form-control input-md" required="true" type="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="repeatpass">Повторите пароль</label>
                                    <div class="col-md-4">
                                        <input id="repeatpass" data-ng-model="repeatpass" name="repeatpass" class="form-control input-md" required="true" type="password">
                                    </div>
                                </div>

                                <!-- Button (Double) -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="save"></label>
                                    <div class="col-md-8">
                                        <button id="save" name="save" class="btn btn-success">Сохранить</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/js/jquery.js"></script>

    <!-- Angular -->
    <script src="/js/angular.min.js"></script>
    <script src="/js/admin/profile.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/js/admin/metisMenu.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/admin/sb-admin-2.js"></script>

</body>

</html>
