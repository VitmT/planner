<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519123911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reccuring_event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, default_timestamp DATETIME NOT NULL, reccurence_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reccuring_event_occurence (id INT AUTO_INCREMENT NOT NULL, reccuring_event_id INT NOT NULL, timestamp DATETIME NOT NULL, duration INT NOT NULL, INDEX IDX_DB1369DCE61EC4E7 (reccuring_event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_reccuring_event (user_id INT NOT NULL, reccuring_event_id INT NOT NULL, INDEX IDX_8973F6E8A76ED395 (user_id), INDEX IDX_8973F6E8E61EC4E7 (reccuring_event_id), PRIMARY KEY(user_id, reccuring_event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reccuring_event_occurence ADD CONSTRAINT FK_DB1369DCE61EC4E7 FOREIGN KEY (reccuring_event_id) REFERENCES reccuring_event (id)');
        $this->addSql('ALTER TABLE user_reccuring_event ADD CONSTRAINT FK_8973F6E8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_reccuring_event ADD CONSTRAINT FK_8973F6E8E61EC4E7 FOREIGN KEY (reccuring_event_id) REFERENCES reccuring_event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reccuring_event_occurence DROP FOREIGN KEY FK_DB1369DCE61EC4E7');
        $this->addSql('ALTER TABLE user_reccuring_event DROP FOREIGN KEY FK_8973F6E8A76ED395');
        $this->addSql('ALTER TABLE user_reccuring_event DROP FOREIGN KEY FK_8973F6E8E61EC4E7');
        $this->addSql('DROP TABLE reccuring_event');
        $this->addSql('DROP TABLE reccuring_event_occurence');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_reccuring_event');
    }
}
