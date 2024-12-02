create table tblAccount(

    accountID serial primary key,
    name varchar(45),
    username varchar(45),
    password text,
    accountType varchar(45),
    archiveFlag smallint DEFAULT 1

);

insert into tblAccount(name, username, password, accountType) 
    values ('Admin', 'admin0016', '$2y$10$fxBvX4uAa28gwlRebvtOs.3yzU9FOQfxp4l4GYECI0SE1SR7nvafW');

Select * from tblAccount

update tblAccount
set archiveFlag = 2
where
