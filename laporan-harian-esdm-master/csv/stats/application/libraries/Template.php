<?php
	class Template {
		protected $_ci;

		function __construct() {
			$this->_ci = &get_instance(); //Untuk Memanggil function load, dll dari CI. ex: $this->load, $this->model, dll
		}

		function views($template = NULL, $data = NULL) {
			if ($template != NULL) {
				// head
				$data['_meta'] 					= $this->_ci->load->view('Admin/_layout/_meta', $data, TRUE);
				$data['_css'] 					= $this->_ci->load->view('Admin/_layout/_css', $data, TRUE);
				
				// Header
				$data['_nav'] 					= $this->_ci->load->view('Admin/_layout/_nav', $data, TRUE);
				$data['_header'] 				= $this->_ci->load->view('Admin/_layout/_header', $data, TRUE);
				
				//Sidebar
				//$data['_sidebar_admin_approval']	= $this->_ci->load->view('Admin/_layout/_sidebar_admin_approval', $data, TRUE);
				//$data['_sidebar_eval_eselon']		= $this->_ci->load->view('Admin/_layout/_sidebar_eval_eselon', $data, TRUE);
				//$data['_sidebar_investor'] 		= $this->_ci->load->view('Admin/_layout/_sidebar_investor', $data, TRUE);
				$data['status'] = $this->_ci->session->userdata('status_user');
				$data['side_menu'] = role_side_menu();
				$data['_sidebar_super_admin'] 		= $this->_ci->load->view('Admin/_layout/_sidebar_super_admin', $data, TRUE);
				
				//Content
				$data['_headerContent'] 		= $this->_ci->load->view('Admin/_layout/_headerContent', $data, TRUE);
				$data['_mainContent'] 			= $this->_ci->load->view($template, $data, TRUE);
				$data['_content'] 				= $this->_ci->load->view('Admin/_layout/_content', $data, TRUE);
				
				//Footer
				$data['_footer'] 				= $this->_ci->load->view('Admin/_layout/_footer', $data, TRUE);
				
				//JS
				$data['_js'] 					= $this->_ci->load->view('Admin/_layout/_js', $data, TRUE);

				echo $data['_template'] 		= $this->_ci->load->view('Admin/_layout/_template', $data, TRUE);
			}
		}
	}
?>