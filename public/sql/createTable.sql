create table tblAccount(

    accountID serial primary key,
    name varchar(45),
    username varchar(45),
    password text,
    accountType varchar(45),
    archiveFlag smallint DEFAULT 1

);

insert into tblAccount(name, username, password, accountType) 
    values ('Admin', 'admin0016', '$2y$10$fxBvX4uAa28gwlRebvtOs.3yzU9FOQfxp4l4GYECI0SE1SR7nvafW', 'Admin');

Select * from tblAccount

DROP TABLE "Data 1", "Data 2", "Data 3";  --drop table


--this query shows all of the table inside the database
SELECT table_name
FROM information_schema.tables
WHERE table_schema = 'public'
ORDER BY table_name;


