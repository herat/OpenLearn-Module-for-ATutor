<?php
/*******
 * this function named [module_name]_delete is called whenever a course content is deleted
 * which includes when restoring a backup with override set, or when deleting an entire course.
 * the function must delete all module-specific material associated with this course.
 * $course is the ID of the course to delete.
 */

function ol_search_open_learn_delete($course) {
    global $db;

    // delete hello_world course table entries
    $sql = "DELETE FROM ".TABLE_PREFIX."ol_search_open_learn";
    mysql_query($sql, $db);

    $sql = "DELETE FROM ".TABLE_PREFIX."config where name='ol_url'";
    mysql_query($sql, $db);

    $sql = "DELETE FROM ".TABLE_PREFIX."config where name='ol_last_updation'";
    mysql_query($sql, $db);
    
    // delete ol_search_open_learn course files
    $path = AT_CONTENT_DIR .'ol_search_open_learn/' . $course .'/';
    clr_dir($path);
}

?>