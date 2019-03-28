<?php
// Include model:
require_once CRM_PLUGIN_PLUGIN_MODEL_DIR . '/Bedrijf.php';
// Declare class variable:
$bedrijf = new Bedrijf();
// Set base url to current file and add page specific vars
$base_url = get_permalink();
$params = array('page' => basename(__FILE__, ".php"));
// Add params to base url
$base_url = add_query_arg($params, $base_url);
// Get the GET data in filtered array
$get_array = $bedrijf->getGetValues();
// Keep track of current action.
$action = FALSE;
if (!empty($get_array)) {
    // Check actions
    if (isset($get_array['action'])) {
        $action = $bedrijf->handleGetAction($get_array);
    }
}
// Get the POST data in filtered array
$post_array = $bedrijf->getPostValues();
// Collect Errors
$error = FALSE;
// Check the POST data
if (!empty($post_array)) {
    // Check the add form:
    $add = FALSE;
    if (isset($post_array['add'])) {
        // Save company
        $result = $bedrijf->save($post_array);
        if ($result) {
            // Save was succesfull
            $add = TRUE;
        } else {
            // Indicate error
            $error = TRUE;
        }
    }
}
// Check the update form:
if (isset($post_array['update'])) {
    // Save event categorie
    $bedrijf->update($post_array);
}
?>
        <form action="<?php echo $base_url; ?>" method="post">
            <tr>
                <table>
                    <tr>
                        <td colspan="2"><?php echo __('Naam :'); ?><input type="text" name="naam"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo __('Email :'); ?><input type="text" name="email"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo __('Telefoonnummer :'); ?><input type="text" name="telefoonnummer">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="add" value="Toevoegen"/>
                        </td>
                    </tr>
                </table>
        </form>
