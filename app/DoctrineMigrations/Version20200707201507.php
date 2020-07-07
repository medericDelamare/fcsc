<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200707201507 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE entrainement_calendrier (id INT AUTO_INCREMENT NOT NULL, stade_id INT NOT NULL, titre VARCHAR(255) NOT NULL, jour INT NOT NULL, heure_depart VARCHAR(255) NOT NULL, heure_fin VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, INDEX IDX_552A16D66538AB43 (stade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entrainement_calendrier ADD CONSTRAINT FK_552A16D66538AB43 FOREIGN KEY (stade_id) REFERENCES stade (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE entrainement_calendrier');
    }
}
