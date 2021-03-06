<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190206101652 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bureau ADD responsable_ecole_de_foot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4BC31C145 FOREIGN KEY (responsable_ecole_de_foot_id) REFERENCES licencie (id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4BC31C145 ON bureau (responsable_ecole_de_foot_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4BC31C145');
        $this->addSql('DROP INDEX IDX_166FDEC4BC31C145 ON bureau');
        $this->addSql('ALTER TABLE bureau DROP responsable_ecole_de_foot_id');
    }
}
