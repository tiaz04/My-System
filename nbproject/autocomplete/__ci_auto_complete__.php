<?php

/**
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Config $config
 * @property CI_Controller $controller
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Input $input
 * @property CI_Language $language
 * @property CI_Loader $load
 * @property CI_Log $log
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Parser $parser
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Session $session
 * @property CI_Sha1 $sha1
 * @property CI_Table $table
 * @property CI_Trackback $trackbackv
 * @property CI_Typography $typography
 * @property CI_Unit_test $unit_test
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Validation $validation
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 * 
 * @property Categoryclass $categoryclass
 * @property Eventiclass $eventiclass
 * @property Faqclass $faqclass
 * @property Filegalleryclass $filegalleryclass
 * @property Galleryclass $galleryclass
 * @property Generals $generals
 * @property Glossaryclass $glossaryclass
 * @property Headerimgclass $headerimgclass
 * @property Newsclass $newsclass
 * @property Packclass $packclass
 * @property Pagineclass $pagineclass
 * @property Tarifsclass $tarifsclass
 * @property Tradclass $tradclass
 * @property Uploadclass $uploadclass
 * @property Videoclass $videoclass
 */
class CI_Controller {
    
}

class CI_DB_Driver {

    /**
     * Execute the query
     *
     * Accepts an SQL string as input and returns a result object upon
     * successful execution of a "read" type query.  Returns boolean TRUE
     * upon successful execution of a "write" type query. Returns boolean
     * FALSE upon failure, and if the $db_debug variable is set to TRUE
     * will raise an error.
     *
     * @access public
     * @param string An SQL query string
     * @param array An array of binding data
     * @return CI_DB_mysql_result
     */
    function query() {
        
    }

}

/**
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 * @property CI_Config $config
 * @property CI_Loader $load
 * @property CI_Session $session
 * 
 * @property Categoryclass $categoryclass
 * @property Eventiclass $eventiclass
 * @property Faqclass $faqclass
 * @property Filegalleryclass $filegalleryclass
 * @property Galleryclass $galleryclass
 * @property Generals $generals
 * @property Glossaryclass $glossaryclass
 * @property Headerimgclass $headerimgclass
 * @property Newsclass $newsclass
 * @property Packclass $packclass
 * @property Pagineclass $pagineclass
 * @property Tarifsclass $tarifsclass
 * @property Tradclass $tradclass
 * @property Uploadclass $uploadclass
 * @property Videoclass $videoclass
 */
class CI_Model {
    
}

/**
 * @return CI_Controller
 */
function get_instance() {
    
}

?> 