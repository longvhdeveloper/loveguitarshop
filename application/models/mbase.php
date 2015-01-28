<?php
class Mbase extends CI_Model
{
    protected $baseDir;
    public function __construct()
    {
        parent::__construct();
        $this->baseDir = $_SERVER['DOCUMENT_ROOT'];
    }
}