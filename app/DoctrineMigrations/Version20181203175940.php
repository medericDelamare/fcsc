<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181203175940 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE club_fifa (id INT AUTO_INCREMENT NOT NULL, championnat VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC45D580FEB');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4627D61FA');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC47337B896');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4792EF1DA');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC482A216C9');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4AE2F76DB');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4D06C909F');
        $this->addSql('DROP INDEX IDX_166FDEC47337B896 ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC45D580FEB ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC4792EF1DA ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC4D06C909F ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC4AE2F76DB ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC482A216C9 ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC4627D61FA ON bureau');
        $this->addSql('ALTER TABLE bureau ADD responsable_veterans_id INT DEFAULT NULL, ADD responsable_cdm_id INT DEFAULT NULL, ADD responsable_u19_id INT DEFAULT NULL, ADD responsable_u17_id INT DEFAULT NULL, ADD responsable_u15_id INT DEFAULT NULL, ADD responsable_u12u13_id INT DEFAULT NULL, ADD responsable_u10_id INT DEFAULT NULL, ADD responsable_u6u9_id INT DEFAULT NULL, ADD responsable_pole_feminin_id INT DEFAULT NULL, ADD responsable_gardiens_id INT DEFAULT NULL, DROP responsable_pole_seniors_id, DROP responsable_u7_id, DROP responsable_pole_jeunes_id, DROP responsable_u18_id, DROP responsable_u9_id, DROP responsable_u13_id, DROP responsabe_u15_id');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC41B9341C FOREIGN KEY (responsable_veterans_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4A081AF77 FOREIGN KEY (responsable_cdm_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4C19296BF FOREIGN KEY (responsable_u19_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4214DE18C FOREIGN KEY (responsable_u17_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC48B442907 FOREIGN KEY (responsable_u15_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC46BD06293 FOREIGN KEY (responsable_u12u13_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4BC9AD935 FOREIGN KEY (responsable_u10_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4C8C1BC07 FOREIGN KEY (responsable_u6u9_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC46C4FB8D0 FOREIGN KEY (responsable_pole_feminin_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC426D27C5B FOREIGN KEY (responsable_gardiens_id) REFERENCES licencie (id)');
        $this->addSql('CREATE INDEX IDX_166FDEC41B9341C ON bureau (responsable_veterans_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4A081AF77 ON bureau (responsable_cdm_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4C19296BF ON bureau (responsable_u19_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4214DE18C ON bureau (responsable_u17_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC48B442907 ON bureau (responsable_u15_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC46BD06293 ON bureau (responsable_u12u13_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4BC9AD935 ON bureau (responsable_u10_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4C8C1BC07 ON bureau (responsable_u6u9_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC46C4FB8D0 ON bureau (responsable_pole_feminin_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC426D27C5B ON bureau (responsable_gardiens_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE club_fifa');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC41B9341C');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4A081AF77');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4C19296BF');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4214DE18C');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC48B442907');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC46BD06293');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4BC9AD935');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4C8C1BC07');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC46C4FB8D0');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC426D27C5B');
        $this->addSql('DROP INDEX IDX_166FDEC41B9341C ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC4A081AF77 ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC4C19296BF ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC4214DE18C ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC48B442907 ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC46BD06293 ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC4BC9AD935 ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC4C8C1BC07 ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC46C4FB8D0 ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC426D27C5B ON bureau');
        $this->addSql('ALTER TABLE bureau ADD responsable_pole_seniors_id INT DEFAULT NULL, ADD responsable_u7_id INT DEFAULT NULL, ADD responsable_pole_jeunes_id INT DEFAULT NULL, ADD responsable_u18_id INT DEFAULT NULL, ADD responsable_u9_id INT DEFAULT NULL, ADD responsable_u13_id INT DEFAULT NULL, ADD responsabe_u15_id INT DEFAULT NULL, DROP responsable_veterans_id, DROP responsable_cdm_id, DROP responsable_u19_id, DROP responsable_u17_id, DROP responsable_u15_id, DROP responsable_u12u13_id, DROP responsable_u10_id, DROP responsable_u6u9_id, DROP responsable_pole_feminin_id, DROP responsable_gardiens_id');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC45D580FEB FOREIGN KEY (responsable_pole_seniors_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4627D61FA FOREIGN KEY (responsable_u7_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC47337B896 FOREIGN KEY (responsable_pole_jeunes_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4792EF1DA FOREIGN KEY (responsable_u18_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC482A216C9 FOREIGN KEY (responsable_u9_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4AE2F76DB FOREIGN KEY (responsable_u13_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4D06C909F FOREIGN KEY (responsabe_u15_id) REFERENCES licencie (id)');
        $this->addSql('CREATE INDEX IDX_166FDEC47337B896 ON bureau (responsable_pole_jeunes_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC45D580FEB ON bureau (responsable_pole_seniors_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4792EF1DA ON bureau (responsable_u18_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4D06C909F ON bureau (responsabe_u15_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4AE2F76DB ON bureau (responsable_u13_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC482A216C9 ON bureau (responsable_u9_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4627D61FA ON bureau (responsable_u7_id)');
        $this->addSql('ALTER TABLE fos_user ADD club_fifa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64795B515318 FOREIGN KEY (club_fifa_id) REFERENCES club_fifa (id)');
        $this->addSql('CREATE INDEX IDX_957A64795B515318 ON fos_user (club_fifa_id)');
    }
}
