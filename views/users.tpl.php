<!DOCTYPE html>
<html lang="ru" data-ng-app="users">
<head>

    <meta charset="utf-8">
    <base href="/cabinet/users/">
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

    <style>
        table tr:hover {
            cursor: pointer;
        }
    </style>

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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Профиль</a>
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

        
        <div id="page-wrapper" data-ng-controller="usersController">
        <?php if($pageData['permission'] == 1) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $pageData['title']; ?></h1>
                </div>
            </div>

             <div class="row">
                <div class="col-lg-12">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>Пользователи
                        </div>


                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Имя</th>
                                                    <th>Логин</th>
                                                    <th>Email</th>
                                                    <th>Роль</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach ($pageData['usersList'] as $key => $value) { ?>
                                                        <tr data-ng-click="showEditForm(); getUserData(<?php echo $value['id']; ?>);">
                                                            <td><?php echo $value['fullName']; ?></td>
                                                            <td><?php echo $value['login']; ?></td>
                                                            <td><?php echo $value['email']; ?></td>
                                                            <td><?php echo $value['role']; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <edit-user></edit-user>                        
                                </div>                        
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Добавить нового пользователя</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" method="post" data-ng-submit="addNewUser()">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="newUser">ФИО</label>
                                <div class="col-md-4">
                                    <input id="newUser" name="newUser" data-ng-model="newUser" class="form-control input-md" required="true" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="newLogin">Логин</label>
                                <div class="col-md-4">
                                    <input id="newLogin" name="newLogin" data-ng-model="newLogin" class="form-control " required="true" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="newEmail">Email</label>
                                <div class="col-md-4">
                                    <input id="newEmail" name="newEmail" data-ng-model="newEmail" class="form-control input-md" required="true" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="newPassword">Пароль</label>
                                <div class="col-md-4">
                                    <input id="newPassword" name="newPassword" data-ng-model="newPassword" class="form-control input-md" required="true" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="newRole">Роль</label>
                                <div class="col-md-4">
                                    <select name="newRole" data-ng-model="newRole" class="form-control">
                                        <option selected>Выберите роль</option>
                                        <option value="1">Администратор</option>
                                        <option value="2">Менеджер</option>
                                    </select>
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
            <?php } else { ?>
            <h1 style="margin-top:0; padding-top:10px;">У вас недостаточно прав для работы с пользователями</h1>
        <?php } ?>
        </div>
        <!-- /#page-wrapper -->
    
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/js/jquery.js"></script>

    <!-- Angular -->
    <script src="/js/angular.min.js"></script>

    <!-- Angular Route -->
    <script src="/js/angular-route.js"></script>

    <script src="/js/admin/users.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/js/admin/metisMenu.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/admin/sb-admin-2.js"></script>

    <script src="/js/admin/products.js"></script>

</body>

</html>
