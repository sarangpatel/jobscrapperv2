CREATE TABLE temp_url_level3 (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
