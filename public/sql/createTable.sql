create table tblAccount(

    accountID serial primary key,
    name varchar(45),
    username varchar(45),
    password varchar(45),
    accountType varchar(45)

);

select * from tblAccount