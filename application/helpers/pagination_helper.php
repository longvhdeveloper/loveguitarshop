<?php
function create_pagination($total, $recordPerpage, $uriSegemnt, $baseUrl)
{
    $ci =& get_instance();
    //load pagination library
    $ci->load->library('pagination');
    $config['base_url'] = $baseUrl;
    $config['total_rows'] = $total;
    $config['per_page'] = $recordPerpage;
    $config['uri_segment'] = $uriSegemnt;

    $config['full_tag_open'] = '<div><ul class="pagination pagination-sm">';
    $config['full_tag_close'] = '</ul></nav>';
    $config['next_link'] = ' <i class="fa fa-arrow-right"></i>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '<i class="fa fa-arrow-left"></i>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '<li>';

    $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0)">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $ci->pagination->initialize($config);

    return $ci->pagination->create_links();
}