<?php
// Include model:
include CRM_PLUGIN_PLUGIN_MODEL_DIR. "/Contactpersoon.php";

// Declare class variable:
$contactpersoon = new Contactpersoon();
// Set base url to current file and add page specific vars
$base_url = get_permalink();
$params = array('link' => basename(__FILE__, ".php"));
// Add params to base url
$base_url = add_query_arg( $params, $base_url );
// Get the GET data in filtered array
$get_array = $contactpersoon->getGetValues();

// Keep track of current action.
$action = FALSE;
if (!empty($get_array)){

    // Check actions
    if (isset($get_array['action'])){
        $action = $contactpersoon->handleGetAction($get_array);
    }
}
// Get the POST data in filtered array
$post_array = $contactpersoon->getPostValues();
// Collect Errors
$error = FALSE;
// Check the POST data
if (!empty($post_array)){
    // Check the add form:
    $add = FALSE;
    if (isset($post_array['add']) ){
        // Save company
        $result = $contactpersoon->save($post_array);
        if ($result){
            // Save was succesfull
            $add = TRUE;
        } else {
            // Indicate error
            $error = TRUE;
        }
    }
}
// Check the update form:
if (isset($post_array['update']) ){
    // Save event categorie
    $contactpersoon->update($post_array);
}
?>
<div class="wrap">
    <?php
    echo ($add ? "<p>Contactpersoon toegevoegd</p>" : "");
    // Check if action == update : then start update form
    echo (($action == 'update') ? '<form action="'.$base_url.'"method="post">' : '');
    ?>

    <table>
        <caption>Contactpersonen</caption>
        <thead>
        <tr>
            <th width="150">Naam</th>
            <th width="200">Email</th>
            <th width="200">Telefoonnummer</th>
        </tr>
        </thead>
        <?php
        //*
        if( $contactpersoon->getNrOfContactpersoon() < 1){
            ?>
            <tr><td colspan="3">Bedrijven aanmaken</tr>
        <?php } else {
            $contactpersoon_list = $contactpersoon->getContactpersoonList();

            //** Show all companies in the tabel
            foreach( $contactpersoon_list as $contactpersoon_obj){
                // Create update link
                $params = array( 'action' => 'update', 'id' => $contactpersoon_obj->getId());
                // Add params to base url update link
                $upd_link = add_query_arg( $params, $base_url );
                // Create delete link
                $params = array( 'action' => 'delete', 'id' => $contactpersoon_obj->getId());
                // Add params to base url delete link
                $del_link = add_query_arg( $params, $base_url );
                ?>
                <tr>

                    <?php
                    // If update and id match show update form
                    // Add hidden field id for id transfer
                    if ( ($action == 'update') &&
                        ($contactpersoon_obj->getId() == $get_array['id']) ){
                        ?>
                        <td width="180"><input type="hidden" name="id" value="<?php echo $contactpersoon_obj->getId(); ?>">
                            <input type="text" name="naam" value="<?php echo $contactpersoon_obj->getName(); ?>"></td>
                        <td width="200"><input type="text" name="email" value ="<?php echo $contactpersoon_obj->getEmail();?>"></td>
                        <td width="200"><input type="text" name="telefoonnummer" value ="<?php echo $contactpersoon_obj->getTelNumber();?>"></td>
                        <td colspan="2"><input type="submit" name="update" value="Updaten"/></td>
                    <?php } else { ?>
                        <td width="180"><?php echo $contactpersoon_obj->getName(); ?></td>
                        <td width="200"><?php echo $contactpersoon_obj->getEmail();?></td>
                        <td width="200"><?php echo $contactpersoon_obj->getTelNumber();?></td>
                        <?php if ($action !== 'update') {
                            // If action is update don’t show the action button
                            ?>
                            <td><a href="<?php echo $upd_link; ?>">Update</a></td>
                            <td><a href="<?php echo $del_link; ?>">Delete</a></td>
                            <?php
                        } // if action !== update
                        ?>

                    <?php } // if acton !== update ?>
                </tr>
            <?php } }?>

    </table>
    <?php
    // Check if action = update : then end update form
    echo (($action == 'update' ) ? '</form>' : '');
    /** Finally add the new entry line only if no update action **/
    if ($action !== 'update'){
        ?>
        <form action="<?php echo $base_url; ?>" method="post"><tr>
                <table>
                    <tr>
                        <td colspan="2"><?php echo __('Naam :'); ?><input type="text" name="naam"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo __('Email :'); ?><input type="text" name="email"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo __('Telefoonnummer :'); ?><input type="text" name="telefoonnummer"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="add" value="Toevoegen"/>
                        </td>
                    </tr>
                </table>


        </form>
        <?php
    } // if action !== update
    ?>
</div>