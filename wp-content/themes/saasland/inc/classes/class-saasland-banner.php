<?php 

if( class_exists('\DroitHead\Includes\Supports\Support')) {
    
    /**
     * Extent class from saasland core to get banner id 
     */
    class saasland_banner extends \DroitHead\Includes\Supports\Support{

        public function __construct(){}

        public function apply_method1(){}

        public function apply_method2(){}

        public function replace_header(){}

        public function replace_header_method2(){}

        public function replace_footer(){}

        public function replace_footer_method2(){}

        public function get_builder_banner() {
             $get_banner_id = $this->get_templates('page-banner');
             return $get_banner_id;
        }
    }

}