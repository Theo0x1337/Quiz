<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429101137 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quizz ADD sous_titre VARCHAR(200) DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE quizz ADD is_featured TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE quizz ADD image VARCHAR(200) DEFAULT NULL, ADD thumbnail VARCHAR(200) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quizz DROP sous_titre, DROP description');
        $this->addSql('ALTER TABLE quizz DROP is_featured');
        $this->addSql('ALTER TABLE quizz DROP image, DROP thumbnail');
    }
}
