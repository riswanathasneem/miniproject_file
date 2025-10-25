<style>
    body {
	background: #ffff !important;
	font-family: "Open Sans", sans-serif !important;
}
    #home-slider .left-side img {
   width:100%;
}
.btn-add {
    color: #ffff !important;
    font-size: 11px !important;
    text-transform: uppercase !important;
    font-weight: bold !important;
    background: none !important;
    border: 0px solid #7ac400 !important;
    padding: 6px 14px !important; 
    margin-top: 5px !important;
    line-height: 16px !important;
    border-radius: 0px !important;
    background: black !important;
     -webkit-box-shadow: unset !important;
        -moz-box-shadow: unset !important;
   box-shadow:unset !important;
   position: absolute !important;
    top: 150px;
    width:100%;
}
.btn-add:hover {
    color: #fff !important;
    background: #e34444 !important;
    box-shadow: none !important;
}
.product-list .img-container {
    position: relative;
}

.product-list .price-down {
    position: absolute;
    top: 10px;  /* Adjust as needed */
    left: 10px;  /* Adjust as needed */
    background-color: red;  /* Adjust as needed */
    color: white;  /* Adjust as needed */
    padding: 5px 10px;  /* Adjust as needed */
    font-size: 14px;  /* Adjust as needed */
    font-weight: bold;  /* Adjust as needed */
    border-radius: 5px;  /* Adjust as needed */
    z-index: 10;
}

.product-list .img-container a {
    display: block;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
}

.product-list .inner {
    position: relative;
    text-align: center;
}

div.product-list h2 a {
    font-size: 18px !important;
}
div.filter-sidebar ul li a {

    font-size: 18px !important;
}
.navbar li a {

    text-shadow: unset !important; 
 
}
div.product-list h2 {
    height: 25px;

}
#home-slider .carousel-control.right {
display:none;
}
#home-slider .carousel-control.left {
display:none;
}
.gradient-color {
    /* background: #D83C3C; */
    background: #333 !important;
 
    /* background: -webkit-gradient(linear, left top, left bottom, from(#D83C3C), to(#B03131)); */
    border: solid 1px #333 !important;
    box-shadow: 2px 2px 3px #ffff !important;
}
.navbar .active a, .navbar li:hover a {
    background: #0399D4 !important;
    color: #fff !important;
    background: transparent !important;
    position: relative !important;
    background: #f7941d !important;
}
#top-part {
    background-color: #f7941d;
     margin-bottom: 0px !important; 

}
#languages-bar {
    margin-bottom: 0px !important; 
}
.navbar {

    margin-bottom: 0px !important;

}
#home-slider .left-side img {
    max-height: unset;
}
#home-slider {
    height: auto;

}
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($sliderProducts);exit;
if (count($sliderProducts) > 0) {
    ?>
    <div id="home-slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $i = 0;
            while ($i < count($sliderProducts)) {
                ?>
                <li data-target="#home-slider" data-slide-to="0" class="<?= $i == 0 ? 'active' : '' ?>"></li>
                <?php
                $i++;
            }
            ?>
        </ol>
        <!-- <div class="container"> -->
            <div class="carousel-inner" role="listbox">
                <?php
                $i = 0;
                foreach ($sliderProducts as $article) {
                    ?>
                    <div class="item <?= $i == 0 ? 'active' : '' ?>">
                        <div class="row">
                            <div class="col-sm-12 left-side">
                                <a href="<?= LANG_URL . '/' . $article['url'] ?>">
                                    <?php 
                                        $productImage = base_url('/attachments/no-image-frontend.png');
                                        if(is_file('attachments/shop_images/' . $article['image'])) {
                                            $productImage = base_url('/attachments/shop_images/' . $article['image']);
                                        }
                                    ?>
                                    <img src="<?= $productImage ?>" class="img-responsive" alt="">
                                </a>
                            </div>
               
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>
        <!-- </div> -->
        <a class="left carousel-control" href="#home-slider" role="button" data-slide="prev"></a>
        <a class="right carousel-control" href="#home-slider" role="button" data-slide="next"></a>
    </div>
<?php } ?>
<!-- <div class="container">
<div class="row row-cols-1 row-cols-lg-3 g-4">
							<div class="col">
								<div class="d-flex align-items-center justify-content-center p-3 border">
									<div class="fs-1 text-content"><i class="bx bx-taxi"></i>
									</div>
									<div class="info-box-content ps-3">
										<h6 class="mb-0 fw-bold">FREE SHIPPING &amp; RETURN</h6>
										<p class="mb-0">Free shipping on all orders over $49</p>
									</div>
								</div>
							</div>
	
							<div class="col">
								<div class="d-flex align-items-center justify-content-center p-3 border">
									<div class="fs-1 text-content"><i class="bx bx-dollar-circle"></i>
									</div>
									<div class="info-box-content ps-3">
										<h6 class="mb-0 fw-bold">MONEY BACK GUARANTEE</h6>
										<p class="mb-0">100% money back guarantee</p>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="d-flex align-items-center justify-content-center p-3 border">
									<div class="fs-1 text-content"><i class="bx bx-support"></i>
									</div>
									<div class="info-box-content ps-3">
										<h6 class="mb-0 fw-bold">ONLINE SUPPORT 24/7</h6>
										<p class="mb-0">Awesome Support for 24/7 Days</p>
									</div>
								</div>
							</div>
						</div>
                        </div> -->
<div class="container" id="home-page">
    <div class="row">
        <div class="col-md-3">
            <div class="filter-sidebar">
                <div class="title">
                    <span><?= lang('categories') ?></span>
                    <?php if (isset($_GET['category']) && $_GET['category'] != '') { ?>
                        <a href="javascript:void(0);" class="clear-filter" data-type-clear="category" data-toggle="tooltip" data-placement="right" title="<?= lang('clear_the_filter') ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                    <?php } ?>
                </div>
                <a href="javascript:void(0)" id="show-xs-nav" class="visible-xs visible-sm">
                    <span class="show-sp"><?= lang('showXsNav') ?><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></span>
                    <span class="hidde-sp"><?= lang('hideXsNav') ?><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></span>
                </a>
                <div id="nav-categories">
                    <?php

                    function loop_tree($pages, $is_recursion = false)
                    {
                        ?>
                        <ul class="<?= $is_recursion === true ? 'children' : 'parent' ?>">
                            <?php
                            foreach ($pages as $page) {
                                $children = false;
                                if (isset($page['children']) && !empty($page['children'])) {
                                    $children = true;
                                }
                                ?>
                                <li>
                                    <?php if ($children === true) {
                                        ?>
                                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-circle-o" aria-hidden="true"></i>
                                    <?php } ?>
                                    <a href="javascript:void(0);" data-categorie-id="<?= $page['id'] ?>" class="go-category left-side <?= isset($_GET['category']) && $_GET['category'] == $page['id'] ? 'selected' : '' ?>">
                                        <?= $page['name'] ?>
                                    </a>
                                    <?php
                                    if ($children === true) {
                                        loop_tree($page['children'], true);
                                    } else {
                                        ?>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                        <?php
                        if ($is_recursion === true) {
                            ?>
                            </li>
                            <?php
                        }
                    }

                    loop_tree($home_categories);
                    ?>
                </div>
            </div>
            <?php if ($showBrands == 1) { ?>
                <div class="filter-sidebar">
                    <div class="title">
                        <span><?= lang('brands') ?></span>
                        <?php if (isset($_GET['brand_id']) && $_GET['brand_id'] != '') { ?>
                            <a href="javascript:void(0);" class="clear-filter" data-type-clear="brand_id" data-toggle="tooltip" data-placement="right" title="<?= lang('clear_the_filter') ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                        <?php } ?>
                    </div>
                    <ul>
                        <?php foreach ($brands as $brand) { ?>
                            <li>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i> <a href="javascript:void(0);" data-brand-id="<?= $brand['id'] ?>" class="brand <?= isset($_GET['brand_id']) && $_GET['brand_id'] == $brand['id'] ? 'selected' : '' ?>"><?= $brand['name'] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } if ($showOutOfStock == 1) { ?>
                <div class="filter-sidebar">
                    <div class="title">
                        <span><?= lang('store') ?></span>
                        <?php if (isset($_GET['in_stock']) && $_GET['in_stock'] != '') { ?>
                            <a href="javascript:void(0);" class="clear-filter" data-type-clear="in_stock" data-toggle="tooltip" data-placement="right" title="<?= lang('clear_the_filter') ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                        <?php } ?>
                    </div>
                    <ul>
                        <li>
                            <a href="javascript:void(0);" data-in-stock="1" class="in-stock <?= isset($_GET['in_stock']) && $_GET['in_stock'] == '1' ? 'selected' : '' ?>"><?= lang('in_stock') ?> (<?= $countQuantities['in_stock'] ?>)</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-in-stock="0" class="in-stock <?= isset($_GET['in_stock']) && $_GET['in_stock'] == '0' ? 'selected' : '' ?>"><?= lang('out_of_stock') ?> (<?= $countQuantities['out_of_stock'] ?>)</a>
                        </li>
                    </ul>
                </div>
            <?php } if ($shippingOrder != 0 && $shippingOrder != null) { ?>
                <div class="filter-sidebar">
                    <div class="title">
                        <span><?= lang('freeShippingHeader') ?></span>
                    </div>
                    <div class="oaerror info">
                        <strong><?= lang('promo') ?></strong> - <?= str_replace(array('%price%', '%currency%'), array($shippingOrder, CURRENCY), lang('freeShipping')) ?>!
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="col-md-9 eqHeight" id="products-side">
            <div class="alone title">
                <span><?= lang('products') ?></span>
            </div>
            <div class="product-sort gradient-color">
                <div class="row">
                    <div class="ord col-sm-4">
                        <div class="form-group">
                            <select class="selectpicker order form-control" data-order-to="order_new">
                                <option <?= isset($_GET['order_new']) && $_GET['order_new'] == "desc" ? 'selected' : '' ?> <?= !isset($_GET['order_new']) || $_GET['order_new'] == "" ? 'selected' : '' ?> value="desc"><?= lang('new') ?> </option>
                                <option <?= isset($_GET['order_new']) && $_GET['order_new'] == "asc" ? 'selected' : '' ?> value="asc"><?= lang('old') ?> </option>
                            </select>
                        </div>
                    </div>
                    <div class="ord col-sm-4">
                        <div class="form-group">
                            <select class="selectpicker order form-control" data-order-to="order_price" title="<?= lang('price_title') ?>..">
                                <option label="<?= lang('not_selected') ?>"></option>
                                <option <?= isset($_GET['order_price']) && $_GET['order_price'] == "asc" ? 'selected' : '' ?> value="asc"><?= lang('price_low') ?> </option>
                                <option <?= isset($_GET['order_price']) && $_GET['order_price'] == "desc" ? 'selected' : '' ?> value="desc"><?= lang('price_high') ?> </option>
                            </select>
                        </div>
                    </div>
                    <div class="ord col-sm-4">
                        <div class="form-group">
                            <select class="selectpicker order form-control" data-order-to="order_procurement" title="<?= lang('procurement_title') ?>..">
                                <option label="<?= lang('not_selected') ?>"></option>
                                <option <?= isset($_GET['order_procurement']) && $_GET['order_procurement'] == "desc" ? 'selected' : '' ?> value="desc"><?= lang('procurement_desc') ?> </option>
                                <option <?= isset($_GET['order_procurement']) && $_GET['order_procurement'] == "asc" ? 'selected' : '' ?> value="asc"><?= lang('procurement_asc') ?> </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (!empty($products)) {
                $load::getProducts($products, 'col-sm-4 col-md-3', false);
            } else {
                ?>
                <script>
                    $(document).ready(function () {
                        ShowNotificator('alert-info', '<?= lang('no_results') ?>');
                    });
                </script>
                <?php
            }
            ?>
        </div>
    </div>
    <?php if ($links_pagination != '') { ?>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <?= $links_pagination ?>
            </div>
        </div>
    <?php } ?>
</div>
<script>
$(document).ready(function() {
    $('.product-list').hover(
        function() {
            // Mouse over
            $(this).find('.add-to-cart, .buy-now-icon').css('opacity', '1');
        },
        function() {
            // Mouse out
            $(this).find('.add-to-cart, .buy-now-icon').css('opacity', '0');
        }
    );
});
</script>