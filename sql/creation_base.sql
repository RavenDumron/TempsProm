
-- Création de la BDD
CREATE DATABASE IF NOT EXISTS `prometech_times`;
USE `prometech_times`;

-- Création de la table temps
CREATE TABLE IF NOT EXISTS `interventions` (
    `intervention_id` int NOT NULL AUTO_INCREMENT,
    `intervention_start` datetime NOT NULL default CURRENT_TIMESTAMP,
    `intervention_end` datetime NOT NULL default CURRENT_TIMESTAMP,
    `total_time` int(8) NOT NULL,
    `client_id` int(11) NOT NULL,
    PRIMARY KEY (`intervention_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Création de la table clients
CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `budgeted_time` int (8) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;


delete from `interventions`;
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (0, '2024-11-03 09:33:25', '2024-11-03 10:33:25', '3600', 0);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (1, '2024-11-03 11:25:03', '2024-11-03 11:33:03', '480', 2);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (2, '2024-11-05 10:25:03', '2024-11-05 11:25:03', '3600', 1);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (3, '2024-11-05 13:25:03', '2024-11-05 14:25:03', '3600', 2);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (4, '2024-11-06 09:19:05', '2024-11-03 09:49:05', '1800', 3);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (5, '2024-11-07 10:25:03', '2024-11-05 11:25:03', '3600', 4);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (6, '2024-11-07 13:25:03', '2024-11-05 14:25:03', '3600', 2);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (7, '2024-11-09 09:33:25', '2024-11-09 10:33:25', '3600', 1);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (8, '2024-11-09 11:25:03', '2024-11-09 11:33:03', '480', 0);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (9, '2024-12-03 09:33:25', '2024-12-03 10:33:25', '3600', 1);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (10, '2024-12-03 11:25:03', '2024-12-03 11:33:03', '480', 2);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (11, '2024-12-05 10:25:03', '2024-12-05 11:25:03', '3600', 0);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (12, '2024-12-05 13:25:03', '2024-12-05 14:25:03', '3600', 2);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (13, '2024-12-06 09:19:05', '2024-12-03 09:49:05', '1800', 3);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (14, '2024-12-07 10:25:03', '2024-12-05 11:25:03', '3600', 4);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (15, '2024-12-07 13:25:03', '2024-12-05 14:25:03', '3600', 2);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (16, '2024-12-09 09:33:25', '2024-12-09 10:33:25', '3600', 1);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (17, '2024-12-09 11:25:03', '2024-12-09 11:33:03', '480', 2);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (18, '2024-12-10 09:19:05', '2024-12-10 09:49:05', '1800', 3);
insert into `interventions` (`intervention_id`, `intervention_start`, `intervention_end`, `total_time`, `client_id`) values (19, '2024-12-11 10:25:03', '2024-12-11 11:25:03', '3600', 0);

delete from `clients`;
insert into `clients` (`client_id`, `name`, `budgeted_time`) values ( 0, "Client 1", "1800000");
insert into `clients` (`client_id`, `name`, `budgeted_time`) values ( 1, "Client 2", "180000");
insert into `clients` (`client_id`, `name`, `budgeted_time`) values ( 2, "Client 3", "360000");
insert into `clients` (`client_id`, `name`, `budgeted_time`) values ( 3, "Client 4", "150000");