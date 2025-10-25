<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Public_model');
    }

    public function index($id=0)
    {
        $page = 0;
        $data = array();
        $head = array();
        $arrSeo = $this->Public_model->getSeo('shoppingcart');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $all_categories = $this->Public_model->getShopCategories();
        $data['products'] = $this->Public_model->getProducts(10, $page, $id);
        //print_r($this->db->last_query());
        $head['home_categories'] = $this->getHomeCategories($all_categories);
        $this->render('category', $head, $data);
    }
    
    private function getHomeCategories($categories)
    {

        /*
         * Tree Builder for categories menu
         */

        function buildTree(array $elements, $parentId = 0)
        {
            $branch = array();
            foreach ($elements as $element) {
                if ($element['sub_for'] == $parentId) {
                    $children = buildTree($elements, $element['id']);
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }
            return $branch;
        }

        return buildTree($categories);
    }

}
