<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200520145458 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE birth_date birth_date DATE NOT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d6498bac62af TO IDX_8D93D6498BAC62AF');
        $this->addSql('ALTER TABLE order_has_clothe DROP FOREIGN KEY FK_5CD9FF74CFFE9AD6');
        $this->addSql('DROP INDEX IDX_5CD9FF74CFFE9AD6 ON order_has_clothe');
        $this->addSql('ALTER TABLE order_has_clothe CHANGE orders_id order_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_has_clothe ADD CONSTRAINT FK_5CD9FF748D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_5CD9FF748D9F6D38 ON order_has_clothe (order_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_has_clothe DROP FOREIGN KEY FK_5CD9FF748D9F6D38');
        $this->addSql('DROP INDEX IDX_5CD9FF748D9F6D38 ON order_has_clothe');
        $this->addSql('ALTER TABLE order_has_clothe CHANGE order_id orders_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_has_clothe ADD CONSTRAINT FK_5CD9FF74CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_5CD9FF74CFFE9AD6 ON order_has_clothe (orders_id)');
        $this->addSql('ALTER TABLE user CHANGE birth_date birth_date DATE DEFAULT NULL, CHANGE roles roles VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_8d93d6498bac62af TO UNIQ_8D93D6498BAC62AF');
    }
}
