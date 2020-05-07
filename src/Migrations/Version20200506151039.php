<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506151039 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_line (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, clothe_id_id INT NOT NULL, child TINYINT(1) NOT NULL, INDEX IDX_9CE58EE1FCDAEAAA (order_id_id), INDEX IDX_9CE58EE16D4ABA68 (clothe_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clothe (id INT AUTO_INCREMENT NOT NULL, tititle VARCHAR(255) NOT NULL, weight_adult NUMERIC(10, 2) NOT NULL, weight_child NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE means_of_paiement (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, means_of_paiement_id_id INT NOT NULL, users_id_id INT NOT NULL, reference VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_F529939897462593 (means_of_paiement_id_id), INDEX IDX_F529939898333A1E (users_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, city_id_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, adress VARCHAR(255) NOT NULL, INDEX IDX_1483A5E93CCE3900 (city_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE1FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE16D4ABA68 FOREIGN KEY (clothe_id_id) REFERENCES clothe (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939897462593 FOREIGN KEY (means_of_paiement_id_id) REFERENCES means_of_paiement (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939898333A1E FOREIGN KEY (users_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E93CCE3900 FOREIGN KEY (city_id_id) REFERENCES city (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE16D4ABA68');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939897462593');
        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE1FCDAEAAA');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E93CCE3900');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939898333A1E');
        $this->addSql('DROP TABLE order_line');
        $this->addSql('DROP TABLE clothe');
        $this->addSql('DROP TABLE means_of_paiement');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE users');
    }
}
