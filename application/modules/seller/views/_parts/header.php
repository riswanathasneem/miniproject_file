<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= $description ?>">
        <title><?= $title ?></title>
        <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
        <link href="<?= base_url('assets/css/custom-admin.css') ?>" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet' type='text/css'>
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            div.left-side ul.sidebar-menu li a {

    color: #fff;

}
            .navbar-default {
    background-color: #34334a;
    border-color: #e7e7e7;
}
            .navbar-default .navbar-nav>li>a {
    color: #fff;
}
div.left-side ul.sidebar-menu li a:hover, div.left-side ul.sidebar-menu li a.active {
    background-color: #eeeeee;
    text-decoration: none;
    color: #34334a;
}
.navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
    color: #83c1f7;
}
.btn-info {
    width: max-content;
    height: 38px;
    padding: 15px 22px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-family: Inter, sans-serif;
    font-size: 14px;
    font-weight: 700;
    line-height: 20px;
    border: 1px solid var(--Main);
    border-radius: 12px;
    background-color: var(--Main);
    background-size: 100%;
    overflow: hidden;
    transition: all .3s ease;
    color: #fff;
    background-color: #5bc0de;
    border-color: #46b8da;
    margin-bottom:10px;
}
.btn-danger {
    color: #fff;
    border-color: #d43f3a;
    width: max-content;
    height: 38px;
    padding: 15px 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-family: Inter, sans-serif;
    font-size: 14px;
    font-weight: 700;
    line-height: 20px;
    border: 1px solid var(--Main);
    border-radius: 12px;
    background-color: var(--Main);
    background-size: 100%;
    overflow: hidden;
    transition: all .3s ease;
    color: #fff;
    background-color: #d9534f;
    border-color: #46b8da;
}
.btn-primary {
    width: max-content;
    height: 38px;
    padding: 15px 22px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-family: Inter, sans-serif;
    font-size: 14px;
    font-weight: 700;
    line-height: 20px;
    border: 1px solid var(--Main);
    border-radius: 12px;
    background-color: var(--Main);
    background-size: 100%;
    overflow: hidden;
    transition: all .3s ease;
    color: #fff;
    background-color: #5bc0de;
    border-color: #46b8da;
    margin-bottom:10px;
}
.btn-success {
    width: max-content;
    height: 38px;
    padding: 15px 22px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-family: Inter, sans-serif;
    font-size: 14px;
    font-weight: 700;
    line-height: 20px;
    border: 1px solid var(--Main);
    border-radius: 12px;
    background-color: #5cb85c;
    background-size: 100%;
    overflow: hidden;
    transition: all .3s ease;
    color: #fff;
    background-color: #5cb85c;
    border-color: #46b8da;
    margin-bottom:10px;
}
.btn-warning {
    width: max-content;
    height: 38px;
    padding: 15px 22px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-family: Inter, sans-serif;
    font-size: 14px;
    font-weight: 700;
    line-height: 20px;
    border: 1px solid var(--Main);
    border-radius: 12px;
    background-color: #d58512;
    background-size: 100%;
    overflow: hidden;
    transition: all .3s ease;
    color: #fff;
    background-color: #d58512;
    border-color: #46b8da;
    margin-bottom:10px;
}
        </style>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <?php if ($this->session->userdata('logged_in')) { ?>
                    <nav class="navbar navbar-default" style="background-color: #2d8e9b;">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <i class="fa fa-lg fa-bars"></i>
                            </button>
                        </div>
                        <div id="navbar" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="<?= base_url('seller') ?>"><i class="fa fa-home"></i> <?= lang('home') ?></a></li>
                                <li><a href="<?= base_url() ?>" target="_blank"><i class="glyphicon glyphicon-star"></i> <?= lang('production') ?></a></li>
                                <li>
                                    <a href="javascript:void(0);" class="h-settings"><i class="fa fa-key" aria-hidden="true"></i><?= lang('pass_change') ?></a>
                                    <div class="relative">
                                        <div class="settings">
                                            <div class="panel panel-primary" >
                                                <div class="panel-heading">
                                                    <div class="panel-title"><?= lang('security') ?></div>
                                                </div>     
                                                <div class="panel-body">
                                                    <label><?= lang('change_my_password') ?></label> <span class="bg-success" id="pass_result"><?= lang('changed') ?>!</span>
                                                    <form class="form-inline" role="form">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control new-pass-field" placeholder="<?= lang('new_password'); ?>" name="new_pass">
                                                            <span class="input-group-btn">
                                                                <a href="javascript:void(0);" onclick="changePass()" class="btn btn-primary"><?= lang('update'); ?></a>
                                                            </span>
                                                        </div>
                                                        <hr>
                                                        <span><?= lang('password_strength'); ?>:</span>
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-default generate-pwd"><?= lang('generate_password'); ?></button> 
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#modalCalculator"><i class="fa fa-calculator" aria-hidden="true"></i> <?= lang('calculator'); ?></a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?= base_url('seller/logout') ?>"><i class="fa fa-sign-out"></i> <?= lang('logout'); ?></a></li>
                            </ul>
                        </div>
                    </nav>
                <?php } ?>
                <div class="container-fluid">
                    <div class="row">
                        <?php if ($this->session->userdata('logged_in')) { ?>
                            <div class="col-sm-3 col-md-3 col-lg-2 left-side navbar-default">
                                <div class="show-menu">
                                    <a id="show-xs-nav" class="visible-xs" href="javascript:void(0)">
                                        <span class="show-sp">
                                            <?= lang('show_menu'); ?>
                                            <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
                                        </span>
                                        <span class="hidde-sp">
                                            <?= lang('hide_menu'); ?>
                                            <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                                <ul class="sidebar-menu">
                                    <li class="sidebar-search">
                                        <div class="input-group custom-search-form">
                                            <form method="GET" action="<?= base_url('seller/products') ?>">
                                                <div class="input-group">
                                                    <input class="form-control" name="search_title" value="<?= isset($_GET['search_title']) ? htmlspecialchars($_GET['search_title']) : '' ?>" type="text" placeholder="<?= lang('search_in_products') ?>...">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" value="" placeholder="<?= lang('find_product'); ?>.." type="submit">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                    <li class="header"><?= lang('ECOMMERCE') ?></li>
                                    <li><a href="<?= base_url('seller/publish') ?>" <?= urldecode(uri_string()) == 'seller/publish' ? 'class="active"' : '' ?>><i class="fa fa-edit" aria-hidden="true"></i> <?= lang('publish_product') ?></a></li>
                                    <li><a href="<?= base_url('seller/products') ?>" <?= urldecode(uri_string()) == 'seller/products' ? 'class="active"' : '' ?>><i class="fa fa-files-o" aria-hidden="true"></i> <?= lang('products') ?></a></li>
                                    <!-- <li><a href="<?= base_url('seller/slider') ?>" <?= urldecode(uri_string()) == 'seller/slider' ? 'class="active"' : '' ?>><i class="fa fa-files-o" aria-hidden="true"></i> <?= "Add SLider" ?></a></li>
                                    <li><a href="<?= base_url('seller/sliderview') ?>" <?= urldecode(uri_string()) == 'seller/sliderview' ? 'class="active"' : '' ?>><i class="fa fa-files-o" aria-hidden="true"></i> <?= "Update Slider"?></a></li> -->
                                    <?php if ($showBrands == 1) { ?>
                                        <!-- <li><a href="<?= base_url('seller/brands') ?>" <?= urldecode(uri_string()) == 'seller/brands' ? 'class="active"' : '' ?>><i class="fa fa-registered" aria-hidden="true"></i> <?= lang('brands') ?></a></li> -->
                                    <?php } ?>
                                    <li><a href="<?= base_url('seller/shopcategories') ?>" <?= urldecode(uri_string()) == 'seller/shopcategories' ? 'class="active"' : '' ?>><i class="fa fa-list-alt" aria-hidden="true"></i> <?= lang('shop_categories') ?></a></li>
                                    <li>
                                        <a href="<?= base_url('seller/orders') ?>" <?= urldecode(uri_string()) == 'seller/orders' ? 'class="active"' : '' ?>>
                                            <i class="fa fa-money" aria-hidden="true"></i> <?= lang('orders') ?> 
                                            <?php if ($numNotPreviewOrders > 0) { ?>
                                                <img src="<?= base_url('assets/imgs/exlamation-hi.png') ?>" style="position: absolute; right:10px; top:7px;" alt="">
                                            <?php } ?>
                                        </a>
                                    </li>
                               
                                   
                                </ul>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2">
                                <?php if ($warnings != null) { ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        <?= lang('there_are_some_errors_that_you_must_fix') ?>!
                                        <ol>
                                            <?php foreach ($warnings as $warning) { ?>
                                                <li><?= $warning ?></li>
                                            <?php } ?>
                                        </ol>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div>
                                <?php } ?>

