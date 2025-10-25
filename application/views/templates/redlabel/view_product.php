<style>
.stock-status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
    margin-bottom: 15px;
}

.in-stock {
    background-color: #dff0d8;
    color: #3c763d;
}

.out-of-stock {
    background-color: #f2dede;
    color: #a94442;
}
/* Popup styles */
.popup {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

.popup-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 800px;
    text-align: center;
    position: relative;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    right: 10px;
    top: 5px;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

#videoPlayer {
    width: 100%;
    height: auto;
    max-height: 450px;
}
.mini-box {
    height: 80px; /* Adjust the height as needed */
    width:80px;
    object-fit: cover;
    cursor: pointer;
}
.carousel-thumbnail-container {
    display: flex;
    justify-content: center;
}
.carousel-thumbnail-container .col-3 {
    padding: 5px;
}
@media (max-width: 992px) {
  #mcart {
    flex-direction: column;
    align-items: unset !important;
    gap: 10px;
  }
  #what{
    margin-left:0px!important;

  }

}
</style>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Breadcrumb Start -->
 <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
<?php
    function is_video($file) {
    $video_extensions = ['mp4', 'webm', 'ogg'];
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    return in_array(strtolower($ext), $video_extensions);
}
?>
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                    <?php 
                    $productImage = base_url('/attachments/no-image-frontend.png');
                    if(is_file('attachments/shop_images/' . $product['image'])) {
                        $productImage = base_url('/attachments/shop_images/' . $product['image']);
                    }
                ?>
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="<?=$productImage;?>" alt="Image">
                        </div>
                        <?php
                            $thumbnails = [];
if ($product['folder'] != null) {
    $dir = "attachments/shop_images/" . $product['folder'] . '/';
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            $i = 1;
            while (($file = readdir($dh)) !== false) {
                if (is_file($dir . $file)) {
                    ?>
                    <div class="carousel-item">
                        <?php if (is_video($file)): ?>
                            <video class="w-100 h-100 video-thumbnail" src="<?= base_url($dir . $file) ?>" data-video="<?= base_url($dir . $file) ?>" data-num="<?= $i; ?>" controls data-num="<?= $i; ?>">
                                <source src="<?= base_url($dir . $file) ?>" type="video/<?= pathinfo($file, PATHINFO_EXTENSION) ?>">
                                Your browser does not support the video tag.
                            </video>
                        <?php else: ?>
                            <img class="w-100 h-100" src="<?= base_url($dir . $file) ?>" data-num="<?= $i; ?>" alt="Image">
                        <?php endif; ?>
                    </div>
                    <?php
                         $thumbnails[] = $file;
                    $i++;
                }
            }
            closedir($dh);
        }
    }?>
    </div>
    <?php
}
?>
    <div id="videoPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <video id="videoPlayer" controls>
                <source id="videoSource" src="" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>

                <div class="carousel-thumbnail-container mt-2">
        <div class="row">
            <div class="col-3">
                <img class="img-thumbnail mini-box" src="<?=$productImage;?>" alt="Thumbnail" data-target="#product-carousel" data-slide-to="0">
            </div>
            <?php
            $i = 1;
            foreach ($thumbnails as $file) {
                ?>
                <div class="col-3">
                    <?php if (is_video($file)): ?>
                        <video class="img-thumbnail mini-box video-thumbnail" controls data-target="#product-carousel" data-slide-to="<?= $i; ?>">
                            <source src="<?= base_url($dir . $file) ?>" type="video/<?= pathinfo($file, PATHINFO_EXTENSION) ?>">
                            Your browser does not support the video tag.
                        </video>
                    <?php else: ?>
                        <img class="img-thumbnail mini-box" src="<?= base_url($dir . $file) ?>" data-target="#product-carousel" data-slide-to="<?= $i; ?>" alt="Thumbnail">
                    <?php endif; ?>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>
    </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3><?= $product['title'] ?></h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4"><?= $product['price'] . CURRENCY ?></h3>
                    <p class="mb-4">Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit
                        clita ea. Sanc ipsum et, labore clita lorem magna duo dolor no sea
                        Nonumy</p>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Stock Status:</strong>
                        <form>
                            <div class="custom-control custom-radio custom-control-inline">
                                
                            <?php  if ($publicQuantity < 1) { ?>
        
             
                                <div class="stock-status in-stock">In Stock</div>
        
            <?php } else{?>
                
                <div class="stock-status .out-of-stock">Out of stock</div>
            <?php }?>
                            </div>
                       
                        </form>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Category:</strong>
                        <form>
                            <div class="custom-control custom-radio custom-control-inline">
                             
                                <label class="custom-control-label" for="color-1"> <?= $product['categorie_name'] ?></label>
                            </div>
                     
                        </form>
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2" id="mcart" >
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center count" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                   
                    <?php if ($product['quantity'] > 0) { ?>
                    <a href="javascript:void(0);" data-id="<?= $product['id'] ?>" data-goto="<?= LANG_URL . '/shopping-cart' ?>" class="add-to-cart btn-add">
                        <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>     </a>  
                            <a href="https://api.whatsapp.com/send?phone=97471217799&text=<?= $product['vendor_url'] == null ? LANG_URL . '/' . $product['url'] : LANG_URL . '/' . $product['vendor_url'] . '/' . $product['url'] ?>" data-id="<?= $product['id'] ?>" data-goto="<?= LANG_URL . '/shopping-cart' ?>" style="margin-left:20px;" class="btn-add" id="what">
                        <button class="btn btn-primary px-3"><img src="<?= base_url('assets/imgs/ee.png') ?>" style="width:20px;"> Connet with Whatsapp</button>     </a>  
                            
                            <?php } else { ?>
                        <div class="alert alert-info"><?= lang('out_of_stock_product') ?></div>
                    <?php } ?>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <?= $product['description'] ?>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">1 review for "Product Name"</h4>
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                <?php
        if (!empty($sameCagegoryProducts)) {
            $load::getProducts($sameCagegoryProducts, 'col-sm-4 col-md-12', false);
        } else {
            ?>
            <div class="alert alert-info"><?= lang('no_same_category_products') ?></div>
            <?php
        }
        ?>  
    



                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
    var $modal = $('#videoPopup');
    var $video = $('#videoPlayer');
    var $videoSource = $('#videoSource');

    $('.video-thumbnail').on('click', function() {
        var videoUrl = $(this).data('video');
        $videoSource.attr('src', videoUrl);
        $video[0].load();
        $modal.show();
        $video[0].play();
    });

    $('.close').on('click', function() {
        $modal.hide();
        $video[0].pause();
        $video[0].currentTime = 0;
    });

    $(window).on('click', function(event) {
        if ($(event.target).is($modal)) {
            $modal.hide();
            $video[0].pause();
            $video[0].currentTime = 0;
        }
    });
});
</script>