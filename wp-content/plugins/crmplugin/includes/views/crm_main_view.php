<?php
// Set base url and add page specific vars
$base_url = get_permalink();
// Include the bedrijf class from the VIEW.
require_once CRM_PLUGIN_PLUGIN_INCLUDES_VIEWS_DIR.'/CrmView.php';
$crm_view = new CrmView();
// Get the getters
$get_inputs = $crm_view->getGetValues();
// Get form vars
$post_inputs = $crm_view->getPostValues();
// If provided set current file based on the provided link
$current_file = (!empty($get_inputs['link']) ?
    CRM_PLUGIN_PLUGIN_INCLUDES_VIEWS_DIR. '/'. $get_inputs['link'].'.php' :
    '');
// Add the current page link get param.
if (!empty($get_inputs['link'])){
    $params = array( 'link' => $get_inputs['link']);
    $file_base_url = add_query_arg( $params, $base_url );

} else {
    // Or stick to base url
    $file_base_url = $base_url;
}
$form_result = new WP_Error();
// Check add form event :
if ( $crm_view->is_submit_event_add_form($post_inputs) ){
    // Check add form submission :
    $form_result = $crm_view->check_event_save_form( $post_inputs );

    if ( !is_bool($form_result) && get_class($form_result) == 'WP_Error'){

        // Reshow the form again.
    } else{

        // Check on error
        if ( !($form_result instanceof WP_Error )){

            $form_result = new WP_Error();
        }

        // Create instance of Event class
        $crm = new Crm();

        // Save the event
        $return = $crm->save($post_inputs['naam'],
            $post_inputs['email'],
            $post_inputs['telefoonnummer']);

        if ( ! ($return instanceof WP_Error)) {
            // Do not show the event input file again : Show main page
            $current_file = '';
        }

    }
}
if (!empty($current_file) && file_exists( $current_file)){

// Include the link file and show that page.
include $current_file;
} //*
else if (!empty($current_file) && !file_exists($current_file)){
    // Linked file not found!
    // @todo: Change error
    echo '<span style="color:red">Main view error: FILE NOT FOUND ['.
        $current_file .']</span>';

} //*/
else {
    echo 'CRM<br>';
 // Create add link
 $params = array( 'link' => 'bedrijven');
 // Add params to base url update link
 $link = add_query_arg( $params, $base_url );
?>
    <a href="<?php echo $link;?>">Bedrijven lijst</a><p/>
    <?php
// Create contact link
    $params = array( 'link' => 'bedrijf_add');
// Add params to base url link
    $link = add_query_arg( $params, $base_url );
    ?>
    <a href="<?php echo $link;?>">Bedrijven toevoegen</a><p />
    <?php
// Create contact link
$params = array( 'link' => 'contacten');
// Add params to base url link
$link = add_query_arg( $params, $base_url );
?>
    <a href="<?php echo $link;?>">Contactpersonen</a><p />
    <?php

}
?>


