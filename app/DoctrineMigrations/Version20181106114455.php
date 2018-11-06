<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181106114455 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bureau (id INT AUTO_INCREMENT NOT NULL, president_id INT DEFAULT NULL, vice_president_id INT DEFAULT NULL, vice_president2_id INT DEFAULT NULL, vice_president3_id INT DEFAULT NULL, secretaire_id INT DEFAULT NULL, tresorier_id INT DEFAULT NULL, responsable_pole_jeunes_id INT DEFAULT NULL, responsable_pole_seniors_id INT DEFAULT NULL, responsable_senior_a_id INT DEFAULT NULL, responsable_senior_b_id INT DEFAULT NULL, responsable_u18_id INT DEFAULT NULL, responsabe_u15_id INT DEFAULT NULL, responsable_u13_id INT DEFAULT NULL, responsable_u11_id INT DEFAULT NULL, responsable_u9_id INT DEFAULT NULL, responsable_u7_id INT DEFAULT NULL, INDEX IDX_166FDEC4B40A33C7 (president_id), INDEX IDX_166FDEC4544DD2AD (vice_president_id), INDEX IDX_166FDEC46CEA10FA (vice_president2_id), INDEX IDX_166FDEC4D456779F (vice_president3_id), INDEX IDX_166FDEC4A90F02B2 (secretaire_id), INDEX IDX_166FDEC45014067D (tresorier_id), INDEX IDX_166FDEC47337B896 (responsable_pole_jeunes_id), INDEX IDX_166FDEC45D580FEB (responsable_pole_seniors_id), INDEX IDX_166FDEC4FBB5C6E7 (responsable_senior_a_id), INDEX IDX_166FDEC4E9006909 (responsable_senior_b_id), INDEX IDX_166FDEC4792EF1DA (responsable_u18_id), INDEX IDX_166FDEC4D06C909F (responsabe_u15_id), INDEX IDX_166FDEC4AE2F76DB (responsable_u13_id), INDEX IDX_166FDEC4426BE50 (responsable_u11_id), INDEX IDX_166FDEC482A216C9 (responsable_u9_id), INDEX IDX_166FDEC4627D61FA (responsable_u7_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE but (id INT AUTO_INCREMENT NOT NULL, stats_rencontres_id INT NOT NULL, buteur_id INT NOT NULL, passeur_id INT DEFAULT NULL, penalty TINYINT(1) NOT NULL, INDEX IDX_B132FECAA1FF9E2A (stats_rencontres_id), INDEX IDX_B132FECA59365323 (buteur_id), INDEX IDX_B132FECA90B9A1AF (passeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carriere_joueur (id INT AUTO_INCREMENT NOT NULL, licencie_id INT DEFAULT NULL, club_id INT DEFAULT NULL, saison VARCHAR(255) NOT NULL, sous_categorie VARCHAR(255) NOT NULL, club_parse VARCHAR(255) NOT NULL, INDEX IDX_44BC27BBB56DCD74 (licencie_id), INDEX IDX_44BC27BB61190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_497DD6346C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, couleur_principale VARCHAR(255) DEFAULT NULL, couleur_secondaire VARCHAR(255) DEFAULT NULL, updated DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_B8EE38726C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club_fifa (id INT AUTO_INCREMENT NOT NULL, championnat VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, club_id INT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, nom_parse VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, division VARCHAR(255) DEFAULT NULL, categorie VARCHAR(255) NOT NULL, stats_points INT DEFAULT NULL, stats_journees INT DEFAULT NULL, stats_victoires INT DEFAULT NULL, stats_nuls INT DEFAULT NULL, stats_defaites INT DEFAULT NULL, stats_forfaits INT DEFAULT NULL, stats_buts_pour INT DEFAULT NULL, stats_buts_contre INT DEFAULT NULL, stats_penalites INT DEFAULT NULL, stats_difference INT DEFAULT NULL, INDEX IDX_2449BA1561190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_classement (id INT AUTO_INCREMENT NOT NULL, annee VARCHAR(255) NOT NULL, position INT NOT NULL, nb_points INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_stats (id INT AUTO_INCREMENT NOT NULL, licencie_id INT DEFAULT NULL, saison VARCHAR(255) NOT NULL, nb_buts INT DEFAULT NULL, nb_passes INT DEFAULT NULL, nb_cartons_jaunes INT DEFAULT NULL, nb_cartons_rouges INT DEFAULT NULL, INDEX IDX_19C7BDD9B56DCD74 (licencie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE licencie (id INT AUTO_INCREMENT NOT NULL, stats_id INT DEFAULT NULL, numero_licence BIGINT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, categorie VARCHAR(255) DEFAULT NULL, nationalite VARCHAR(255) NOT NULL, date_de_naissance DATETIME NOT NULL, lieu_de_naissance VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, joueur TINYINT(1) NOT NULL, dirigeant TINYINT(1) NOT NULL, educateur TINYINT(1) NOT NULL, telephone_domicile VARCHAR(255) DEFAULT NULL, telephone_portable VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_3B755612DBFEF8E9 (numero_licence), UNIQUE INDEX UNIQ_3B75561270AA3482 (stats_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nom_parse (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_782D18FD6C6E55B5 (nom), INDEX IDX_782D18FD61190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, reference VARCHAR(255) NOT NULL, nom_nike VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, photo VARCHAR(255) NOT NULL, logo_obligatoire TINYINT(1) NOT NULL, logo TINYINT(1) NOT NULL, initiales TINYINT(1) NOT NULL, INDEX IDX_29A5EC27BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rencontre (id INT AUTO_INCREMENT NOT NULL, equipe_domicile_id INT NOT NULL, equipe_exterieure_id INT NOT NULL, journee INT DEFAULT NULL, arbitre VARCHAR(255) DEFAULT NULL, terrain VARCHAR(255) DEFAULT NULL, score VARCHAR(255) DEFAULT NULL, surface_de_jeu VARCHAR(255) DEFAULT NULL, date DATETIME DEFAULT NULL, INDEX IDX_460C35ED5FE1AEAD (equipe_domicile_id), INDEX IDX_460C35ED8923FCCA (equipe_exterieure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_52743D7B6C6E55B5 (nom), INDEX IDX_52743D7BBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats_joueur (id INT AUTO_INCREMENT NOT NULL, poste_id INT DEFAULT NULL, buts_a INT DEFAULT NULL, buts_b INT DEFAULT NULL, buts_coupe INT DEFAULT NULL, buts INT DEFAULT NULL, cartons_jaunes INT DEFAULT NULL, cartons_rouges INT DEFAULT NULL, passes INT DEFAULT NULL, nb_matchs INT DEFAULT NULL, INDEX IDX_4E614EC6A0905086 (poste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats_par_journee (id INT AUTO_INCREMENT NOT NULL, equipe_id INT NOT NULL, journee INT NOT NULL, place INT NOT NULL, INDEX IDX_676E9EA16D861B89 (equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats_rencontre (id INT AUTO_INCREMENT NOT NULL, rencontre_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_48C2FE486CFC0818 (rencontre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueurs_rencontres (stats_rencontre_id INT NOT NULL, licencie_id INT NOT NULL, INDEX IDX_D93B68A2E79D76AF (stats_rencontre_id), INDEX IDX_D93B68A2B56DCD74 (licencie_id), PRIMARY KEY(stats_rencontre_id, licencie_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueurs_cartons_jaunes (stats_rencontre_id INT NOT NULL, licencie_id INT NOT NULL, INDEX IDX_7673F969E79D76AF (stats_rencontre_id), INDEX IDX_7673F969B56DCD74 (licencie_id), PRIMARY KEY(stats_rencontre_id, licencie_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueurs_cartons_rouges (stats_rencontre_id INT NOT NULL, licencie_id INT NOT NULL, INDEX IDX_2917FC71E79D76AF (stats_rencontre_id), INDEX IDX_2917FC71B56DCD74 (licencie_id), PRIMARY KEY(stats_rencontre_id, licencie_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, club_fifa_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), INDEX IDX_957A64795B515318 (club_fifa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4B40A33C7 FOREIGN KEY (president_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4544DD2AD FOREIGN KEY (vice_president_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC46CEA10FA FOREIGN KEY (vice_president2_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4D456779F FOREIGN KEY (vice_president3_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4A90F02B2 FOREIGN KEY (secretaire_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC45014067D FOREIGN KEY (tresorier_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC47337B896 FOREIGN KEY (responsable_pole_jeunes_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC45D580FEB FOREIGN KEY (responsable_pole_seniors_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4FBB5C6E7 FOREIGN KEY (responsable_senior_a_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4E9006909 FOREIGN KEY (responsable_senior_b_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4792EF1DA FOREIGN KEY (responsable_u18_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4D06C909F FOREIGN KEY (responsabe_u15_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4AE2F76DB FOREIGN KEY (responsable_u13_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4426BE50 FOREIGN KEY (responsable_u11_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC482A216C9 FOREIGN KEY (responsable_u9_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4627D61FA FOREIGN KEY (responsable_u7_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE but ADD CONSTRAINT FK_B132FECAA1FF9E2A FOREIGN KEY (stats_rencontres_id) REFERENCES stats_rencontre (id)');
        $this->addSql('ALTER TABLE but ADD CONSTRAINT FK_B132FECA59365323 FOREIGN KEY (buteur_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE but ADD CONSTRAINT FK_B132FECA90B9A1AF FOREIGN KEY (passeur_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE carriere_joueur ADD CONSTRAINT FK_44BC27BBB56DCD74 FOREIGN KEY (licencie_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE carriere_joueur ADD CONSTRAINT FK_44BC27BB61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1561190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE historique_stats ADD CONSTRAINT FK_19C7BDD9B56DCD74 FOREIGN KEY (licencie_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B75561270AA3482 FOREIGN KEY (stats_id) REFERENCES stats_joueur (id)');
        $this->addSql('ALTER TABLE nom_parse ADD CONSTRAINT FK_782D18FD61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED5FE1AEAD FOREIGN KEY (equipe_domicile_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED8923FCCA FOREIGN KEY (equipe_exterieure_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE stats_joueur ADD CONSTRAINT FK_4E614EC6A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE stats_par_journee ADD CONSTRAINT FK_676E9EA16D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE stats_rencontre ADD CONSTRAINT FK_48C2FE486CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id)');
        $this->addSql('ALTER TABLE joueurs_rencontres ADD CONSTRAINT FK_D93B68A2E79D76AF FOREIGN KEY (stats_rencontre_id) REFERENCES stats_rencontre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueurs_rencontres ADD CONSTRAINT FK_D93B68A2B56DCD74 FOREIGN KEY (licencie_id) REFERENCES licencie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueurs_cartons_jaunes ADD CONSTRAINT FK_7673F969E79D76AF FOREIGN KEY (stats_rencontre_id) REFERENCES stats_rencontre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueurs_cartons_jaunes ADD CONSTRAINT FK_7673F969B56DCD74 FOREIGN KEY (licencie_id) REFERENCES licencie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueurs_cartons_rouges ADD CONSTRAINT FK_2917FC71E79D76AF FOREIGN KEY (stats_rencontre_id) REFERENCES stats_rencontre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueurs_cartons_rouges ADD CONSTRAINT FK_2917FC71B56DCD74 FOREIGN KEY (licencie_id) REFERENCES licencie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64795B515318 FOREIGN KEY (club_fifa_id) REFERENCES club_fifa (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BBCF5E72D');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE carriere_joueur DROP FOREIGN KEY FK_44BC27BB61190A32');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1561190A32');
        $this->addSql('ALTER TABLE nom_parse DROP FOREIGN KEY FK_782D18FD61190A32');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64795B515318');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED5FE1AEAD');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED8923FCCA');
        $this->addSql('ALTER TABLE stats_par_journee DROP FOREIGN KEY FK_676E9EA16D861B89');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4B40A33C7');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4544DD2AD');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC46CEA10FA');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4D456779F');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4A90F02B2');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC45014067D');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC47337B896');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC45D580FEB');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4FBB5C6E7');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4E9006909');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4792EF1DA');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4D06C909F');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4AE2F76DB');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4426BE50');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC482A216C9');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4627D61FA');
        $this->addSql('ALTER TABLE but DROP FOREIGN KEY FK_B132FECA59365323');
        $this->addSql('ALTER TABLE but DROP FOREIGN KEY FK_B132FECA90B9A1AF');
        $this->addSql('ALTER TABLE carriere_joueur DROP FOREIGN KEY FK_44BC27BBB56DCD74');
        $this->addSql('ALTER TABLE historique_stats DROP FOREIGN KEY FK_19C7BDD9B56DCD74');
        $this->addSql('ALTER TABLE joueurs_rencontres DROP FOREIGN KEY FK_D93B68A2B56DCD74');
        $this->addSql('ALTER TABLE joueurs_cartons_jaunes DROP FOREIGN KEY FK_7673F969B56DCD74');
        $this->addSql('ALTER TABLE joueurs_cartons_rouges DROP FOREIGN KEY FK_2917FC71B56DCD74');
        $this->addSql('ALTER TABLE stats_joueur DROP FOREIGN KEY FK_4E614EC6A0905086');
        $this->addSql('ALTER TABLE stats_rencontre DROP FOREIGN KEY FK_48C2FE486CFC0818');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B75561270AA3482');
        $this->addSql('ALTER TABLE but DROP FOREIGN KEY FK_B132FECAA1FF9E2A');
        $this->addSql('ALTER TABLE joueurs_rencontres DROP FOREIGN KEY FK_D93B68A2E79D76AF');
        $this->addSql('ALTER TABLE joueurs_cartons_jaunes DROP FOREIGN KEY FK_7673F969E79D76AF');
        $this->addSql('ALTER TABLE joueurs_cartons_rouges DROP FOREIGN KEY FK_2917FC71E79D76AF');
        $this->addSql('DROP TABLE bureau');
        $this->addSql('DROP TABLE but');
        $this->addSql('DROP TABLE carriere_joueur');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_produit');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE club_fifa');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE historique_classement');
        $this->addSql('DROP TABLE historique_stats');
        $this->addSql('DROP TABLE licencie');
        $this->addSql('DROP TABLE nom_parse');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE rencontre');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP TABLE stats_joueur');
        $this->addSql('DROP TABLE stats_par_journee');
        $this->addSql('DROP TABLE stats_rencontre');
        $this->addSql('DROP TABLE joueurs_rencontres');
        $this->addSql('DROP TABLE joueurs_cartons_jaunes');
        $this->addSql('DROP TABLE joueurs_cartons_rouges');
        $this->addSql('DROP TABLE fos_user');
    }
}
