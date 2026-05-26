drop database if exists facturationdb;
create database facturationdb character set uft8;
use facturationdb;

create table facture (
    idfacture int not null auto_increment,
    reference varchar(128) unique,
    client varchar(128),
    telephone varchar(128),
    produit varchar(128),
    pu decimal,
    qte int,
    datefacture date,
    primary key (idfacture)
);