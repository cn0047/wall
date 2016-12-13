create table if not exists message (
    id int unsigned not null auto_increment key,
    userid int unsigned not null default '0',
    message text not null default '',
    createdat timestamp not null default current_timestamp,
    key userid (userid)
) engine=innodb default charset=utf8 ;