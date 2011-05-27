# sql file for hello world module

CREATE TABLE `hello_world` (
   `hello_world_id` mediumint(8) unsigned NOT NULL,
   `course_id` mediumint(8) unsigned NOT NULL,
   `value` VARCHAR( 30 ) NOT NULL ,
   PRIMARY KEY ( `hello_world_id` )
);

INSERT INTO `language_text` VALUES ('en', '_module','hello_world','Hello World',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','hello_world_tool','Hello World Content Tool',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','hello_world_text','A sample Hello World text for detailed homepage.',NOW(),'');

INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn','Search OpenLearn',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn_tool','Search OpenLearn Content Tool',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn_text','A sample Search OpenLearn text for detailed homepage.',NOW(),'');
