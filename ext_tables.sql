#
# Table structure for table 'tx_consentmanagerv2_domain_model_consentmanager'
#
CREATE TABLE tx_consentmanagerv2_domain_model_consentmanager (
	cmp_id varchar(255) DEFAULT '' NOT NULL,
	cdnurl varchar(255) DEFAULT '' NOT NULL,
	deliveryurl varchar(255) DEFAULT '' NOT NULL,
	type varchar(255) DEFAULT '' NOT NULL,
	cmpcodeid_str int(11) unsigned DEFAULT '0' NOT NULL,
	custom_field text,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL
);
