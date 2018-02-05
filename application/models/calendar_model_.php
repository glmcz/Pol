<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_model extends FRONT_Crud
{

	function __construct()
	{

		 parent::__construct();

		 $this->conf = array(
			'start_day'         => 'monday',
			'show_next_prev'    => true,
			'next_prev_url'     => base_url().'calendar/'
		 );
		 $this->conf['template'] = '


				{table_open}<div id="calendar" class="cal-context" style="width: 100%;">{/table_open}

				{heading_row_start}<div class="btn-group">{/heading_row_start}

				{heading_previous_cell}<a class="btn btn-primary" id="prev-month" data-calendar-nav="prev" href="{previous_url}"><i class="fa fa-arrow-left"></i></a>{/heading_previous_cell}
				{heading_title_cell}<a class="btn" data-calendar-nav="today">{heading}</a>{/heading_title_cell}
				{heading_next_cell}<a class="btn btn-primary" id="next-month" data-calendar-nav="next" href="{next_url}"><i class="fa fa-arrow-right"></i></a>{/heading_next_cell}

				{heading_row_end}</div>{/heading_row_end}

				{week_row_start}<div class="cal-row-fluid cal-row-head">{/week_row_start}
				{week_day_cell}<div class="cal-cell1 cal-cell">{week_day}</div>{/week_day_cell}
				{week_row_end}</div><div class="cal-month-box">{/week_row_end}

				{cal_row_start}<div class="cal-row-fluid cal-before-eventlist">{/cal_row_start}
				{cal_cell_start}<div class="cal-cell1 cal-cell"><div class="cal-month-day cal-day-inmonth cal-day-weekend">{/cal_cell_start}

				{cal_cell_content}
					<span class="pull-right" data-cal-date="{day}" data-cal-view="day" data-toggle="tooltip" title="" data-original-title="">{day}</span>
					<div class="events-list">
						<a href="'.base_url('calendar').'/{year}/{month}/{day}" data-event-class="event-info" class="pull-left event event-info" data-toggle="tooltip" title="" data-original-title="">{content}</a>
					</div>
				{/cal_cell_content}
				{cal_cell_content_today}
					<span class="pull-right" data-cal-date="{day}" data-cal-view="day" data-toggle="tooltip" title="" data-original-title=""><strong>{day}</strong></span>
					<div class="events-list">
						<a href="'.base_url('calendar').'/{year}/{month}/{day}" data-event-class="event-info" class="pull-left event event-info" data-toggle="tooltip" title="" data-original-title="">{content}</a>
					</div>
				{/cal_cell_content_today}

				{cal_cell_no_content}<span class="pull-right" data-cal-date="{day}" data-cal-view="day" data-toggle="tooltip" title="" data-original-title="">{day}</span>{/cal_cell_no_content}
				{cal_cell_no_content_today}<span class="pull-right" data-cal-date="{day}" data-cal-view="day" data-toggle="tooltip" title="" data-original-title=""><div class="highlight">{day}</div></span>{/cal_cell_no_content_today}

				{cal_cell_blank}&nbsp;{/cal_cell_blank}

				{cal_cell_end}</div></div>{/cal_cell_end}
				{cal_row_end}</div>{/cal_row_end}

				{table_close}</div></div>{/table_close}
			</div>
		 ';

	}

	public function generate_my_calendar($year,$month,$cal_data)
	{
		$this->load->library('calendar',$this->conf);

		return $this->calendar->generate($year,$month,$cal_data);
	}

	public function get_my_calendar_data($year, $month)
	{
		$query = $this->db->select('date')
						  ->order_by('date','asc')
						  ->group_by('DAYOFMONTH(date)')
						  ->like('date', "$year-$month", 'after')
						  ->get('events');

		$cal_data = array();

		foreach ($query->result() as $row) {

			 $num_events_by_day = $this->count_events_by_day($row->date);
			 //that fetched earlier

			 $cal_data[(int)substr($row->date,8,2)] = $num_events_by_day;

		}

		return $cal_data;
	}

	function count_events_by_day($date)
	{
		return $this->db->where('DAYOFMONTH(date)', date('d', strtotime($date)))
						->count_all_results('events');
	}

	public function get_my_calendar_data1($year, $month)
	{
		   $query = $this->db->query("SELECT DISTINCT DATE_FORMAT(date, '%Y-%m-%e') AS date, title, event_id
												FROM events
												WHERE date LIKE '$year-$month%' "); //date format eliminates zeros make
																			   //days look 05 to 5

			$cal_data = array();

			foreach ($query->result() as $row) { //for every date fetch data

				$a = array();
				$i = 0;
				$query2 = $this->db->query("SELECT title, event_id
											FROM events
											WHERE date LIKE DATE_FORMAT('$row->date', '%Y-%m-%d') ");
														//date format change back the date format
														//that fetched earlier
				 foreach ($query2->result() as $r) {
					 $a[$i] = $r->title;     //make data array to put to specific date
					 $i++;
				 }

				 $cal_data[substr($row->date,8,2)] = $a;

			}

			return $cal_data;
	}


	// Получение информации по событиям за конкретный день
	public function archive_by_day($url_day)
	{
		$this->db->like('date',$url_day,'both');
		$this->db->order_by ('date','desc');
		$query = $this->db->get('events');
		return $query->result_array();
	}

	public function get_day_events($year, $month, $day, $language)
	{
        $this->db->select('events.event_id as event_id, events.url as url, events.img_url as img_url, events.video_url as video_url, events.date as date, events.map as map, events.count_views as count_views, content.fid as fid, content.title as title, content.keywords as keywords, content.anons as anons, content.language as language');
        $this->db->from('events');
        $this->db->join('content', 'content.fid = events.event_id');
		$this->db->where("DATE(date)", $year.'-'.$month.'-'.$day);
        $this->db->where('content.table','events'); 
        $this->db->where('content.language',$language); 
		$this->db->order_by("DATE(date)", 'ASC');
//        $this->db->group_by('events.event_id');
		$query = $this->db->get();
//		echo '<pre>'.$this->db->last_query().'</pre>';
		return $query->result_array();
	}

	// Получение списка месяцев из БД
	public function get_events($year, $month)
	{
		$sql = "SELECT DISTINCT left(date,7) AS month FROM events WHERE date BETWEEN '$year-$month-01' AND '$year-$month-31' ORDER BY month ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
?>