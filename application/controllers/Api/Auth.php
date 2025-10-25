<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Auth extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->methods['register_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['login_post']['limit'] = 200; // 200 requests per hour per user/key
        $this->load->model('Public_model');
    }

    /*
     * User Registration
     */
    public function register_post()
    {
        $errors = [];
        $username = $this->post('username');
        $email = $this->post('email');
        $password = $this->post('password');
        $confirm_password = $this->post('confirm_password');
        $user_type = $this->post('user_type');

        // Validate username
        if (empty($username)) {
            $errors[] = 'Username is required';
        } elseif (strlen($username) < 3) {
            $errors[] = 'Username must be at least 3 characters long';
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $errors[] = 'Username can only contain letters, numbers, and underscores';
        } else {
            // Check if username already exists
            $this->db->where('username', $username);
            $existing_user = $this->db->get('users')->row();
            if ($existing_user) {
                $errors[] = 'Username is already taken';
            }
        }

        // Validate email
        if (empty($email)) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address';
        } else {
            // Check if email already exists
            $this->db->where('email', $email);
            $existing_email = $this->db->get('users')->row();
            if ($existing_email) {
                $errors[] = 'Email is already registered';
            }
        }

        // Validate password
        if (empty($password)) {
            $errors[] = 'Password is required';
        } elseif (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters long';
        }

        // Validate confirm password
        if (empty($confirm_password)) {
            $errors[] = 'Please confirm your password';
        } elseif ($password !== $confirm_password) {
            $errors[] = 'Passwords do not match';
        }

        // Validate user type
        if (empty($user_type)) {
            $errors[] = 'Please select a user type';
        } elseif (!in_array($user_type, ['customer', 'seller', 'delivery_agent'])) {
            $errors[] = 'Invalid user type selected';
        }

        if (!empty($errors)) {
            $this->response([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $errors
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        // Prepare user data
        $user_data = [
            'username' => $username,
            'email' => $email,
            'password' => md5($password), // Using MD5 to match existing system
            'user_type' => $user_type,
            'notify' => 0,
            'last_login' => null
        ];

        // Insert user into database
        $this->db->insert('users', $user_data);
        $user_id = $this->db->insert_id();

        if ($user_id) {
            $this->response([
                'status' => true,
                'message' => 'Registration successful',
                'user_id' => $user_id,
                'data' => [
                    'username' => $username,
                    'email' => $email,
                    'user_type' => $user_type
                ]
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Registration failed. Please try again.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * User Login
     */
    public function login_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');
        $remember_me = $this->post('remember_me', false);
    
        $errors = [];
    
        // Validate email
        if (empty($email)) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address';
        }
    
        // Validate password
        if (empty($password)) {
            $errors[] = 'Password is required';
        }
    
        if (!empty($errors)) {
            $this->response([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $errors
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
    
        // Check user credentials and type
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $this->db->where('user_type', 'customer'); // ✅ Restrict to customers only
        $user = $this->db->get('users')->row();
    
        if ($user) {
            // Update last login
            $this->db->where('id', $user->id);
            $this->db->update('users', ['last_login' => time()]);
    
            // Set session (if needed)
            $_SESSION['logged_user'] = $user->id;
    
            $this->response([
                'status' => true,
                'message' => 'Login successful',
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'user_type' => $user->user_type
                ]
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Invalid email, password, or user type'
            ], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
    

    /*
     * Check if username exists
     */
    public function check_username_get($username)
    {
        $this->db->where('username', $username);
        $user = $this->db->get('users')->row();

        $this->response([
            'exists' => $user ? true : false
        ], REST_Controller::HTTP_OK);
    }

    /*
     * Check if email exists
     */
    public function check_email_get($email)
    {
        $this->db->where('email', $email);
        $user = $this->db->get('users')->row();

        $this->response([
            'exists' => $user ? true : false
        ], REST_Controller::HTTP_OK);
    }

    /*
     * User Logout
     */
    public function logout_post()
    {
        // Clear session
        if (isset($_SESSION['logged_user'])) {
            unset($_SESSION['logged_user']);
        }
        
        // Destroy session if needed
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }

        $this->response([
            'status' => true,
            'message' => 'Logout successful'
        ], REST_Controller::HTTP_OK);
    }

    /*
     * Check current session status
     */
    public function session_get()
    {
        if (isset($_SESSION['logged_user']) && !empty($_SESSION['logged_user'])) {
            // Get user details
            $this->db->where('id', $_SESSION['logged_user']);
            $user = $this->db->get('users')->row();
            
            if ($user) {
                $this->response([
                    'logged_in' => true,
                    'user' => [
                        'id' => $user->id,
                        'username' => $user->username,
                        'email' => $user->email,
                        'user_type' => isset($user->user_type) ? $user->user_type : 'customer'
                    ]
                ], REST_Controller::HTTP_OK);
            } else {
                // User not found, clear session
                unset($_SESSION['logged_user']);
                $this->response([
                    'logged_in' => false
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $this->response([
                'logged_in' => false
            ], REST_Controller::HTTP_OK);
        }
    }
}
