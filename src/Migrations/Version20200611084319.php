<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200611084319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clothe (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, composition VARCHAR(255) NOT NULL, weight_adult NUMERIC(10, 2) NOT NULL, weight_child NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, mean_of_paiement_id INT DEFAULT NULL, status_id INT NOT NULL, formule_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), INDEX IDX_F5299398C974A4A0 (mean_of_paiement_id), INDEX IDX_F52993986BF700BD (status_id), INDEX IDX_F52993982A68F4D1 (formule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, cp INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, adress VARCHAR(255) NOT NULL, roles JSON NOT NULL, activation_token VARCHAR(255) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6498BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formule (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rememberme_token (id INT AUTO_INCREMENT NOT NULL, series VARCHAR(88) NOT NULL, value VARCHAR(88) NOT NULL, last_used DATETIME NOT NULL, class VARCHAR(100) NOT NULL, username VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_has_clothe (id INT AUTO_INCREMENT NOT NULL, order_id INT NOT NULL, clothe_id INT NOT NULL, adult TINYINT(1) NOT NULL, child TINYINT(1) NOT NULL, INDEX IDX_5CD9FF748D9F6D38 (order_id), INDEX IDX_5CD9FF74D554487F (clothe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mean_of_paiement (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398C974A4A0 FOREIGN KEY (mean_of_paiement_id) REFERENCES mean_of_paiement (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993986BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993982A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE order_has_clothe ADD CONSTRAINT FK_5CD9FF748D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_has_clothe ADD CONSTRAINT FK_5CD9FF74D554487F FOREIGN KEY (clothe_id) REFERENCES clothe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_has_clothe DROP FOREIGN KEY FK_5CD9FF74D554487F');
        $this->addSql('ALTER TABLE order_has_clothe DROP FOREIGN KEY FK_5CD9FF748D9F6D38');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498BAC62AF');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993982A68F4D1');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993986BF700BD');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398C974A4A0');
        $this->addSql('DROP TABLE clothe');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE formule');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE rememberme_token');
        $this->addSql('DROP TABLE order_has_clothe');
        $this->addSql('DROP TABLE mean_of_paiement');
    }
}
