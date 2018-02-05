<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_model extends CI_Model
{

public $table = 'comments'; //Имя таблицы
public $idkey = 'comment_id'; //Имя ID

//правила для добавления комментариев
public $add_rules = array
(
    array
    (
      'field' => 'parent_id',
      'label' => 'Parent ID',
      'rules' => 'trim|required|xss_clean'
    ),
    array
    (
      'field' => 'author',
      'label' => 'Имя',
      'rules' => 'trim|required|xss_clean|max_length[70]'
    ),
    array
    (
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'trim|required|valid_email|xss_clean|max_length[70]'
    ),
    array
    (
      'field' => 'comment_text',
      'label' => 'Текст комментария',
      'rules' => 'required|xss_clean|max_length[5000]'
    ),
    /*
    array
    (
     'field' => 'rating',
     'label' => 'Рейтинг',
     'rules' => 'required|numeric|xss_clean|exact_length[1]'
    ),
    */
    array
    (
     'field' => 'captcha',
     'label' => 'Цифры с картинки',
     'rules' => 'required|numeric|exact_length[6]'
    )
);

//правила для редактирования комментариев
public $edit_rules = array
(
    array
    (
      'field' => 'name',
      'label' => 'ID',
      'rules' => 'trim|required|integer|xss_clean|max_length[11]'
    ),
    array
    (
      'field' => 'value',
      'label' => 'Имя',
      'rules' => 'required|xss_clean|max_length[5000]'
    )
);

function get_comments($parent = 0, $limit = false)
{
	$this->db->select('comments.*,
		users.image as image,
		'
		);
	$this->db->order_by('date', 'DESC');

    if($limit)
	{
		$this->db->limit($limit);
	}

	$this->db->where('parent_id', $parent);
    $this->db->where('active', 1);
	$this->db->join('users', 'comments.uid = users.id', 'LEFT');
	$result = $this->db->get('comments')->result();

	$return	= array();
	foreach($result as $comment)
	{
		$return[$comment->comment_id]				= $comment;
		$return[$comment->comment_id]->children	    = $this->get_comments($comment->comment_id);
	}

	return $return;
}

function get_comment($id)
{
	return $this->db->where('comment_id',$id)->get('comments')->row();
}

public function get_by($id, $parent = 0)
{
	$this->db->select('comments.*,
		users.image as image,
		'
		);
    $this->db->order_by ('date','desc');
    $this->db->where('parent_id', $parent);
    $this->db->where('foreign_id',$id);
    $this->db->where('active',1);
	$this->db->join('users', 'comments.uid = users.id', 'LEFT');
    $result = $this->db->get('comments')->result();

   	$return	= array();
	foreach($result as $comment)
	{
		$return[$comment->comment_id]				= $comment;
		$return[$comment->comment_id]->children	    = $this->get_comments($comment->comment_id);
	}

	return $return;
}


public function get_latest()
{
    $this->db->order_by('comment_id','desc');
    $this->db->limit(5);
    $query = $this->db->get('comments');
    return $query->result_array();//Возвращаем массив со свежими комментариями
}


public function add_new($comment_data)
{
    $this->db->trans_start();
    $this->db->insert('comments',$comment_data);
    $insert_id = $this->db->insert_id();
    $this->db->trans_complete();
    return  $insert_id;
}


public function get_all($limit,$start_from)
{
    $this->db->order_by('comment_id','desc');

    //ограничиваем запрос к базе двумя параметрами
    $this->db->limit($limit,$start_from);
    $query = $this->db->get('comments');

    //Возвращаем массив со всеми комментариями, урезанный в соответствии      с разбивкой pagination
    return $query->result_array();
}

function save($data)
{
    if($data['comment_id'])
	{
		$this->db->where('comment_id', $data['comment_id']);
		$this->db->update('comments', $data);
		return $data['comment_id'];
	}
	else
	{
		$this->db->insert('comments', $data);
		return $this->db->insert_id();
	}
}

function delete($id)
{

	$comment	= $this->get_comment($id);
	if ($comment)
	{
		$this->db->where('comment_id', $id);
		$this->db->delete('comments');

		return 'Комментарий "'.$comment->comment_text.'" был удален.';
	}
	else
	{
		return 'Комментарий не найден.';
	}
}


}
?>