CREATE DATABASE mainDB; 

USE mainDB;

CREATE TABLE players ( 
first_name varchar(32) NOT NULL,
last_name varchar(32) NOT NULL,
position varchar(32) NOT NULL,
number int(3) NOT NULL,
points int(3) NOT NULL,
plus_minus int(11) NOT NULL,
PRIMARY KEY (`number`) );

CREATE TABLE drills ( 
name varchar(32) NOT NULL,
category varchar(32) NOT NULL,
canvas longtext NOT NULL,
description longtext NOT NULL,
PRIMARY KEY (`name`) );

CREATE TABLE lineups (
id int(11) NOT NULL AUTO_INCREMENT,
lineup_type varchar(32) NOT NULL, /*Power, Balanced, Defense, Custom*/
line_num int(11) NOT NULL,
player_num int(3) NOT NULL,
description longtext,
PRIMARY KEY (`id`) ,
FOREIGN KEY (`player_num`) REFERENCES players(`number`)
);


INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('John', 'Smith', 'Right Wing', 10, 7, 5);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Alex', 'Martin', 'Left Wing', 22, 8, -2);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Adam', 'Sandler', 'Center', 69, 5, 4);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Josh', 'Gift', 'Left Defense',37, 7, -2);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Martin', 'Riggs', 'Right Defense', 47, 12, 2);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Phillip', 'Philips', 'Right Wing', 82, 14, 3);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Sarah', 'Sands', 'Left Wing', 13, 3, 3);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Mark', 'Plier', 'Center', 72, 5, -2);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Tristan', 'Empires', 'Left Defense', 90, 6, 1);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('David', 'Goliath', 'Right Defense', 24, 3, 4);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Darth', 'Vader', 'Right Wing', 34, 5, 6);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Luke', 'Walker', 'Left Wing', 17, 6, 2);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Jar', 'Binks', 'Center', 86, 3, 5);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Leo', 'Hardy', 'Left Defense', 55, 0, 2);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Emma', 'Watson', 'Right Defense', 49, 8, 1);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('V', 'Sauce', 'Goalie', 1, 0, 0);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Crystal', 'Yeo', 'Goalie', 2, 0, 0);
INSERT INTO players (first_name, last_name,position, number, points, plus_minus)
VALUES ('Britney', 'Spheres', 'Goalie', 3, 0, 0);

INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom", 1, 22);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom", 1, 69);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom", 1, 37);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom", 1, 47);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom", 1, 82);

INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom", 2, 13);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom", 2, 72);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom", 2, 90);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom", 2, 24);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom", 2, 34);

INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom2", 1, 17);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom2", 1, 86);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom2", 1, 55);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom2", 1, 49);
INSERT INTO lineups (lineup_type, line_num, player_num)
VALUES ("Custom2", 1, 10);