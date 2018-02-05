<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed!');

class Sitemap extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
    }
    
    function index(){
        header("Content-Type: text/xml;charset=utf8");
        echo '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        echo  "
                <url>
                <loc>".base_url()."</loc>
                <changefreq>daily</changefreq>
                <priority>1</priority>
                </url>
                ";
        
        echo  "
                <url>
                <loc>".base_url('ua')."</loc>
                <changefreq>daily</changefreq>
                <priority>1</priority>
                </url>
                ";
        
        echo  "
                <url>
                <loc>".base_url('en')."</loc>
                <changefreq>daily</changefreq>
                <priority>1</priority>
                </url>
                ";
 
        
        $pages_ru = $this->db->select('pages.url as url')
                                 ->from('pages')
                                 ->join('content', 'content.fid = pages.page_id')
                                 ->where('content.table','pages')
                                 ->where('content.language','ru')
                                 ->where('url !=', 'index')
                                 ->order_by('pages.page_id','asc')
                                 ->get();
        
        foreach ($pages_ru->result() as $page_ru){
 
            echo  "
                <url>
                <loc>".base_url($page_ru->url)."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
                </url>
                ";
                
        }
        
        $pages_ua = $this->db->select('pages.url as url')
                                 ->from('pages')
                                 ->join('content', 'content.fid = pages.page_id')
                                 ->where('content.table','pages')
                                 ->where('content.language','ua')
                                 ->where('url !=', 'index')
                                 ->order_by('pages.page_id','asc')
                                 ->get();
        
        foreach ($pages_ua->result() as $page_ua){
 
            echo  "
                <url>
                <loc>".base_url('ua/'.$page_ua->url)."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
                </url>
                ";
                
        }
        
        $pages_en = $this->db->select('pages.url as url')
                                 ->from('pages')
                                 ->join('content', 'content.fid = pages.page_id')
                                 ->where('content.table','pages')
                                 ->where('content.language','en')
                                 ->where('url !=', 'index')
                                 ->order_by('pages.page_id','asc')
                                 ->get();
        
        foreach ($pages_en->result() as $page_en){
 
            echo  "
                <url>
                <loc>".base_url('en/'.$page_en->url)."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
                </url>
                ";
                 
        }
        
        $sections_ru = $this->db->select('sections.url as url')
                                 ->from('sections')
                                 ->join('content', 'content.fid = sections.section_id')
                                 ->where('show',1)
                                 ->where('content.table','sections')
                                 ->where('content.language','ru')
                                 ->order_by('sections.section_id','desc')
                                 ->get();
        
        foreach ($sections_ru->result() as $section_ru){
 
            echo  "
                <url>
                <loc>".base_url($section_ru->url)."</loc>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
                </url>
                ";
                
        }
        
        $sections_ua = $this->db->select('sections.url as url')
                                 ->from('sections')
                                 ->join('content', 'content.fid = sections.section_id')
                                 ->where('show',1)
                                 ->where('content.table','sections')
                                 ->where('content.language','ua')
                                 ->order_by('sections.section_id','desc')
                                 ->get();
        
        foreach ($sections_ua->result() as $section_ua){
 
            echo  "
                <url>
                <loc>".base_url('ua/'.$section_ua->url)."</loc>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
                </url>
                ";
                
        }
        
        $sections_en = $this->db->select('sections.url as url')
                                 ->from('sections')
                                 ->join('content', 'content.fid = sections.section_id')
                                 ->where('show',1)
                                 ->where('content.table','sections')
                                 ->where('content.language','en')
                                 ->order_by('sections.section_id','desc')
                                 ->get();
        
        foreach ($sections_en->result() as $section_en){
 
            echo  "
                <url>
                <loc>".base_url('en/'.$section_en->url)."</loc>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
                </url>
                ";
                
        }
        
        $materials_ru = $this->db->select('materials.url as url')
                                 ->from('materials')
                                 ->join('content', 'content.fid = materials.material_id')
                                 ->where('show',1)
                                 ->where('content.table','materials')
                                 ->where('content.language','ru')
                                 ->order_by('materials.date','desc')
                                 ->order_by('materials.material_id','desc')
                                 ->get();
        
        foreach ($materials_ru->result() as $material_ru){
 
            echo  "
                <url>
                <loc>".base_url($material_ru->url)."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.7</priority>
                </url>
                ";
                
        }
        
        $materials_ua = $this->db->select('materials.url as url')
                                 ->from('materials')
                                 ->join('content', 'content.fid = materials.material_id')
                                 ->where('show',1)
                                 ->where('content.table','materials')
                                 ->where('content.language','ua')
                                 ->order_by('materials.date','desc')
                                 ->order_by('materials.material_id','desc')
                                 ->get();
        
        foreach ($materials_ua->result() as $material_ua){
 
            echo  "
                <url>
                <loc>".base_url('ua/'.$material_ua->url)."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.7</priority>
                </url>
                ";
                
        }
        
        $materials_en = $this->db->select('materials.url as url')
                                 ->from('materials')
                                 ->join('content', 'content.fid = materials.material_id')
                                 ->where('show',1)
                                 ->where('content.table','materials')
                                 ->where('content.language','en')
                                 ->order_by('materials.date','desc')
                                 ->order_by('materials.material_id','desc')
                                 ->get();
        
        foreach ($materials_en->result() as $material_en){
 
            echo  "
                <url>
                <loc>".base_url('en/'.$material_en->url)."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.7</priority>
                </url>
                ";
                
        }
        
        
        echo "</urlset>";
        
    }
}

?>