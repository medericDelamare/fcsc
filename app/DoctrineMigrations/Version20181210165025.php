<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181210165025 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bureau ADD membre1_id INT DEFAULT NULL, ADD membre2_id INT DEFAULT NULL, ADD membre3_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4400F1CEA FOREIGN KEY (membre1_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC452BAB304 FOREIGN KEY (membre2_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC4EA06D461 FOREIGN KEY (membre3_id) REFERENCES licencie (id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4400F1CEA ON bureau (membre1_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC452BAB304 ON bureau (membre2_id)');
        $this->addSql('CREATE INDEX IDX_166FDEC4EA06D461 ON bureau (membre3_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4400F1CEA');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC452BAB304');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC4EA06D461');
        $this->addSql('DROP INDEX IDX_166FDEC4400F1CEA ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC452BAB304 ON bureau');
        $this->addSql('DROP INDEX IDX_166FDEC4EA06D461 ON bureau');
        $this->addSql('ALTER TABLE bureau DROP membre1_id, DROP membre2_id, DROP membre3_id');
    }
}
