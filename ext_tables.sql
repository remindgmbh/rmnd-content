CREATE TABLE tt_content (
    rmnd_content_items int(11) unsigned DEFAULT '0',
);

CREATE TABLE rmnd_content_items (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

	tt_content int(11) unsigned DEFAULT '0' NOT NULL,

	header varchar(255) DEFAULT '' NOT NULL,
    header_layout varchar(30) DEFAULT '0' NOT NULL,
    header_link varchar(1024) DEFAULT '' NOT NULL,
    header_position varchar(255) DEFAULT '' NOT NULL,
	subheader varchar(255) DEFAULT '' NOT NULL,
	bodytext mediumtext,
    space_before_class varchar(60) DEFAULT '' NOT NULL,
	space_after_class varchar(60) DEFAULT '' NOT NULL,
	image int(11) unsigned DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint unsigned DEFAULT '0' NOT NULL,
    hidden smallint unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,

    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) unsigned DEFAULT '0' NOT NULL,
    l10n_source int(11) unsigned DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NULL,

    t3ver_oid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state smallint DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) unsigned DEFAULT '0' NOT NULL,
    t3_origuid int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);