<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200623214933 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE licencies_fonctions (fonction_id INT NOT NULL, licencie_id INT NOT NULL, INDEX IDX_2C850E2E57889920 (fonction_id), INDEX IDX_2C850E2EB56DCD74 (licencie_id), PRIMARY KEY(fonction_id, licencie_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE licencies_fonctions ADD CONSTRAINT FK_2C850E2E57889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE licencies_fonctions ADD CONSTRAINT FK_2C850E2EB56DCD74 FOREIGN KEY (licencie_id) REFERENCES licencie (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE bureau');
        $this->addSql('ALTER TABLE licencie ADD extra_photo VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE licencies_fonctions DROP FOREIGN KEY FK_2C850E2E57889920');
        $this->addSql('CREATE TABLE bureau (id INT AUTO_INCREMENT NOT NULL, responsable_veterans_id INT DEFAULT NULL, responsable_u17_id INT DEFAULT NULL, responsable_gardiens_id INT DEFAULT NULL, membre1_id INT DEFAULT NULL, responsable_u11_id INT DEFAULT NULL, tresorier_id INT DEFAULT NULL, membre2_id INT DEFAULT NULL, vice_president_id INT DEFAULT NULL, responsable_u12u13_id INT DEFAULT NULL, responsable_pole_feminin_id INT DEFAULT NULL, membre4_id INT DEFAULT NULL, responsable_u15_id INT DEFAULT NULL, responsable_cdm_id INT DEFAULT NULL, secretaire_id INT DEFAULT NULL, president_id INT DEFAULT NULL, responsable_ecole_de_foot_id INT DEFAULT NULL, responsable_u10_id INT DEFAULT NULL, responsable_u19_id INT DEFAULT NULL, responsable_u6u9_id INT DEFAULT NULL, responsable_senior_b_id INT DEFAULT NULL, membre3_id INT DEFAULT NULL, responsable_senior_a_id INT DEFAULT NULL, responsable_equipement_id INT DEFAULT NULL, INDEX IDX_166FDEC4B40A33C7 (president_id), INDEX IDX_166FDEC4544DD2AD (vice_president_id), INDEX IDX_166FDEC4A90F02B2 (secretaire_id), INDEX IDX_166FDEC45014067D (tresorier_id), INDEX IDX_166FDEC4FD4C25BA (responsable_equipement_id), INDEX IDX_166FDEC4FBB5C6E7 (responsable_senior_a_id), INDEX IDX_166FDEC4E9006909 (responsable_senior_b_id), INDEX IDX_166FDEC41B9341C (responsable_veterans_id), INDEX IDX_166FDEC4A081AF77 (responsable_cdm_id), INDEX IDX_166FDEC4C19296BF (responsable_u19_id), INDEX IDX_166FDEC4214DE18C (responsable_u17_id), INDEX IDX_166FDEC48B442907 (responsable_u15_id), INDEX IDX_166FDEC46BD06293 (responsable_u12u13_id), INDEX IDX_166FDEC4426BE50 (responsable_u11_id), INDEX IDX_166FDEC4BC9AD935 (responsable_u10_id), INDEX IDX_166FDEC4C8C1BC07 (responsable_u6u9_id), INDEX IDX_166FDEC46C4FB8D0 (responsable_pole_feminin_id), INDEX IDX_166FDEC426D27C5B (responsable_gardiens_id), INDEX IDX_166FDEC4BC31C145 (responsable_ecole_de_foot_id), INDEX IDX_166FDEC4400F1CEA (membre1_id), INDEX IDX_166FDEC452BAB304 (membre2_id), INDEX IDX_166FDEC4EA06D461 (membre3_id), INDEX IDX_166FDEC477D1ECD8 (membre4_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC41B9341C FOREIGN KEY (responsable_veterans_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4214DE18C FOREIGN KEY (responsable_u17_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC426D27C5B FOREIGN KEY (responsable_gardiens_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4400F1CEA FOREIGN KEY (membre1_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4426BE50 FOREIGN KEY (responsable_u11_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC45014067D FOREIGN KEY (tresorier_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC452BAB304 FOREIGN KEY (membre2_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4544DD2AD FOREIGN KEY (vice_president_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC46BD06293 FOREIGN KEY (responsable_u12u13_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC46C4FB8D0 FOREIGN KEY (responsable_pole_feminin_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC477D1ECD8 FOREIGN KEY (membre4_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC48B442907 FOREIGN KEY (responsable_u15_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4A081AF77 FOREIGN KEY (responsable_cdm_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4A90F02B2 FOREIGN KEY (secretaire_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4B40A33C7 FOREIGN KEY (president_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4BC31C145 FOREIGN KEY (responsable_ecole_de_foot_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4BC9AD935 FOREIGN KEY (responsable_u10_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4C19296BF FOREIGN KEY (responsable_u19_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4C8C1BC07 FOREIGN KEY (responsable_u6u9_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4E9006909 FOREIGN KEY (responsable_senior_b_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4EA06D461 FOREIGN KEY (membre3_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4FBB5C6E7 FOREIGN KEY (responsable_senior_a_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4FD4C25BA FOREIGN KEY (responsable_equipement_id) REFERENCES licencie (id)');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE licencies_fonctions');
        $this->addSql('ALTER TABLE licencie DROP extra_photo');
    }
}
