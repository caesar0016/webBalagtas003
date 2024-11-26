create table tblAccount(

    accountID serial primary key,
    name varchar(45),
    username varchar(45),
    password text,
    accountType varchar(45),
    archiveFlag smallint DEFAULT 1

);

insert into tblAccount(name, username, password, accountType) 
    values ('Admin', 'admin0016', '1234567');

Select * from tblAccount

update tblAccount
set archiveFlag = 2
where
