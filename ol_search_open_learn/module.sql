# sql file for ol_search_open_learn module

CREATE TABLE `ol_search_open_learn` (
      `id` mediumint(8) unsigned NOT NULL,
      `identifier` varchar (768),
	 `datestamp` varchar (768),
	 `catalog` varchar (768),
	 `entry` varchar (768),
	 `title` blob ,
	 `description` blob ,
	 `keywords` blob ,
	 `website` varchar (768),
	 `cc` varchar (768),
	 `cp` varchar (768),
      PRIMARY KEY ( `id` )
   
);

#language text
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn','Search OpenLearn',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','update_param','Update Parameters',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn_tool','Search OpenLearn Tool',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn_text','Search OpenLearn',NOW(),'');

INSERT INTO `language_text` VALUES ('en', '_module','ol_search_btn','Search',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_change_btn','Change',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_import_btn','Import',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_import_unit','Import Unit',NOW(),'');

INSERT INTO `language_text` VALUES ('en', '_module','ol_tool_1','Download Content Package',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_tool_2','Download Common Cartridge',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_tool_3','Preview on OpenLearn(popup window)',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_tool_4','RSS for Unit(popup window)',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_tool_5','Download doc file(popup window)',NOW(),'');

INSERT INTO `language_text` VALUES ('en', '_module','ol_key_form','Keywords',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_desc_form','Description',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_title_form','Title',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_all_form','All',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_fields_form','Search fields',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_update','Update Now',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_last_update','Last Updated on',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_at','at',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_of','of',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_descri','Description:',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_keywords','Keywords:',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_last_modi','Last modified on(DD-MM-YYYY):',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_no','No results found for:',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_repo_url','Repository URL',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_cron_interval','Update Database Interval',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_min','minutes',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_save','Save',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_max_reco','Maximum Records',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_order','Order By',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_bool','Boolean Operation',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_or','OR',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_and','AND',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_def','Default',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_title_asc','Title Ascending',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_title_desc','Title Descending',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_date_asc','Date Ascending',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_date_desc','Date Descending',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_not_doc','Unit does not provide .doc file.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_doc_avail','The unit is available for download:',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_mod_def','This module allows you to search the OpenLearn repository, and find Open Education Resources (OERs) on a wide range of topics. ',NOW(),'');

INSERT INTO `language_text` VALUES ('en', '_module','ol_admin_main','This is the admin panel of Search OpenLearn module, where you can change the settings for the module. The two panels are described below:',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_admin_lpanel','The panel on left side shows when the local ATutor database was last updated. To manually update the database to include the most recent changes on OpenLearn, then click the \'Update Now\' button.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_admin_rpanel','The panel on right side shows parameters for the module. On first line you can modify the OpenLearn repository URL. On second line you can modify how often the local ATutor database is automatically updated with new information from OpenLearn. The default time between updates is set to 1440 minutes (once per day).  If you want to disable automatic updates then enter 0 in textbox. For automatic updates you need to setup cron. For more information see the  <a href=\'documentation/admin/cron_setup.php?\' onclick=\"poptastic(\'documentation/admin/cron_setup.php?); return false;\" target=\'_new\'> Cron Setup </a> page in the Administrator Handbook',NOW(),'');


#adding feedback messages
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_OL_DB_UPDATED','Database updated successfully',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OL_DB_NOT_UPDATED','Error in updating database',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OL_URL_NOT_VAL','Entered URL is not valid',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OL_CRON_NOT_VAL','Update database interval is not valid',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_SETTINGS_CHANGED','Settings changed successfully',NOW(),'');



#configuration data
INSERT INTO `config` VALUES ('ol_url','http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&metadataPrefix=oai_ilox');
INSERT INTO `config` VALUES ('ol_last_updation','');



