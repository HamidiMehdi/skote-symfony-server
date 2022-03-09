<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301203848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friendships (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, friend_id INT DEFAULT NULL, accepted TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, update_at DATETIME NOT NULL, INDEX IDX_E0A8B7CAA76ED395 (user_id), INDEX IDX_E0A8B7CA6A5458E8 (friend_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE friendships ADD CONSTRAINT FK_E0A8B7CAA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE friendships ADD CONSTRAINT FK_E0A8B7CA6A5458E8 FOREIGN KEY (friend_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE friendships');
        $this->addSql('ALTER TABLE refresh_tokens CHANGE refresh_token refresh_token VARCHAR(128) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE username username VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE users CHANGE firstname firstname VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE lastname lastname VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE password password LONGTEXT DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE user_from user_from VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
    }
}
