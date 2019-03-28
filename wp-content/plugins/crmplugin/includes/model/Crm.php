<?php
/**
 * Description of Magazijn
 *
 * @author LOudshoorn
 */
require_once CRM_PLUGIN_PLUGIN_MODEL_DIR . '/Bedrijf.php';


class Crm
{
    /**
     *
     * @var type Bedrijf
     */
    private $bedrijf = null;

    public function __construct()
    {
        // Init the category and type
        $this->bedrijf = new Bedrijf();
    }

    /**
     *
     * @return type array of Bedrijf
     */
    public function getBedrijfList()
    {

        return $this->bedrijf->getBedrijfList();
    }

    public function checkNaam($naam)
    {

        if (!is_string($naam)) throw new Exception (__('Tekst invullen'));

        if (empty($naam)) throw new Exception (__('Verplicht veld!'));

    }

    public function checkEmail($email)
    {

        if (!is_string($email)) throw new Exception (__('Tekst invullen'));

        if (empty($email)) throw new Exception (__('Verplicht veld!'));

    }

    public function checkTelefoonnummer($telefoonnummer)
    {

        if (!is_string($telefoonnummer)) throw new Exception (__('Tekst invullen'));

        if (empty($telefoonnummer)) throw new Exception (__('Verplicht veld!'));

    }


    function save($naam,$email,$telefoonnummer)
    {

        global $wpdb;
        $error = new WP_Error();

        try {
            $this->checkNaam($naam);
            $this->checkEmail($email);
            $this->checkTelefoonnummer($telefoonnummer);
        } catch (Exception $exc) {
            $error->add('save', $exc->getMessage());
        }

        // Check on found errors if none save data
        if (count($error->get_error_messages()) < 1) {

            $sql = $wpdb->prepare("INSERT INTO `" . $wpdb->prefix . "crm_bedrijf`
" .
                "( `naam`,`email`,`telefoonnummer` )" .
                " VALUES ( '%s', '%s', '%s' " .
                ");",
                $naam, $email, $telefoonnummer
            );

           // Check your SQL by adding an additional slash before the ‘/*’
//            echo '<pre>';
//            echo __FILE__.__LINE__.'<br />';
//            var_dump($sql);
//            echo '</pre>';
            //*/

            $wpdb->query($sql);


            if (!empty($wpdb->last_error)) {
                $this->last_error = $wpdb->last_error;
                $error->get_error_message($this->last_error);

                return $error;
            }

        } else {

            // Some WP_ERROR on input vars
            var_dump($error);
            return $error;
        }

        // Return the last inserted id (Id from the newly created event)
        return $wpdb->insert_id;
    }
}

?>