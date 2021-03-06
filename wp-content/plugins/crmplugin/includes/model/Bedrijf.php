<?php
/**
 * Description of EventCategories
 *
 * @author LOudshoorn
 */
class Bedrijf {
    /**
     * getPostValues :
     * Filter input and retrieve POST input params
     *
     * @return array containing known POST input fields
     */
    public function getPostValues(){
        // Define the check for params
        $post_check_array = array (
            // submit action
            'add' => array('filter' => FILTER_SANITIZE_STRING ),
            'update' => array('filter' => FILTER_SANITIZE_STRING ),
            'naam' => array('filter' => FILTER_SANITIZE_STRING ),
            'email' => array('filter' => FILTER_SANITIZE_STRING ),
            'telefoonnummer' => array('filter' => FILTER_SANITIZE_STRING ),
            // Id of current row
            'id' => array( 'filter' => FILTER_VALIDATE_INT )
        );
        // Get filtered input:
        $inputs = filter_input_array( INPUT_POST, $post_check_array );
        // RTS
        return $inputs;
    }
    // Check input field
    public function checkNaam($naam)
    {
        if (strlen($naam) < 1) throw new Exception (__('Verplicht veld!'));
    }

    public function checkEmail($email)
    {
        if (strlen($email) < 1) throw new Exception (__('Verplicht veld!'));
    }

    public function checkTelefoonnummer($telefoonnummer)
    {
        if (strlen($telefoonnummer) < 1) throw new Exception (__('Verplicht veld!'));
    }
    /**
     *
     * @global type $wpdb The Wordpress database class
     * @param type $input_array containing insert data
     * @return boolean TRUE on succes OR FALSE
     */
    public function save($input_array){
        try {
            if ( !isset($input_array['naam']) OR
                !isset($input_array['email']) OR
                !isset($input_array['telefoonnummer'])){
                // Mandatory fields are missing
                throw new Exception(__("Missing mandatory fields"));
            }
            if ( (strlen($input_array['naam']) < 1) OR
                (strlen($input_array['email']) < 1) OR
                (strlen($input_array['telefoonnummer']) < 1) ){
                // Mandatory fields are empty
                throw new Exception( __("Empty mandatory fields") );
            }

            global $wpdb;

            // Insert query
            $wpdb->query($wpdb->prepare("INSERT INTO `". $wpdb->prefix
                ."crm_bedrijf` ( `naam`, `email`, `telefoonnummer`)".
                " VALUES ( '%s', '%s', '%s');",$input_array['naam'],$input_array['email'], $input_array['telefoonnummer']) );
            // Error ? It's in there:
            if ( !empty($wpdb->last_error) ){
                $this->last_error = $wpdb->last_error;
                return FALSE;
            }

 } catch (Exception $exc) {
 // @todo: Add error handling

 echo '<pre>'. $exc->getTraceAsString() .'</pre>';
 }
    }
    /**
     *
     * @return int number of Event categories stored in db
     */
    public function getNrOfBedrijven(){
        global $wpdb;

        $query = "SELECT COUNT(*) AS nr FROM `". $wpdb->prefix
            ."crm_bedrijf`";
        $result = $wpdb->get_results( $query, ARRAY_A );

        return $result[0]['nr'];
    }

    /**
     *
     * @return int number of Event categories stored in db
     */
    public function informatie(){
        global $wpdb;

        $query = "SELECT COUNT(*) AS nr FROM `". $wpdb->prefix
            ."crm_bedrijf`";
        $result = $wpdb->get_results( $query, ARRAY_A );

        return $result[0]['nr'];
    }

    /**
     *
     * @return type
     */
    public function getBedrijfList(){

        global $wpdb;
        $return_array = array();

        $result_array = $wpdb->get_results( "SELECT * FROM `". $wpdb->prefix . "crm_bedrijf` ORDER BY `id_bedrijf`", ARRAY_A);

 /*
 echo '<pre>';
 echo __FILE__.__LINE__.'<br />';
 var_dump($result_array);
 echo '</pre>';
 //*/

 // For all database results:
 foreach ( $result_array as $idx => $array){
// New object
     $cat = new Bedrijf();
     // Set all info
     $cat->setId($array['id_bedrijf']);
     $cat->setName($array['naam']);
     $cat->setEmail($array['email']);
     $cat->setTelNumber($array['telefoonnummer']);

     // Add new object toe return array.
     $return_array[] = $cat;
 }
 return $return_array;
 }

    /**
     *
     * @param type $id Id of the company
     */
    public function setId( $id ){
        if ( is_int(intval($id) ) ){
            $this->id = $id;
        }
    }

    /**
     *
     * @param type $name name of the company
     */
    public function setName( $name ){
        if ( is_string( $name )){
            $this->name = trim($name);
        }
    }

    /**
     *
     * @param type $desc The help text of the company
     */
    public function setEmail ($email){
        if ( is_string($email)){
            $this->email = trim($email);
        }
    }
    /**
     *
     * @param type $desc The help text of the company
     */
    public function setTelNumber ($telnumber){
        if ( is_string($telnumber)){
            $this->telnumber = trim($telnumber);
        }
    }

    /**
     *
     * @return int The db id of this event
     */
    public function getId(){
        return $this->id;
    }

    /**
     *
     * @return string The name of the Event Category
     */
    public function getName(){
        return $this->name;
    }

    /**
     *
     * @return string The help text of the description
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     *
     * @return string The help text of the description
     */
    public function getTelNumber(){
        return $this->telnumber;
    }


    // *** Update *** //

    /**
     * getGetValues :
     * Filter input and retrieve GET input params
     *
     * @return array containing known GET input fields
     */
    public function getGetValues(){
        // Define the check for params
        $get_check_array = array (
            // Action
            'action' => array('filter' => FILTER_SANITIZE_STRING ),

            // Id of current row
            'id' => array( 'filter' => FILTER_VALIDATE_INT )
        );
        // Get filtered input:
        $inputs = filter_input_array( INPUT_GET, $get_check_array );
        // RTS
        return $inputs;
    }

    /**
     * Check the action and perform action on :
     * - delete
     *
     * @param type $get_array all get vars en values
     * @return string the action provided by the $_GET array.
     */
    public function handleGetAction( $get_array ){
        $action = '';

        switch($get_array['action']){
            case 'update':
                // Indicate current action is update if id provided
                if ( !is_null($get_array['id']) ){
                    $action = $get_array['action'];
                }
                break;

            case 'delete':
                // Delete current id if provided
                if ( !is_null($get_array['id']) ){
                    $this->delete($get_array);
                }
                $action = 'delete';
                break;
            case 'informatie':
                // Indicate current action is update if id provided
                if ( !is_null($get_array['id']) ){
                    $action = $get_array['action'];
                }
                break;

 default:
     // Oops
     break;
 }
        return $action;
    }

/*
* @global type $wpdb
* @return type string table name with wordpress (and app prefix)
*/
    private function getTableName(){

        global $wpdb;
        return $table = $wpdb->prefix . "crm_bedrijf";
    }

    /**
     *
     * @global type $wpdb Wordpress database
     * @param type $input_array post_array
     * @return boolean TRUE on Succes else FALSE
     * @throws Exception
     */
    public function update($input_array){

        try {
            $array_fields = array('id', 'naam', 'email','telefoonnummer');
            $table_fields = array( 'id_bedrijf', 'naam' , 'email', 'telefoonnummer');
            $data_array = array();

            // Check fields
            foreach( $array_fields as $field){

                // Check fields
                if (!isset($input_array[$field])){
                    throw new Exception(__("$field is mandatory for update."));
                }
                // Add data_array (without hash idx)

 // (input_array is POST data -> Could have more fields)
 $data_array[] = $input_array[$field];
 }
            global $wpdb;

            // Update query
            //*
            $wpdb->query($wpdb->prepare("UPDATE ".$this->getTableName(). " SET `naam` = '%s', `email` = '%s', `telefoonnummer` = '%s' ".
                "WHERE `wp_crm_bedrijf`.`id_bedrijf` =%d;",$input_array['naam'],
                $input_array['email'], $input_array['telefoonnummer'], $input_array['id']) );
            /*/

            // Replace form field id index by table field id name

            $wpdb->update($this->getTableName(),
            $this->getTableDataArray($data_array),
            array( 'id_event_category' => $input_array['id']), // Where
            array( '%s', '%s' ), // Data format
            array( '%d' )); // Where format
            //*/

        } catch (Exception $exc) {

            // @todo: Fix error handlin
            echo $exc->getTraceAsString();
            $this->last_error = $exc->getMessage();
            return FALSE;
        }
        return TRUE;
    }

    /**
     * The function takes the input data array and changes the
     * indexes to the column names
     * In case of update or insert action
     *
     * @param type $input_data_array data array(id, name, descpription)
     * @param type $action update | insert
     * @return type array with collumn index and values OR FALSE
     */
    private function getTableDataArray($input_data_array, $action=''){

        // Get the Table Column Names.
        $keys = $this->getTableColumnNames($this->getTableName());

        // Get data array with table collumns
        // NULL if collumns and data does not match in count
        //
        // Note: The order of the fields shall be the same for both!
        $table_data = array_combine($keys, $input_data_array);

        switch ( $action ){
            case 'update': // Intended fall-through
            case 'insert':
                // Remove the index -> is primary key and can
// therefore not be changed!
                if (!empty($table_data)){
                    unset($table_data['id_bedrijf']);
                }
                break;
            // Remove
        }
        return $table_data;
    }
    /**
     * Get the column names of the specified table
     * @global type $wpdb
     * @param type $table
     * @return type
     */
    private function getTableColumnNames($table){
        global $wpdb;
        try {
            $result_array = $wpdb->get_results("SELECT `COLUMN_NAME` ".
                " FROM INFORMATION_SCHEMA.COLUMNS".
                " WHERE `TABLE_SCHEMA`='".DB_NAME.
                "' AND TABLE_NAME = '".$this->getTableName() ."'", ARRAY_A);
            $keys = array();
            foreach ( $result_array as $idx => $row ){
                $keys[$idx] = $row['COLUMN_NAME'];
            }
            return $keys;
        } catch (Exception $exc) {

            // @todo: Fix error handlin
            echo $exc->getTraceAsString();
            $this->last_error = $exc->getMessage();
            return FALSE;
        }
    }



    // *** Delete *** //
    /**
     *
     * @global type $wpdb The Wordpress database class
     * @param type $input_array containing delete id
     * @return boolean TRUE on succes OR FALSE
     */
    public function delete($input_array){

        try {
            // Check input id
            if (!isset($input_array['id']) )
                throw new Exception(__("Missing mandatory fields") );
            global $wpdb;
            // Delete query
            /*
            $query = $wpdb->prepare("Delete FROM `". $this->getTableName().
           "` WHERE `id_event_category` = %d", $input_array['id']);
            // Execute query:
            $wpdb->query( $query );
            /*/
            // Delete row by provided id (Wordpress style)
            $wpdb->delete( $this->getTableName(),
                array( 'id_bedrijf' => $input_array['id'] ),
                array( '%d' ) ); // Where format
            //*/

            // Error ? It's in there:
            if ( !empty($wpdb->last_error) ){

                throw new Exception( $wpdb->last_error);
            }


        } catch (Exception $exc) {
            // @todo: Add error handling
            echo '<pre>';
            $this->last_error = $exc->getMessage();
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
            echo '</pre>';
        }
        return TRUE;
    }
}


?>