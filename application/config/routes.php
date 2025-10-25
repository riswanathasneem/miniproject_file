<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'home';

// Load default conrtoller when have only currency from multilanguage
$route['^(\w{2})$'] = $route['default_controller'];

//Checkout
$route['(\w{2})?/?checkout/successcash'] = 'checkout/successPaymentCashOnD';
$route['(\w{2})?/?checkout/successbank'] = 'checkout/successPaymentBank';
$route['(\w{2})?/?checkout/paypalpayment'] = 'checkout/paypalPayment';
$route['(\w{2})?/?checkout/order-error'] = 'checkout/orderError';

// Ajax called. Functions for managing shopping cart
$route['(\w{2})?/?manageShoppingCart'] = 'home/manageShoppingCart';
$route['(\w{2})?/?clearShoppingCart'] = 'home/clearShoppingCart';
$route['(\w{2})?/?discountCodeChecker'] = 'home/discountCodeChecker';

// home page pagination
$route[rawurlencode('home') . '/(:num)'] = "home/index/$1";
// load javascript language file
$route['loadlanguage/(:any)'] = "Loader/jsFile/$1";
// load default-gradient css
$route['cssloader/(:any)'] = "Loader/cssStyle";

// Template Routes
$route['template/imgs/(:any)'] = "Loader/templateCssImage/$1";
$route['templatecss/imgs/(:any)'] = "Loader/templateCssImage/$1";
$route['templatecss/(:any)'] = "Loader/templateCss/$1";
$route['templatejs/(:any)'] = "Loader/templateJs/$1";

// Products urls style
$route['(:any)_(:num)'] = "home/viewProduct/$2";
$route['(\w{2})/(:any)_(:num)'] = "home/viewProduct/$3";
$route['shop-product_(:num)'] = "home/viewProduct/$3";

// blog urls style and pagination
$route['blog/(:num)'] = "blog/index/$1";
$route['blog/(:any)_(:num)'] = "blog/viewPost/$2";
$route['(\w{2})/blog/(:any)_(:num)'] = "blog/viewPost/$3";

// Shopping cart page
$route['shopping-cart'] = "ShoppingCartPage";
$route['(\w{2})/shopping-cart'] = "ShoppingCartPage";

// Shop page (greenlabel template)
$route['shop'] = "home/shop";
$route['(\w{2})/shop'] = "home/shop";

// Textual Pages links
$route['page/(:any)'] = "page/index/$1";
$route['(\w{2})/page/(:any)'] = "page/index/$2";

// Login Public Users Page
$route['login'] = "Users/login";
$route['(\w{2})/login'] = "Users/login";

// Register Public Users Page
$route['register'] = "Users/register";
$route['(\w{2})/register'] = "Users/register";

// Users Profiles Public Users Page
$route['myaccount'] = "Users/myaccount";
$route['myaccount/(:num)'] = "Users/myaccount/$1";
$route['(\w{2})/myaccount'] = "Users/myaccount";
$route['(\w{2})/myaccount/(:num)'] = "Users/myaccount/$2";

// Logout Profiles Public Users Page
$route['logout'] = "Users/logout";
$route['(\w{2})/logout'] = "Users/logout";

$route['sitemap.xml'] = "home/sitemap";
$route['kirilkirkov-ecommerce-ci-bs3-platform'] = "home/platform";

// Confirm link
$route['confirm/(:any)'] = "home/confirmLink/$1";

/*
 * Vendor Controllers Routes
 */
$route['vendor/login'] = "vendor/auth/login";
$route['(\w{2})/vendor/login'] = "vendor/auth/login";
$route['vendor/register'] = "vendor/auth/register";
$route['(\w{2})/vendor/register'] = "vendor/auth/register";
$route['vendor/forgotten-password'] = "vendor/auth/forgotten";
$route['(\w{2})/vendor/forgotten-password'] = "vendor/auth/forgotten";
$route['vendor/me'] = "vendor/VendorProfile";
$route['(\w{2})/vendor/me'] = "vendor/VendorProfile";
$route['vendor/logout'] = "vendor/VendorProfile/logout";
$route['(\w{2})/vendor/logout'] = "vendor/VendorProfile/logout";
$route['vendor/products'] = "vendor/Products";
$route['(\w{2})/vendor/products'] = "vendor/Products";
$route['vendor/products/(:num)'] = "vendor/Products/index/$1";
$route['(\w{2})/vendor/products/(:num)'] = "vendor/Products/index/$2";
$route['vendor/add/product'] = "vendor/AddProduct";
$route['(\w{2})/vendor/add/product'] = "vendor/AddProduct";
$route['vendor/edit/product/(:num)'] = "vendor/AddProduct/index/$1";
$route['(\w{2})/vendor/edit/product/(:num)'] = "vendor/AddProduct/index/$1";
$route['vendor/orders'] = "vendor/Orders";
$route['(\w{2})/vendor/orders'] = "vendor/Orders";
$route['vendor/uploadOthersImages'] = "vendor/AddProduct/do_upload_others_images";
$route['vendor/loadOthersImages'] = "vendor/AddProduct/loadOthersImages";
$route['vendor/removeSecondaryImage'] = "vendor/AddProduct/removeSecondaryImage";
$route['vendor/delete/product/(:num)'] = "vendor/products/deleteProduct/$1";
$route['(\w{2})/vendor/delete/product/(:num)'] = "vendor/products/deleteProduct/$1";
$route['vendor/view/(:any)'] = "Vendor/index/0/$1";
$route['(\w{2})/vendor/view/(:any)'] = "Vendor/index/0/$2";
$route['vendor/view/(:any)/(:num)'] = "Vendor/index/$2/$1";
$route['(\w{2})/vendor/view/(:any)/(:num)'] = "Vendor/index/$3/$2";
$route['(:any)/(:any)_(:num)'] = "Vendor/viewProduct/$1/$3";
$route['(\w{2})/(:any)/(:any)_(:num)'] = "Vendor/viewProduct/$2/$4";
$route['vendor/changeOrderStatus'] = "vendor/orders/changeOrdersOrderStatus";
$route['category/(:num)'] = 'category/index/$1';
// Site Multilanguage
$route['^(\w{2})/(.*)$'] = '$2';

/*
 * Admin Controllers Routes
 */
// HOME / LOGIN
$route['admin'] = "admin/home/login";
// ECOMMERCE GROUP
$route['admin/publish'] = "admin/ecommerce/publish";
$route['admin/slider'] = "admin/ecommerce/slider";
$route['admin/publish/(:num)'] = "admin/ecommerce/publish/index/$1";
$route['admin/slider/(:num)'] = "admin/ecommerce/slider/index/$1";
$route['admin/removeSecondaryImage'] = "admin/ecommerce/publish/removeSecondaryImage";
$route['admin/sliderview'] = "admin/ecommerce/sliderview";
$route['admin/sliderview/(:num)'] = "admin/ecommerce/products/sliderview/$1";
$route['admin/products'] = "admin/ecommerce/products";
$route['admin/products/(:num)'] = "admin/ecommerce/products/index/$1";
$route['admin/productStatusChange'] = "admin/ecommerce/products/productStatusChange";
$route['admin/shopcategories'] = "admin/ecommerce/ShopCategories";
$route['admin/shopcategories/(:num)'] = "admin/ecommerce/ShopCategories/index/$1";
$route['admin/editshopcategorie'] = "admin/ecommerce/ShopCategories/editShopCategorie";
$route['admin/orders'] = "admin/ecommerce/orders";
$route['admin/orders/(:num)'] = "admin/ecommerce/orders/index/$1";
$route['admin/changeOrdersOrderStatus'] = "admin/ecommerce/orders/changeOrdersOrderStatus";
$route['admin/orders/delete/(:num)'] = "admin/ecommerce/orders/deleteOrder/$1";
$route['admin/brands'] = "admin/ecommerce/brands";
$route['admin/changePosition'] = "admin/ecommerce/ShopCategories/changePosition";
$route['admin/discounts'] = "admin/ecommerce/discounts";
$route['admin/discounts/(:num)'] = "admin/ecommerce/discounts/index/$1";
// BLOG GROUP
$route['admin/blogpublish'] = "admin/blog/BlogPublish";
$route['admin/blogpublish/(:num)'] = "admin/blog/BlogPublish/index/$1";
$route['admin/blog'] = "admin/blog/blog";
$route['admin/blog/(:num)'] = "admin/blog/blog/index/$1";
// SETTINGS GROUP
$route['admin/settings'] = "admin/settings/settings";
$route['admin/styling'] = "admin/settings/styling";
$route['admin/templates'] = "admin/settings/templates";
$route['admin/titles'] = "admin/settings/titles";
$route['admin/pages'] = "admin/settings/pages";
$route['admin/emails'] = "admin/settings/emails";
$route['admin/emails/(:num)'] = "admin/settings/emails/index/$1";
$route['admin/history'] = "admin/settings/history";
$route['admin/history/(:num)'] = "admin/settings/history/index/$1";
// ADVANCED SETTINGS
$route['admin/languages'] = "admin/advanced_settings/languages";
$route['admin/filemanager'] = "admin/advanced_settings/filemanager";
$route['admin/adminusers'] = "admin/advanced_settings/adminusers";
// TEXTUAL PAGES
$route['admin/pageedit/(:any)'] = "admin/textual_pages/TextualPages/pageEdit/$1";
$route['admin/changePageStatus'] = "admin/textual_pages/TextualPages/changePageStatus";
// LOGOUT
$route['admin/logout'] = "admin/home/home/logout";
// Admin pass change ajax
$route['admin/changePass'] = "admin/home/home/changePass";
$route['admin/uploadOthersImages'] = "admin/ecommerce/publish/do_upload_others_images";
$route['admin/loadOthersImages'] = "admin/ecommerce/publish/loadOthersImages";
// VENDORS
$route['admin/listvendors'] = "admin/vendors/listvendors";


// HOME / LOGIN
$route['delivery_agent'] = "delivery_agent/home/login";
// ECOMMERCE GROUP
$route['delivery_agent/publish'] = "delivery_agent/ecommerce/publish";
$route['delivery_agent/slider'] = "delivery_agent/ecommerce/slider";
$route['delivery_agent/publish/(:num)'] = "delivery_agent/ecommerce/publish/index/$1";
$route['delivery_agent/slider/(:num)'] = "delivery_agent/ecommerce/slider/index/$1";
$route['delivery_agent/removeSecondaryImage'] = "delivery_agent/ecommerce/publish/removeSecondaryImage";
$route['delivery_agent/sliderview'] = "delivery_agent/ecommerce/sliderview";
$route['delivery_agent/sliderview/(:num)'] = "delivery_agent/ecommerce/products/sliderview/$1";
$route['delivery_agent/products'] = "delivery_agent/ecommerce/products";
$route['delivery_agent/products/(:num)'] = "delivery_agent/ecommerce/products/index/$1";
$route['delivery_agent/productStatusChange'] = "delivery_agent/ecommerce/products/productStatusChange";
$route['delivery_agent/shopcategories'] = "delivery_agent/ecommerce/ShopCategories";
$route['delivery_agent/shopcategories/(:num)'] = "delivery_agent/ecommerce/ShopCategories/index/$1";
$route['delivery_agent/editshopcategorie'] = "delivery_agent/ecommerce/ShopCategories/editShopCategorie";
$route['delivery_agent/orders'] = "delivery_agent/ecommerce/orders";
$route['delivery_agent/orders/(:num)'] = "delivery_agent/ecommerce/orders/index/$1";
$route['delivery_agent/changeOrdersOrderStatus'] = "delivery_agent/ecommerce/orders/changeOrdersOrderStatus";
$route['delivery_agent/orders/delete/(:num)'] = "delivery_agent/ecommerce/orders/deleteOrder/$1";
$route['delivery_agent/brands'] = "delivery_agent/ecommerce/brands";
$route['delivery_agent/changePosition'] = "delivery_agent/ecommerce/ShopCategories/changePosition";
$route['delivery_agent/discounts'] = "delivery_agent/ecommerce/discounts";
$route['delivery_agent/discounts/(:num)'] = "delivery_agent/ecommerce/discounts/index/$1";
// BLOG GROUP
$route['delivery_agent/blogpublish'] = "delivery_agent/blog/BlogPublish";
$route['delivery_agent/blogpublish/(:num)'] = "delivery_agent/blog/BlogPublish/index/$1";
$route['delivery_agent/blog'] = "delivery_agent/blog/blog";
$route['delivery_agent/blog/(:num)'] = "delivery_agent/blog/blog/index/$1";
// SETTINGS GROUP
$route['delivery_agent/settings'] = "delivery_agent/settings/settings";
$route['delivery_agent/styling'] = "delivery_agent/settings/styling";
$route['delivery_agent/templates'] = "delivery_agent/settings/templates";
$route['delivery_agent/titles'] = "delivery_agent/settings/titles";
$route['delivery_agent/pages'] = "delivery_agent/settings/pages";
$route['delivery_agent/emails'] = "delivery_agent/settings/emails";
$route['delivery_agent/emails/(:num)'] = "delivery_agent/settings/emails/index/$1";
$route['delivery_agent/history'] = "delivery_agent/settings/history";
$route['delivery_agent/history/(:num)'] = "delivery_agent/settings/history/index/$1";
// ADVANCED SETTINGS
$route['delivery_agent/languages'] = "delivery_agent/advanced_settings/languages";
$route['delivery_agent/filemanager'] = "delivery_agent/advanced_settings/filemanager";
$route['delivery_agent/delivery_agentusers'] = "delivery_agent/advanced_settings/adminusers";
// TEXTUAL PAGES
$route['delivery_agent/pageedit/(:any)'] = "delivery_agent/textual_pages/TextualPages/pageEdit/$1";
$route['delivery_agent/changePageStatus'] = "delivery_agent/textual_pages/TextualPages/changePageStatus";
// LOGOUT
$route['delivery_agent/logout'] = "delivery_agent/home/home/logout";
// delivery_agent pass change ajax
$route['delivery_agent/changePass'] = "delivery_agent/home/home/changePass";
$route['delivery_agent/uploadOthersImages'] = "delivery_agent/ecommerce/publish/do_upload_others_images";
$route['delivery_agent/loadOthersImages'] = "delivery_agent/ecommerce/publish/loadOthersImages";
// VENDORS
$route['delivery_agent/listvendors'] = "delivery_agent/vendors/listvendors";


// HOME / LOGIN
$route['seller'] = "seller/home/login";
// ECOMMERCE GROUP
$route['seller/publish'] = "seller/ecommerce/publish";
$route['seller/slider'] = "seller/ecommerce/slider";
$route['seller/publish/(:num)'] = "seller/ecommerce/publish/index/$1";
$route['seller/slider/(:num)'] = "seller/ecommerce/slider/index/$1";
$route['seller/removeSecondaryImage'] = "seller/ecommerce/publish/removeSecondaryImage";
$route['seller/sliderview'] = "seller/ecommerce/sliderview";
$route['seller/sliderview/(:num)'] = "seller/ecommerce/products/sliderview/$1";
$route['seller/products'] = "seller/ecommerce/products";
$route['seller/products/(:num)'] = "seller/ecommerce/products/index/$1";
$route['seller/productStatusChange'] = "seller/ecommerce/products/productStatusChange";
$route['seller/shopcategories'] = "seller/ecommerce/ShopCategories";
$route['seller/shopcategories/(:num)'] = "seller/ecommerce/ShopCategories/index/$1";
$route['seller/editshopcategorie'] = "seller/ecommerce/ShopCategories/editShopCategorie";
$route['seller/orders'] = "seller/ecommerce/orders";
$route['seller/orders/(:num)'] = "seller/ecommerce/orders/index/$1";
$route['seller/changeOrdersOrderStatus'] = "seller/ecommerce/orders/changeOrdersOrderStatus";
$route['seller/orders/delete/(:num)'] = "seller/ecommerce/orders/deleteOrder/$1";
$route['seller/brands'] = "seller/ecommerce/brands";
$route['seller/changePosition'] = "seller/ecommerce/ShopCategories/changePosition";
$route['seller/discounts'] = "seller/ecommerce/discounts";
$route['seller/discounts/(:num)'] = "seller/ecommerce/discounts/index/$1";
// BLOG GROUP
$route['seller/blogpublish'] = "seller/blog/BlogPublish";
$route['seller/blogpublish/(:num)'] = "seller/blog/BlogPublish/index/$1";
$route['seller/blog'] = "seller/blog/blog";
$route['seller/blog/(:num)'] = "seller/blog/blog/index/$1";
// SETTINGS GROUP
$route['seller/settings'] = "seller/settings/settings";
$route['seller/styling'] = "seller/settings/styling";
$route['seller/templates'] = "seller/settings/templates";
$route['seller/titles'] = "seller/settings/titles";
$route['seller/pages'] = "seller/settings/pages";
$route['seller/emails'] = "seller/settings/emails";
$route['seller/emails/(:num)'] = "seller/settings/emails/index/$1";
$route['seller/history'] = "seller/settings/history";
$route['seller/history/(:num)'] = "seller/settings/history/index/$1";
// ADVANCED SETTINGS
$route['seller/languages'] = "seller/advanced_settings/languages";
$route['seller/filemanager'] = "seller/advanced_settings/filemanager";
$route['seller/sellerusers'] = "seller/advanced_settings/adminusers";
// TEXTUAL PAGES
$route['seller/pageedit/(:any)'] = "seller/textual_pages/TextualPages/pageEdit/$1";
$route['seller/changePageStatus'] = "seller/textual_pages/TextualPages/changePageStatus";
// LOGOUT
$route['seller/logout'] = "seller/home/home/logout";
// seller pass change ajax
$route['seller/changePass'] = "seller/home/home/changePass";
$route['seller/uploadOthersImages'] = "seller/ecommerce/publish/do_upload_others_images";
$route['seller/loadOthersImages'] = "seller/ecommerce/publish/loadOthersImages";
// VENDORS
$route['seller/listvendors'] = "seller/vendors/listvendors";

/*
  | -------------------------------------------------------------------------
  | Sample REST API Routes
  | -------------------------------------------------------------------------
 */
$route['api/products/(\w{2})/get'] = 'Api/Products/all/$1';
$route['api/product/(\w{2})/(:num)/get'] = 'Api/Products/one/$1/$2';
$route['api/product/set'] = 'Api/Products/set';
$route['api/product/(\w{2})/delete'] = 'Api/Products/productDel/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
