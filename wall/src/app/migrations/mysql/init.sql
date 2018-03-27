create table if not exists message (
    id int not null auto_increment key, -- int unsigned
    userId int not null default '0', -- int unsigned
    message text not null,
    createdAt timestamp not null default current_timestamp,
    key userId (userId)
) engine=innodb default charset=utf8 ;
