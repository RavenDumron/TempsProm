
-- Création de la BDD
CREATE DATABASE IF NOT EXISTS `temps_prometech`;
USE `temps_prometech`;

-- Création de la table temps
CREATE TABLE IF NOT EXISTS `temps` (
    `id_temps` int NOT NULL AUTO_INCREMENT,
    `debut_intervention` datetime NOT NULL default CURRENT_TIMESTAMP,
    `fin_intervention` datetime NOT NULL default CURRENT_TIMESTAMP,
    `temps_total` int(8) NOT NULL,
    `id_client` int(11) NOT NULL,
    PRIMARY KEY (`id_temps`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Création de la table clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;


delete from `temps`;
insert into `temps` (`id_temps`, `debut_intervention`, `fin_intervention`, `temps_total`, `id_client`) values (1, '2024-11-03 09:33:25', '2024-11-03 10:33:25', '3600', 1);
insert into `temps` (`id_temps`, `debut_intervention`, `fin_intervention`, `temps_total`, `id_client`) values (2, '2024-11-03 11:25:03', '2024-11-03 11:33:03', '480', 2);
insert into `temps` (`id_temps`, `debut_intervention`, `fin_intervention`, `temps_total`, `id_client`) values (3, '2024-11-05 10:25:03', '2024-11-05 11:25:03', '3600', 1);
insert into `temps` (`id_temps`, `debut_intervention`, `fin_intervention`, `temps_total`, `id_client`) values (4, '2024-11-05 13:25:03', '2024-11-05 14:25:03', '3600', 2);
insert into `temps` (`id_temps`, `debut_intervention`, `fin_intervention`, `temps_total`, `id_client`) values (5, '2024-11-06 09:19:05', '2024-11-03 09:49:05', '1800', 3);
insert into `temps` (`id_temps`, `debut_intervention`, `fin_intervention`, `temps_total`, `id_client`) values (6, '2024-11-07 10:25:03', '2024-11-05 11:25:03', '3600', 4);
insert into `temps` (`id_temps`, `debut_intervention`, `fin_intervention`, `temps_total`, `id_client`) values (7, '2024-11-07 13:25:03', '2024-11-05 14:25:03', '3600', 2);
insert into `temps` (`id_temps`, `debut_intervention`, `fin_intervention`, `temps_total`, `id_client`) values (8, '2024-11-09 09:33:25', '2024-11-09 10:33:25', '3600', 1);
insert into `temps` (`id_temps`, `debut_intervention`, `fin_intervention`, `temps_total`, `id_client`) values (9, '2024-11-09 11:25:03', '2024-11-09 11:33:03', '480', 2);

delete from `clients`;
insert into `clients` (`id_client`, `nom`) values ( 1, "Client 1");
insert into `clients` (`id_client`, `nom`) values ( 2, "Client 2");
insert into `clients` (`id_client`, `nom`) values ( 3, "Client 3");
insert into `clients` (`id_client`, `nom`) values ( 4, "Client 4");