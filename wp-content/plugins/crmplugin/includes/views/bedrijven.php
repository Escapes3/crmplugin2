<?php
// Include model:
require_once CRM_PLUGIN_PLUGIN_MODEL_DIR . '/Bedrijf.php';
// Declare class variable:
$bedrijf = new Bedrijf();
// Set base url to current file and add page specific vars
$base_url = get_permalink();
$params = array('link' => basename(__FILE__, ".php"));
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

<div class="wrap">
    <?php
    echo($add ? "<p>Bedrijf toegevoegd</p>" : "");
    // Check if action == update : then start update form
    echo(($action == 'update') ? '<form action="' . $base_url . '"method="post">' : '');
    ?>

    <table>
        <caption>Bedrijven</caption>
        <thead>
        <tr>
            <th width="150">Naam</th>
            <th width="200">Email</th>
            <th width="200">Telefoonnummer</th>
        </tr>
        </thead>
        <?php
        //*
        if ($bedrijf->getNrOfBedrijven() < 1) {
            ?>
            <tr>
                <td colspan="3">Bedrijven aanmaken
            </tr>
        <?php } else {
            $bedrijf_list = $bedrijf->getBedrijfList();

            //** Show all companies in the tabel
            foreach ($bedrijf_list as $bedrijf_obj) {
                // Create update link
                $params = array('action' => 'update', 'id' => $bedrijf_obj->getId());
                // Add params to base url update link
                $upd_link = add_query_arg($params, $base_url);
                // Create delete link
                $params = array('action' => 'delete', 'id' => $bedrijf_obj->getId());
                // Add params to base url delete link
                $del_link = add_query_arg($params, $base_url);
                // Create informatie link
                $params = array('action' => 'informatie', 'id' => $bedrijf_obj->getId());
                // Add params to base url informatie
                $info_link = add_query_arg($params, $base_url);
                ?>
                <tr>
                    <?php
                    if (($action =='informatie') &&
                        ($bedrijf_obj->getId() == $get_array['id'])
                    ) {
                    ?>
                    <td width="180"><input type="hidden" name="id" value="<?php echo $bedrijf_obj->getId(); ?>">
                        <input type="text" name="naam" value="<?php echo $bedrijf_obj->getName(); ?>"></td>
                    <td width="200"><input type="text" name="email" value="<?php echo $bedrijf_obj->getEmail(); ?>">
                    </td>
                    <td width="200"><input type="text" name="telefoonnummer" value="<?php echo $bedrijf_obj->getTelNumber(); ?>"></td>
                    <td colspan="2"><input type="submit" name="update" value="Updaten"/></td>
            <?php } else { ?>
                        <?php if ($action !== 'informatie') {
                            // If action is update don’t show the action button
                            ?>
                            <td><a href="<?php echo $upd_link; ?>">Update</a></td>
                            <td><a href="<?php echo $del_link; ?>">Delete</a></td>
                            <td><a href="<?php echo $info_link; ?>">Informatie</a></td>
                            <?php
                        } // if action !== update
                        ?>
                    <?php } // if acton !== update
                    ?>
                    <?php
                    // If update and id match show update form
                    // Add hidden field id for id transfer

                    if (($action == 'update') &&
                        ($bedrijf_obj->getId() == $get_array['id'])
                        ) {
                        ?>
                        <td width="180"><input type="hidden" name="id" value="<?php echo $bedrijf_obj->getId(); ?>">
                            <input type="text" name="naam" value="<?php echo $bedrijf_obj->getName(); ?>"></td>
                        <td width="200"><input type="text" name="email" value="<?php echo $bedrijf_obj->getEmail(); ?>">
                        </td>
                        <td width="200"><input type="text" name="telefoonnummer" value="<?php echo $bedrijf_obj->getTelNumber(); ?>"></td>
                        <td colspan="2"><input type="submit" name="update" value="Updaten"/></td>
                        <?php } else { ?>
                        <td width="200"><?php echo $bedrijf_obj->getName(); ?></td>
                        <td width="200"><?php echo $bedrijf_obj->getEmail(); ?></td>
                        <td width="200"><?php echo $bedrijf_obj->getTelNumber(); ?></td>
                        <?php if ($action !== 'update') {
                            // If action is update don’t show the action button
                            ?>
                            <td><a href="<?php echo $upd_link; ?>">Update</a></td>
                            <td><a href="<?php echo $del_link; ?>">Delete</a></td>
                            <td><a href="<?php echo $info_link; ?>">Informatie</a></td>
                            <?php
                        } // if action !== update
                        ?>

                    <?php } // if acton !== update
                    ?>

                </tr>
            <?php }
        } ?>

    </table>
    <?php
    // Check if action = update : then end update form
    echo(($action == 'update') ? '</form>' : '');
    /** Finally add the new entry line only if no update action **/
    if ($action !== 'update') {
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
        <?php
    } // if action !== update
    ?>
</div>