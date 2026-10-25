<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Compat_check extends CI_Controller
{
    public function index()
    {
        if (!is_cli()) { show_404(); return; }
        $this->load->helper(array('url','form','security','text','string'));
        $this->load->library(array('form_validation','parser','pagination','upload','user_agent'));
        $this->config->set_item('encryption_key', str_repeat('test-key',4));
        if (extension_loaded('openssl')) {
            $this->load->library('encryption');
            $value = $this->encryption->encrypt('ci3-php8-check');
            if ($this->encryption->decrypt($value) !== 'ci3-php8-check') throw new RuntimeException('Encryption roundtrip failed.');
        }
        if ($this->parser->parse_string('Hello {name}',array('name'=>'CI3'),true) !== 'Hello CI3') throw new RuntimeException('Template parser failed.');
        if (html_escape('<test>') !== '&lt;test&gt;') throw new RuntimeException('Escaping failed.');
        echo json_encode(array('status'=>'ok','php'=>PHP_VERSION,'ci'=>CI_VERSION,'checks'=>array('bootstrap','loader','helpers','parser','validation','pagination','upload','user_agent',extension_loaded('openssl')?'encryption':'encryption skipped: openssl missing')),JSON_PRETTY_PRINT).PHP_EOL;
    }
}
