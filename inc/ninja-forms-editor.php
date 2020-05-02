<?php 
/*
*   ninja-form-editors.php
**/
/*To give Editors access to the ALL Forms menu*/
function my_custom_change_ninja_forms_all_forms_capabilities_filter( $capabilities ) {
    $capabilities = "edit_pages";
    return $capabilities;
}
add_filter( 'ninja_forms_admin_parent_menu_capabilities', 'my_custom_change_ninja_forms_all_forms_capabilities_filter' );
add_filter( 'ninja_forms_admin_all_forms_capabilities', 'my_custom_change_ninja_forms_all_forms_capabilities_filter' );

/*To give Editors access to ADD New Forms*/
function my_custom_change_ninja_forms_add_new_capabilities_filter( $capabilities ) {
    $capabilities = "edit_pages";
    return $capabilities;
}
add_filter( 'ninja_forms_admin_parent_menu_capabilities', 'my_custom_change_ninja_forms_add_new_capabilities_filter' );
add_filter( 'ninja_forms_admin_add_new_capabilities', 'my_custom_change_ninja_forms_add_new_capabilities_filter' );

/* To give Editors access to the Submissions - Simply replace ‘edit_posts’ in the code snippet below with the capability
that you would like to attach the ability to view/edit submissions to.Please note that all three filters are needed to
provide proper submission viewing/editing on the backend!
*/
function nf_subs_capabilities( $cap ) {
    return 'edit_posts';
}
add_filter( 'ninja_forms_admin_submissions_capabilities', 'nf_subs_capabilities' );
add_filter( 'ninja_forms_admin_parent_menu_capabilities', 'nf_subs_capabilities' );
add_filter( 'ninja_forms_admin_menu_capabilities', 'nf_subs_capabilities' );

// To give Editors access to the Inport/Export Options
 function my_custom_change_ninja_forms_import_export_capabilities_filter( $capabilities ) {
     $capabilities = "edit_pages";
     return $capabilities;
 }
 add_filter( 'ninja_forms_admin_parent_menu_capabilities', 'my_custom_change_ninja_forms_import_export_capabilities_filter' );
 add_filter( 'ninja_forms_admin_import_export_capabilities', 'my_custom_change_ninja_forms_import_export_capabilities_filter' );

// To give Editors access to the the Settings page
 function my_custom_change_ninja_forms_settings_capabilities_filter( $capabilities ) {
     $capabilities = "edit_pages";
     return $capabilities;
 }
 add_filter( 'ninja_forms_admin_parent_menu_capabilities', 'my_custom_change_ninja_forms_settings_capabilities_filter' );
 add_filter( 'ninja_forms_admin_settings_capabilities', 'my_custom_change_ninja_forms_settings_capabilities_filter' );
