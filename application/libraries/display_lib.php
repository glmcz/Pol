<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed!');

class Display_lib
{

	public function __construct()
	{
		$this->ci =& get_instance ();

	}
	
    public function front_welcome_page($data,$name)
    {

        $this->ci->load->view('preheader_view',$data);
        $this->ci->load->view('header_view',$data);
        $this->ci->load->view($name.'_view',$data);
        $this->ci->load->view('footer_view',$data);
    }

    public function front_search($data,$name)
    {

        $this->ci->load->view('preheader_view',$data);
        $this->ci->load->view('header_view',$data);
        $this->ci->load->view($name.'_view',$data);
        $this->ci->load->view('footer_view',$data);
    }

    public function front_page($data,$name)
    {

        $this->ci->load->view('preheader_view',$data);
        $this->ci->load->view('header_view',$data);
        $this->ci->load->view($name.'_view',$data);
        $this->ci->load->view('footer_view',$data);
    }

    public function user_page($data,$name)
    {

        $this->ci->load->view('preheader_view',$data);
        $this->ci->load->view('header_view',$data);
        $this->ci->load->view('left_view',$data);
        $this->ci->load->view($name.'_view',$data);
        $this->ci->load->view('footer_view',$data);
    }
    
    public function user_one_page($data,$name)
    {
        
        $this->ci->load->view($name.'_view',$data); 
    }

    public function user_info_page($data)
    {

        $this->ci->load->view('info_preheader_view');
        $this->ci->load->view('header_view',$data);
        $this->ci->load->view('info_view',$data);
        $this->ci->load->view('footer_view');
    }
    public function auth_page($data, $name)
    {

        $this->ci->load->view('info_preheader_view',$data);
        $this->ci->load->view('header_view',$data);
        $this->ci->load->view('auth/'.$name,$data);
        $this->ci->load->view('footer_view');

    }
    public function admin_page($data,$name)
    {

        $this->ci->load->view('admin/preheader_view',$data);
        $this->ci->load->view('admin/header_view');
        $this->ci->load->view('admin/'.$name.'_view',$data);
        $this->ci->load->view('admin/footer_view');
    }
    public function admin_info_page($data)
    {

        $this->ci->load->view('admin/preheader_view');
        $this->ci->load->view('admin/header_view');
        $this->ci->load->view('admin/info_view',$data);
        $this->ci->load->view('admin/footer_view');
    }
}

?>