<?php

class Slider_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function deleteProduct($id)
    {
       

        $this->db->where('id', $id);
        if (!$this->db->delete('slider')) {
            log_message('error', print_r($this->db->error(), true));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function productsCount($search_title = null, $category = null)
    {
        if ($search_title != null) {
            $search_title = trim($this->db->escape_like_str($search_title));
            $this->db->where("(products_translations.title LIKE '%$search_title%')");
        }
        if ($category != null) {
            $this->db->where('shop_categorie', $category);
        }
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        return $this->db->count_all_results('products');
    }

    public function getProducts($limit, $page, $search_title = null, $orderby = null, $category = null, $vendor = null)
    {
        if ($search_title != null) {
            $search_title = trim($this->db->escape_like_str($search_title));
            $this->db->where("(products_translations.title LIKE '%$search_title%')");
        }
        if ($orderby !== null) {
            $ord = explode('=', $orderby);
            if (isset($ord[0]) && isset($ord[1])) {
                $this->db->order_by('slider.' . $ord[0], $ord[1]);
            }
        } else {
            $this->db->order_by('slider.position', 'asc');
        }
    
 
        $query = $this->db->select('*')->get('slider', $limit, $page);
        return $query->result();
    }

    public function numShopProducts()
    {
        return $this->db->count_all_results('slider');
    }

    public function getOneProduct($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
  
        $query = $this->db->get('slider');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function productStatusChange($id, $to_status)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('slider', array('visibility' => $to_status));
        return $result;
    }

    public function setProduct($post, $id = 0)
    {
       
        if (!isset($post['brand_id'])) {
            $post['brand_id'] = null;
        }
        if (!isset($post['virtual_products'])) {
            $post['virtual_products'] = null;
        }
        $this->db->trans_begin();
       
        $is_update = false;
        if ($id > 0) {
            $is_update = true;
            print_r($post);
            if (!$this->db->where('id', $id)->update('slider', array(
                        'image' => $post['image'] != null ? $_POST['image'] : $_POST['old_image'],
                        'in_slider' => $post['in_slider'],
                        'position' => $post['position'],
                        'time_update' => time()
                    ))) {
                // log_message('error', print_r($this->db->error(), true));
            
            }
        } else {
           // print_r($post);exit;
            /*
             * Lets get what is default tranlsation number
             * in titles and convert it to url
             * We want our plaform public ulrs to be in default 
             * language that we use
             */
        
            if (!$this->db->insert('slider', array(
                        'image' => $post['image'],
                        'in_slider' => $post['in_slider'],
                        'position' => $post['position'],
                        'folder' => $post['folder'],
                        'time' => time()
                    ))) {
                // log_message('error', print_r("kkkkkkkkk", true));
            }
            $id = $this->db->insert_id();

    
        }
        // $this->setProductTranslation($post, $id, $is_update);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            // show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    // private function setProductTranslation($post, $id, $is_update)
    // {
    //     $i = 0;
    //     $current_trans = $this->getTranslations($id);
    //     foreach ($post['translations'] as $abbr) {
    //         $arr = array();
    //         $emergency_insert = false;
    //         if (!isset($current_trans[$abbr])) {
    //             $emergency_insert = true;
    //         }
    //         $post['title'][$i] = str_replace('"', "'", $post['title'][$i]);
    //         $post['price'][$i] = str_replace(' ', '', $post['price'][$i]);
    //         $post['price'][$i] = str_replace(',', '.', $post['price'][$i]);
    //         $post['price'][$i] = preg_replace("/[^0-9,.]/", "", $post['price'][$i]);
    //         $post['old_price'][$i] = str_replace(' ', '', $post['old_price'][$i]);
    //         $post['old_price'][$i] = str_replace(',', '.', $post['old_price'][$i]);
    //         $post['old_price'][$i] = preg_replace("/[^0-9,.]/", "", $post['old_price'][$i]);
    //         $arr = array(
    //             'title' => $post['title'][$i],
    //             'basic_description' => $post['basic_description'][$i],
    //             'description' => $post['description'][$i],
    //             'price' => $post['price'][$i],
    //             'old_price' => $post['old_price'][$i],
    //             'abbr' => $abbr,
    //             'for_id' => $id
    //         );
    //         if ($is_update === true && $emergency_insert === false) {
    //             $abbr = $arr['abbr'];
    //             unset($arr['for_id'], $arr['abbr'], $arr['url']);
    //             if (!$this->db->where('abbr', $abbr)->where('for_id', $id)->update('products_translations', $arr)) {
    //                 log_message('error', print_r($this->db->error(), true));
    //             }
    //         } else {
    //             if (!$this->db->insert('products_translations', $arr)) {
    //                 log_message('error', print_r($this->db->error(), true));
    //             }
    //         }
    //         $i++;
    //     }
    // }

    // public function getTranslations($id)
    // {
    //     $this->db->where('for_id', $id);
    //     $query = $this->db->get('products_translations');
    //     $arr = array();
    //     foreach ($query->result() as $row) {
    //         $arr[$row->abbr]['title'] = $row->title;
    //         $arr[$row->abbr]['basic_description'] = $row->basic_description;
    //         $arr[$row->abbr]['description'] = $row->description;
    //         $arr[$row->abbr]['price'] = $row->price;
    //         $arr[$row->abbr]['old_price'] = $row->old_price;
    //     }
    //     return $arr;
    // }

}
