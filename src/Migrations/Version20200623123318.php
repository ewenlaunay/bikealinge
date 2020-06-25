<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200623123318 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clothe CHANGE weight_adult weight_adult NUMERIC(10, 3) NOT NULL, CHANGE weight_child weight_child NUMERIC(10, 3) NOT NULL');
        $this->addSql('ALTER TABLE order_has_clothe CHANGE adult adult TINYINT(1) NOT NULL, CHANGE child child TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clothe CHANGE weight_adult weight_adult NUMERIC(10, 2) NOT NULL, CHANGE weight_child weight_child NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE order_has_clothe CHANGE adult adult TINYINT(1) DEFAULT NULL, CHANGE child child TINYINT(1) DEFAULT NULL');
    }
}
