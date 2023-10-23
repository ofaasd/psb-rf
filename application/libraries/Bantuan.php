<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Bantuan {

    function __construct()
        {
            $this->ci =& get_instance();
            //load libraries
            $this->ci->load->library('session');
            $this->ci->load->database();
            // spl_autoload_register( array( $this, 'autoload') );
        }
    public function wrap_words($string, $word_limit) {
        $words = explode(" ", $string);
        return implode(" ", array_splice($words, 0, $word_limit));
    }

    public function dash_words($string)
    {
      return str_replace(" ","-",$string);
    }

    public function slash_words($string)
    {
      return str_replace("-", "/", $string);
    }

    public function getBulan($bln){
                switch ($bln){
                    case 1: 
                        return "January";
                        break;
                    case 2:
                        return "February";
                        break;
                    case 3:
                        return "March";
                        break;
                    case 4:
                        return "April";
                        break;
                    case 5:
                        return "May";
                        break;
                    case 6:
                        return "June";
                        break;
                    case 7:
                        return "July";
                        break;
                    case 8:
                        return "August";
                        break;
                    case 9:
                        return "September";
                        break;
                    case 10:
                        return "October";
                        break;
                    case 11:
                        return "November";
                        break;
                    case 12:
                        return "December";
                        break;
                }
            }
            
            public function datetr($tgl){
                $tanggal = substr($tgl,8,2);
                $bulan = $this->getBulan(substr($tgl,5,2));
                $tahun = substr($tgl,0,4);
                return $tanggal.' '.$bulan.' '.$tahun;       
            } 

            public function datetostring($days)
            {
                $year = $days/365;
                $rem = $days%365;
                $mos = $rem/30;
                $dys = $rem%30;
                $string = (int)$year." yrs ".(int)$mos." mos ".$dys." dys";
                return $string;
            } 
            public function jam($id){
                $CI =& get_instance();
                $rs = $CI->db->get_where('master_jam', array('id' => $id));
                if ($rs->num_rows() > 0) {
                    $r = $rs->row()->nama_sesi;
                }else{
                    $r = '-- Pilih Sesi --';
                }
                return $r;
            } 
            public function pilihan_prodi($id = ''){
                $CI =& get_instance();
                $rs = $CI->db->get_where('program_studi', array('id' => $id));
                if ($rs->num_rows() > 0) {
                    $r = $rs->row()->nama_jurusan;
                }else{
                    $r = '-';
                }
                return $r;
            }
    public function nmutu($nilai=''){
        $val = 'E';
        if (($nilai >= 85 ) && ($nilai <= 100)) {
            $val = 'A';
        }elseif (($nilai >= 79) && ($nilai < 85)) {
            $val = 'AB';
        }elseif (($nilai >= 73) && ($nilai < 79)) {
            $val = 'B';
        }elseif (($nilai >= 67) && ($nilai < 73)) {
            $val = 'BC';
        }elseif (($nilai >= 61) && ($nilai < 67)) {
            $val = 'C';
        }elseif (($nilai >= 55) && ($nilai < 61)) {
            $val = 'CD';
        }elseif (($nilai >= 45) && ($nilai < 55)) {
            $val = 'D';
        }else{
            $val = 'E';
        }
        return $val;
    }
    public function nbobot($nilai=''){
        $val = 0;
        if ($nilai == 'A') {
            $val = 4;
        }elseif ($nilai == 'AB') {
            $val = 3.5;
        }elseif ($nilai == 'B'){
            $val = 3;
        }elseif ($nilai == 'BC') {
            $val = 2.5;
        }elseif ($nilai == 'C') {
            $val = 2;
        }elseif ($nilai == 'CD') {
            $val = 1.5;
        }elseif ($nilai == 'D') {
            $val = 1;
        }elseif ($nilai == 'E') {
            // code...
            $val = 0;
        }
        return $val;
    }
    public function sksbatas($ips = ''){
        $val = 12;
        if (($ips >= 3.51) && ($ips <= 4)) {
            $val = 24;
        }elseif (($ips >= 2.51) && ($ips <= 3.5)) {
            $val = 22;
        }elseif (($ips >= 2) && ($ips <= 2.5)) {
            $val = 20;
        }elseif (($ips >= 1.51) && ($ips <= 1.99)) {
            $val = 16;
        }elseif ($ips <= 1.50) {
            $val = 12;
        }
        return $val;
    }
}

/* End of file Someclass.php */