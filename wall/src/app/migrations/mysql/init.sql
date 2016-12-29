create table if not exists message (
    id int unsigned not null auto_increment key,
    userId int unsigned not null default '0',
    message text not null,
    createdAt timestamp not null default current_timestamp,
    key userId (userId)
) engine=innodb default charset=utf8 ;
