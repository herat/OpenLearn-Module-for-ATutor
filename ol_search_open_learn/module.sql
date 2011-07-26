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
INSERT INTO `language_text` VALUES ('en', '_module','ol_mod_def','This module allows you to search OpenLearn repository. You can reach your required content using this module.',NOW(),'');

INSERT INTO `language_text` VALUES ('en', '_module','ol_admin_main','This is the admin panel of Search OpenLearn module. Here you can change different settings of this module. There are two panels below this text. Working of each panel is described below:',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_admin_lpanel','The panel on left side shows when database was last updated. It shows date in YYYY-MM-DD format and time in HH:MM:SS format. If you want to update database to include the most recent changes then click on button named \'Update Now\'.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_admin_rpanel','The panel on right side gives options to modify configuration parameters of the module. In first row you can modify repository URL of OpenLearn. In second row you can modify cron interval which is in \'minutes\'. The default value is 1440 minutes. Cron interval indicates after how many minutes database will be updated automatically. If you want to disable automatic updates then enter 0 in textbox. For automaic updates you need to setup cron. For more information: <a href=\'documentation/admin/cron_setup.php?\' onclick=\"poptastic(\'documentation/admin/cron_setup.php?); return false;\" target=\'_new\'> Click Here </a>',NOW(),'');


#adding feedback messages
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_OL_DB_UPDATED','Database updated successfully',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OL_DB_NOT_UPDATED','Error in updating database',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OL_URL_NOT_VAL','Entered URL is not valid',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OL_CRON_NOT_VAL','Update database interval is not valid',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_SETTINGS_CHANGED','Settings changed successfully',NOW(),'');



#configuration data
INSERT INTO `config` VALUES ('ol_url','http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&metadataPrefix=oai_ilox');
INSERT INTO `config` VALUES ('ol_last_updation','');



