<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loop
{

    private static $CI;

    public function __construct()
    {
        self::$CI = & get_instance();
    }

    static function getCartItems($cartItems)
    {
        if (!empty($cartItems['array'])) {
            ?>
            <li class="cleaner text-right">
                <a href="javascript:void(0);" class="btn-blue-round" onclick="clearCart()" style="padding: 10px;">
                    <?= lang('clear_all') ?>
                </a>
            </li>
            <li class="divider"></li>
            <?php
            foreach ($cartItems['array'] as $cartItem) {
                ?>
                <li class="shop-item" data-artticle-id="<?= $cartItem['id'] ?>">
                    <span class="num_added hidden"><?= $cartItem['num_added'] ?></span>
                    <div class="item">
                        <div class="item-in">
                            <div class="left-side">
                                <?php 
                                    $productImage = base_url('/attachments/no-image-frontend.png');
                                    if(is_file('attachments/shop_images/' . $cartItem['image'])) {
                                        $productImage = base_url('/attachments/shop_images/' . $cartItem['image']);
                                    }
                                ?>
                                <img src="<?= $productImage; ?>" alt="<?= htmlentities($cartItem['title']) ?>" />
                            </div>
                            <div class="right-side">
                                <a href="<?= LANG_URL . '/' . $cartItem['url'] ?>" class="item-info">
                                    <span><?= $cartItem['title'] ?></span>
                                    <span class="prices">
                                        <?=
                                        $cartItem['num_added'] == 1 ? $cartItem['price'] : '<span class="num-added-single">'
                                                . $cartItem['num_added'] . '</span> x <span class="price-single">'
                                                . $cartItem['price'] . '</span> - <span class="sum-price-single">'
                                                . $cartItem['sum_price'] . '</span>'
                                        ?>
                                    </span>
                                    <span class="currency"><?= CURRENCY ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="item-x-absolute">
                            <button class="btn btn-xs btn-danger pull-right" onclick="removeProduct(<?= $cartItem['id'] ?>)">
                                x
                            </button>
                        </div>
                    </div>
                </li>
                <?php
            }
            ?>
            <li class="divider"></li>
            <li class="text-center">
                <a class="go-checkout btn btn-default btn-sm" href="<?= LANG_URL . '/checkout' ?>">
                    <?=
                    !empty($cartItems['array']) ? '<i class="fa fa-check"></i> '
                            . lang('checkout') . ' - <span class="finalSum">' . $cartItems['finalSum']
                            . '</span>' . CURRENCY : '<span class="no-for-pay">' . lang('no_for_pay') . '</span>'
                    ?>
                </a>
            </li>
        <?php } else {
            ?>
            <li class="text-center"><?= lang('no_products') ?></li>
            <?php
        }
    }

    static public function getProducts($products, $classes = '', $carousel = false)
    {
        if ($carousel == true) {
            ?>
            <div class="carousel slide" id="small_carousel" data-ride="carousel" data-interval="3000">
                <ol class="carousel-indicators">
                    <?php
                    $i = 0;
                    while ($i < count($products)) {
                        if ($i == 0)
                            $active = 'active';
                        else
                            $active = '';
                        ?>
                        <li data-target="#small_carousel" data-slide-to="<?= $i ?>" class="<?= $active ?>"></li>
                        <?php
                        $i++;
                    }
                    ?>
                </ol>
                <div class="carousel-inner products">
                    <?php
                }
                $i = 0;
                foreach ($products as $article) {
                    if ($i == 0 && $carousel == true) {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                    ?>
                    <div class="product-item bg-light mb-4 <?= $carousel == true ? 'item' : '' ?> <?= $classes ?> <?= $active ?>">
                        <div class="product-img position-relative overflow-hidden">
                            <?php 
                                $backgroundImageFile = base_url('/attachments/no-image-frontend.png');
                                if(is_file('attachments/shop_images/' . $article['image'])) {
                                    $backgroundImageFile = base_url('/attachments/shop_images/' . $article['image']);
                                }
                            ?>
                            <img class="img-fluid w-100" src="<?= htmlentities($backgroundImageFile) ?>" alt="<?= htmlentities($article['title']) ?>">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square add-to-cart refresh-me" href="javascript:void(0);" data-goto="<?= LANG_URL . '/shopping-cart' ?>" data-id="<?= $article['id'] ?>">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                                <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a> -->
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="<?= $article['vendor_url'] == null ? LANG_URL . '/' . $article['url'] : LANG_URL . '/' . $article['vendor_url'] . '/' . $article['url'] ?>"><i class="fa fa-search"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="https://api.whatsapp.com/send?phone=97471217799&text=<?= $article['vendor_url'] == null ? LANG_URL . '/' . $article['url'] : LANG_URL . '/' . $article['vendor_url'] . '/' . $article['url'] ?>" ><i class="fab fa-whatsapp fa-1x"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="<?= $article['vendor_url'] == null ? LANG_URL . '/' . $article['url'] : LANG_URL . '/' . $article['vendor_url'] . '/' . $article['url'] ?>">
                                <?= character_limiter($article['title'], 70) ?>
                           
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h4><?= CURRENCY ?> <?= $article['price'] != '' ? number_format($article['price'], 2) : 0 ?></h4>
                                <?php if ($article['old_price'] != '' && $article['old_price'] != 0 && $article['price'] != '' && $article['price'] != 0) { ?>
                                    <h6 class="text-muted ml-2"><del><?= CURRENCY ?> <?= number_format($article['old_price'], 2) ?></del></h6>
                                <?php } ?>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <!-- Here you might want to integrate a rating system if available -->
                                <?php for ($star = 1; $star <= 5; $star++) { ?>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                <?php } ?>
                                <small>(99)</small> <!-- Replace 99 with actual review count if available -->
                            </div>
                            </a>
                        </div>

                    </div>
                    <?php
                    $i++;
                }
                if ($carousel == true) {
                    ?>
                </div>
                <a class="left carousel-control" href="#small_carousel" role="button" data-slide="prev">
                    <i class="fa fa-5x fa-angle-left" aria-hidden="true"></i>
                </a>
                <a class="right carousel-control" href="#small_carousel" role="button" data-slide="next">
                    <i class="fa fa-5x fa-angle-right" aria-hidden="true"></i>
                </a>
            </div>
            <?php
        }
    }

}
