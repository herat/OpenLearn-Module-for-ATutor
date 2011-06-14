# sql file for hello world module

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


INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn','Search OpenLearn',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','update_param','Update Parameters',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn_tool','Search OpenLearn Content Tool',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn_text','A sample Search OpenLearn text for detailed homepage.',NOW(),'');

#adding feedback messages
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_OL_DB_UPDATED','Database updated successfully',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_OL_DB_NOT_UPDATED','Error in updating database',NOW(),'');



INSERT INTO `config` VALUES ('ol_url','http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&metadataPrefix=oai_ilox');

INSERT INTO `config` VALUES ('ol_last_updation',CURDATE());


