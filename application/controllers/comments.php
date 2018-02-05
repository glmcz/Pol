<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('materials_model','comments_model','pages_model'));
        $this->load->library(array('captcha_lib'));
	}

    public function index()
	{
		redirect(base_url());
	}

    public function add_comment($id = '')
    {

        $this->load->helper('date');
        $this->load->library(array('form_validation','table','typography'));

        if ( ! isset($_POST['post_comment']))
        {
            echo json_encode(array('err' => 1, 'content' => 'Přišli jste do souboru přímo bez stisknutí tlačítka "komentář"'));

            die;
        }

        else
        {
            $id       = force_int($id);
			$material = $this->materials_model->get($id);
			$content  = $this->materials_model->get_content($id, LANGUAGE);
            
            $this->form_validation->set_rules($this->comments_model->add_rules);

            $val_res = $this->form_validation->run();

            if ($val_res == TRUE)
            {
                 $entered_captcha = $this->input->post('captcha');

                 if ($entered_captcha == $this->session->userdata('rnd_captcha'))
                 {
                      $this->load->library('email');
                      
                      $title  = $content['title'];
                      $anchor = anchor(base_url($material['url']), $title);
                      
                      $comment_text = $this->input->post('comment_text');
                      $comment_text = $this->typography->auto_typography($comment_text,TRUE);

                      $comment_data = array();

                      $comment_data['foreign_id']   = $id;
                      $comment_data['parent_id']    = $this->input->post('parent_id', TRUE);
                      $comment_data['author']       = $this->session->userdata('DX_username')? $this->session->userdata('DX_username') : $this->input->post('author', TRUE);
                      $comment_data['email']        = $this->session->userdata('DX_email') ? $this->session->userdata('DX_email') : $this->input->post('email', TRUE);
                      $comment_data['comment_text'] = $comment_text;
                      $comment_data['date']         = date('Y-m-d H:i:s');
					  if ($this->session->userdata('DX_user_id') && $this->session->userdata('DX_user_id') > 0){
						  $comment_data['uid']      = $this->session->userdata('DX_user_id');
					  }
                      //$comment_data['rating']       = $this->input->post('rating');

                      $comment_id = $this->comments_model->add_new($comment_data);

                      $author  = $this->input->post('author');
                      $email   = $this->input->post('email');
                      //$rating  = $this->input->post('rating');

                      $comment_text = wordwrap($comment_text,70);
                      $comment_text = strip_tags($comment_text);

                      $address = EMAIL_1;
                      $subject = "Komentář k článku s místě Polahoda.cz";
                      $message = '<p><b>Napsal(a):</b> '.$author.'<br /><b>Email:</b> '.$email.'<br /><b>Komentář:</b><br />'.$comment_text.'<br /><p>Odkaz:</p> '.$anchor.'</p>'; 
                      
                      $this->email->clear();
                      $this->email->set_mailtype("html");
                      $this->email->from('info@polahoda.cz', SITE_NAME);
                      $this->email->to($address);
                      $this->email->subject($subject);
                      $this->email->message($message);
                      $this->email->send();
                      
            	      mail ($address,$subject,$message,"Content-type:text/plain;charset = UTF-8\r\n");
                      
                      if (isset($comment_data['parent_id']) && $comment_data['parent_id'] != 0) {
                            
                        $this->email->clear();
                        // Смотрим родительский коммент
                        $parent_comment = $this->comments_model->get_comment($comment_data['parent_id']);
                        
                        $parent_subject = 'Na váš komentář k článku "'.$title.'" přišla odpověď (webové stránky '.SITE_NAME.')';
                        $parent_author  = $parent_comment->author;
                        $parent_address = $parent_comment->email;
                        $parent_text    = strip_tags($parent_comment->comment_text);
                        $parent_message = '<p><b>Napsal(a):</b> '.$author.'<br /><b>Email:</b> '.$email.'<br /><b>Komentář:</b><br />'.$comment_text.'<br /><p>Odkaz:</p> '.$anchor.'</p>'; 
                        
                        $this->email->set_mailtype("html");
                        $this->email->from('info@polahoda.cz', SITE_NAME);
                        $this->email->to($parent_address);
                        $this->email->subject($parent_subject);
                        $this->email->message($parent_message);
                        $this->email->send();
                        
                      }

                      $data['imgcode']  = $this->captcha_lib->captcha_actions();

                      $new_comment = "<a href='#' class='pull-left'><img alt='' src='http://polahoda.cz/assets/img/commentator.jpg' class='media-object' /></a><div class='media-body'><h4 id=".$comment_id." class='media-heading'>$author <span>$comment_data[date] / <a id=".$comment_id." class='reply' title=".$comment_data['author'] ." href='#'>Odpověď</a></span></h4><p></p><p>$comment_text</p><p></p><hr></div>";

                      echo json_encode(array('err' => 0, 'content' => 'Děkuji za váš komentář!', 'new_comment' => $new_comment, 'captcha' => $data['imgcode']));

                      die;

                 }

                 // Если капча не совпадает
                 else
                 {
                      //получаем код капчи
                      $data['imgcode']  = $this->captcha_lib->captcha_actions();

                      echo json_encode(array('err' => 1, 'content' => 'Chybné zadané znaky z obrázku.', 'captcha' => $data['imgcode']));

                      die;
                 }
            }

            //Если валидация не пройдена
            else
            {
                //получаем код капчи
                $data['imgcode']  = $this->captcha_lib->captcha_actions();

                echo json_encode(array('err' => 1, 'content' => 'Zkontrolujte správnost vyplnění formuláře.', 'captcha' => $data['imgcode']));

                die;
            }
        }
    }
    
    public function edit_comment($id = '')
    {
        $this->load->library(array('form_validation','table','typography'));
        
        //var_dump($_POST);

        if ( ! isset($_POST['pk']))
        {
            echo json_encode(array('status' => 'error', 'msg' => 'Přišli jste do souboru přímo bez stisknutí tlačítka "komentář"'));

            die;
        }

        else
        {

            $this->form_validation->set_rules($this->comments_model->edit_rules);

            $val_res = $this->form_validation->run();

            if ($val_res == TRUE)
            {
                $comment_id     = $this->input->post('name');
                $comment_text   = $this->input->post('value');
                
                $comment        = $this->comments_model->get_comment($comment_id);
                
                if(!empty($comment)){
                    
                    $user_id    = $this->session->userdata('DX_user_id');
                    $user_email = $this->session->userdata('DX_email');
                    
                    if($user_id == $comment->uid || $user_email == $comment->email){
                        
                        $comment_data                 = array();
                        $comment_data['comment_id']   = $comment_id;
                        $comment_data['comment_text'] = $comment_text;
                      
                        $comment_id = $this->comments_model->save($comment_data);
        
                        echo json_encode(array('status' => 'success', 'msg' => 'Vše ok!'));
        
                        die;
                            
                    }else{
                        
                        echo json_encode(array('status' => 'error', 'msg' => 'Nemůžete upravovat komentáře ostatních uživatelů!'));
        
                        die;
                        
                    }
                    
                }else{
                    
                    echo json_encode(array('status' => 'error', 'msg' => 'Tento komentář neexistuje!'));
    
                    die;
                    
                }
                
            }
            //Если валидация не пройдена
            else
            {
                
                echo json_encode(array('status' => 'error', 'msg' => 'Došlo k chybě při úpravách svůj komentář!'));

                die;
                
            }
        }
    }
    
    public function delete_comment($comment_id = '')
    {
        $comment_id = abs((int)$comment_id);
        
        if($comment_id >= 0){
            
            $comment        = $this->comments_model->get_comment($comment_id);
            
            if(!empty($comment)){
                
                $user_id    = $this->session->userdata('DX_user_id');
                $user_email = $this->session->userdata('DX_email');
                
                if($user_id == $comment->uid || $user_email == $comment->email){

                    $this->comments_model->delete($comment_id);
    
                    echo json_encode(array('status' => 'success', 'msg' => 'Komentář smazán!'));
    
                    die;
                        
                }else{
                    
                    echo json_encode(array('status' => 'error', 'msg' => 'Nemůžete mazat komentáře ostatních uživatelů!'));
    
                    die;
                    
                }
                
            }else{
                
                echo json_encode(array('status' => 'error', 'msg' => 'Tento komentář neexistuje!'));

                die;
                
            }
            
        }else{
            
            echo json_encode(array('status' => 'error', 'msg' => 'Zadali jste hodnotu komentář nesprávný!'));

            die;
            
        }
        
        
    }

}

/* End of file comments.php */
/* Location: ./application/controllers/comments.php */