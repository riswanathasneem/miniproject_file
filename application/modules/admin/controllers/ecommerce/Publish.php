<?php

/*
 * @Author:    Hazitech
 *  Gitgub:    ""
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Publish extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Products_model',
            'Languages_model',
            'Brands_model',
            'Categories_model'
        ));
    }

    public function index($id = 0)
    {
        $this->login_check();
        $is_update = false;
        $trans_load = null;
        if ($id > 0 && $_POST == null) {
            $_POST = $this->Products_model->getOneProduct($id);
            $trans_load = $this->Products_model->getTranslations($id);
        }
        if (isset($_POST['submit'])) {
            if (isset($_GET['to_lang'])) {
                $id = 0;
            }
            $_POST['image'] = $this->uploadImage();
            $this->Products_model->setProduct($_POST, $id);
            $this->session->set_flashdata('result_publish', 'Product is published!');
            if ($id == 0) {
                $this->saveHistory('Success published product');
            } else {
                $this->saveHistory('Success updated product');
            }
            if (isset($_SESSION['filter']) && $id > 0) {
                $get = '';
                foreach ($_SESSION['filter'] as $key => $value) {
                    $get .= trim($key) . '=' . trim($value) . '&';
                }
                redirect(base_url('admin/products?' . $get));
            } else {
                redirect('admin/products');
            }
        }
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Publish Product';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['id'] = $id;
        $data['trans_load'] = $trans_load;
        $data['languages'] = $this->Languages_model->getLanguages();
        $data['shop_categories'] = $this->Categories_model->getShopCategories();
        $data['brands'] = $this->Brands_model->getBrands();
        $data['otherImgs'] = $this->loadOthersImages();
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/publish', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to publish product');
    }

    private function uploadImage()
    {
        $config['upload_path'] = './attachments/shop_images/';
        $config['allowed_types'] = $this->allowed_img_types;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('userfile')) {
            log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
        }
        $img = $this->upload->data();
        return $img['file_name'];
    }

    /*
     * called from ajax
     */

     public function do_upload_others_images()
     {
         if ($this->input->is_ajax_request()) {
             $upath = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
             if (!file_exists($upath)) {
                 mkdir($upath, 0777, true);
             }
     
             $this->load->library('upload');
     
             $files = $_FILES;
             $cpt = count($_FILES['others']['name']);
             $allowed_img_types = 'gif|jpg|png|jpeg|JPG|PNG|JPEG|webp';
             $allowed_video_types = 'mp4|avi|mov|3gp|mpeg';
             $allowed_types = $allowed_img_types . '|' . $allowed_video_types;
     
             for ($i = 0; $i < $cpt; $i++) {
                 unset($_FILES);
                 $_FILES['others']['name'] = $files['others']['name'][$i];
                 $_FILES['others']['type'] = $files['others']['type'][$i];
                 $_FILES['others']['tmp_name'] = $files['others']['tmp_name'][$i];
                 $_FILES['others']['error'] = $files['others']['error'][$i];
                 $_FILES['others']['size'] = $files['others']['size'][$i];
     
                 $file_extension = pathinfo($_FILES['others']['name'], PATHINFO_EXTENSION);
     
                       // Generate thumbnail if the file is a video
                       if (in_array($file_extension, explode('|', $allowed_video_types))) {
                        $this->upload->initialize(array(
                            'upload_path' => $upath,
                            'allowed_types' => $allowed_video_types,
                            'max_size' => '50000' // 50MB size limit
                        ));
                        if ($this->upload->do_upload('others')) {
                            // Get the uploaded video file path
                            $uploaded_video_path = $upath . $this->upload->data('file_name');
        
                            
                            // Generate video thumbnail using FFmpeg
                 
                        }
                    } else {
                        $this->upload->initialize(array(
                            'upload_path' => $upath,
                            'allowed_types' => $allowed_img_types
                        ));
                        $this->upload->do_upload('others');
                    }
                
             }
         }
     }


     public function loadOthersImages()
     {
         $output = '';
         if (isset($_POST['folder']) && $_POST['folder'] != null) {
             $dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
             if (is_dir($dir)) {
                 if ($dh = opendir($dir)) {
                     $i = 0;
                     while (($file = readdir($dh)) !== false) {
                         if (is_file($dir . $file)) {
                             // Check file extension to determine if it's a video
                             $file_extension = pathinfo($dir . $file, PATHINFO_EXTENSION);
                             if (in_array($file_extension, ['mp4', 'avi', 'mov', 'wmv', 'mpeg'])) {
                                 // Video file
                                 $output .= '
                                     <div class="other-img" id="image-container-' . $i . '" style="clear:both;">
                                         <video width="100" height="100" controls>
                                             <source src="' . base_url('attachments/shop_images/' . htmlspecialchars($_POST['folder']) . '/' . $file) . '" type="video/mp4">
                                             Your browser does not support the video tag.
                                         </video>
                                         <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\', \'' . htmlspecialchars($_POST['folder']) . '\', ' . $i . ')">
                                             <span class="glyphicon glyphicon-remove"></span>
                                         </a>
                                     </div>
                                    ';
                             } else {
                                 // Image file
                                 $output .= '
                                     <div class="other-img" id="image-container-' . $i . '" style="float:left; margin-right:10px;">
                                         <img src="' . base_url('attachments/shop_images/' . htmlspecialchars($_POST['folder']) . '/' . $file) . '" style="width:100px; height: 100px;">
                                         <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\', \'' . htmlspecialchars($_POST['folder']) . '\', ' . $i . ')">
                                             <span class="glyphicon glyphicon-remove"></span>
                                         </a>
                                     </div>
                                    ';
                             }
                         }
                         $i++;
                     }
                     closedir($dh);
                 }
             }
         }
         if ($this->input->is_ajax_request()) {
             echo $output;
         } else {
             return $output;
         }
     }
     

    /*
     * called from ajax
     */
    public function removeSecondaryImage() {
        if ($this->input->is_ajax_request()) {
            $basePath = realpath('.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR);
    
            $folder = realpath($basePath . DIRECTORY_SEPARATOR . $_POST['folder']);
            $image = $_POST['image'];
    
            if ($folder !== false && strpos($folder, $basePath) === 0 && is_file($folder . DIRECTORY_SEPARATOR . $image)) {
                unlink($folder . DIRECTORY_SEPARATOR . $image);
            }
        }
    }
}
