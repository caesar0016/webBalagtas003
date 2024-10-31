create table tblAccount(

    accountID serial primary key,
    name varchar(45),
    username varchar(45),
    password text,
    accountType varchar(45),
    archiveFlag smallint DEFAULT 1

);

Select * from tblAccount

update tblAccount
set archiveFlag = 2
where