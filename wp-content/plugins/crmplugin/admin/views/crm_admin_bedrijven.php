<?php
// Include model:
include CRM_PLUGIN_PLUGIN_MODEL_DIR . "/Bedrijf.php";
// Declare class variable:
$bedrijf = new Bedrijf();
// Set base url to current file and add page specific vars
$base_url = get_admin_url() . 'admin.php';
$params = array('page' => basename(__FILE__, ".php"));
// Add params to base url
$base_url = add_query_arg($params, $base_url);
// Get the GET data in filtered array
$get_array = $bedrijf->getGetValues();
var_dump($existing_columns = $wpdb->get_col("DESC {$table}", 0));
?>

<div class="wrap">
    <table>
        <h1>Velden toevoegen bedrijven</h1>
        <thead>
        <tr>
            <th width="200">Veld</th>
        </tr>
        <tr>
            <td colspan="2"><?php echo __('Veldnaam :'); ?>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="float: right">
                <input type="submit" name="add" value="Toevoegen"/>
            </td>
        </tr>
        </thead>
    </table>
    <table>
        <h1>Bestaanden velden</h1>
        <thead>
        <tr>
            <th width="200">Naam</th>
        </tr>
        <tr>
        </tr>
        </thead>
    </table>
</div>