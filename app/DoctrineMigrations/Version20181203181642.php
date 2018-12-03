<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181203181642 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC46CEA10FA');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4D456779F');
        $this->addSql('DROP INDEX IDX_166FDEC46CEA10FA ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC4D456779F ON bureau');
        $this->addSql('ALTER TABLE bureau ADD responsable_equipement_id INT DEFAULT NULL, DROP vice_president2_id, DROP vice_president3_id');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4FD4C25BA FOREIGN KEY (responsable_equipement_id) REFERENCES licencie (id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4FD4C25BA ON bureau (responsable_equipement_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4FD4C25BA');
        $this->addSql('DROP INDEX IDX_166FDEC4FD4C25BA ON bureau');
        $this->addSql('ALTER TABLE bureau ADD vice_president3_id INT DEFAULT NULL, CHANGE responsable_equipement_id vice_president2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC46CEA10FA FOREIGN KEY (vice_president2_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4D456779F FOREIGN KEY (vice_president3_id) REFERENCES licencie (id)');
        $this->addSql('CREATE INDEX IDX_166FDEC46CEA10FA ON bureau (vice_president2_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4D456779F ON bureau (vice_president3_id)');
        $this->addSql('ALTER TABLE fos_user ADD club_fifa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64795B515318 FOREIGN KEY (club_fifa_id) REFERENCES club_fifa (id)');
        $this->addSql('CREATE INDEX IDX_957A64795B515318 ON fos_user (club_fifa_id)');
    }
}
