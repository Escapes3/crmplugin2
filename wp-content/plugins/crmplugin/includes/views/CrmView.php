<?php
/**
 * Description of EventView class
 * All program functionality for the BedrijfView.
 *
 * @author loudshoorn
 */
require_once CRM_PLUGIN_PLUGIN_MODEL_DIR .'/Crm.php';
class CrmView {
    private $crm;
    public function __construct() {
        $this->crm = new Crm();
    }
    public function getGetValues(){
        // Define the check for params
        $get_check_array = array (
            // submit action
            'link' => array('filter' => FILTER_SANITIZE_STRING )
        );
        // Get filtered input:
        return filter_input_array( INPUT_GET, $get_check_array );
    }
    public function getPostValues(){
        // Define the check for params
        $post_check_array = array (

            // Add event form
            // submit action
            'add' => array('filter' => FILTER_SANITIZE_STRING ),
            'naam' => array('filter' => FILTER_SANITIZE_STRING ),
            'update' => array('filter' => FILTER_SANITIZE_STRING),
            'delete' => array('filter' => FILTER_SANITIZE_STRING),
            'email' => array('filter' => FILTER_SANITIZE_STRING ),
            'telefoonnummer' => array('filter' => FILTER_SANITIZE_STRING ),
            // Id of current row
            'id' => array( 'filter' => FILTER_VALIDATE_INT )
        );
        // Get filtered input:
        $post_inputs = filter_input_array( INPUT_POST, $post_check_array );

        return $post_inputs;
    }
    public function is_submit_event_add_form( $post_inputs ){
        if (!is_null($post_inputs['add'])) return TRUE;

        return FALSE;
    }
    public function check_event_save_form ( &$post_inputs )
    {

        // Special wordpress error class
        $errors = new WP_Error();

        // Title
        try {
            $this->crm->checkNaam($post_inputs['naam']);
        } catch (Exception $exc) {
            $errors->add('naam', $exc->getMessage());
        }

        // Categorie ID
        try {
            $this->crm->checkEmail($post_inputs['email']);
        } catch (Exception $exc) {
            $errors->add('email', $exc->getMessage());
        }
        // Type ID
        try {
            $this->crm->checkTelefoonnummer($post_inputs['telefoonnummer']);
        } catch (Exception $exc) {
            $errors->add('telefoonnummer', $exc->getMessage());
        }
        // Check for errors before saving the date
        if ($errors->get_error_code()) return $errors;
        return TRUE; // return the real result
    }
}
?>