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
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn_tool','Search OpenLearn Content Tool',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn_text','A sample Search OpenLearn text for detailed homepage.',NOW(),'');

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

INSERT INTO `language_text` VALUES ('en', '_module','ol_admin_main','This is the admin panel of Search OpenLearn module. Here you can change different settings of this module. There are two panels below this text. Working of each panel is described below:',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_admin_lpanel','The panel on left side can be used to update database used for searching OpenLearn. While installing module the table was created using OpenLearn\'s repository.  The first row shows when database was updated. The second row has a button when you click on it, the database will be updated. This update procedure will modify existing records if they are changed and will install new records from repository.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_admin_rpanel','The panel on right side gives options to modify configuration parameters of the module. In first row you can modify URL of repository of OpenLearn. If you do not want to modify this field then do not change value. In the second row you can enter update database interval which is in minutes. It indicates after that much time database will be updated from OpenLearn\'s repository. If you want to disable automatic updates then enter 0 in textbox. To modify parameters in system, after entering values click Save button. ',NOW(),'');



#adding feedback messages
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_OL_DB_UPDATED','Database updated successfully',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_OL_DB_NOT_UPDATED','Error in updating database',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_SETTINGS_CHANGED','Settings changed successfully',NOW(),'');



#configuration data
INSERT INTO `config` VALUES ('ol_url','http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&metadataPrefix=oai_ilox');
INSERT INTO `config` VALUES ('ol_last_updation','');



