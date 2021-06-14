<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210614040326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B875551560BB6FE6');
        $this->addSql('DROP INDEX IDX_B875551560BB6FE6 ON activite');
        $this->addSql('ALTER TABLE activite DROP auteur_id');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB62060BB6FE6');
        $this->addSql('DROP INDEX IDX_140AB62060BB6FE6 ON page');
        $this->addSql('ALTER TABLE page DROP auteur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite ADD auteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B875551560BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B875551560BB6FE6 ON activite (auteur_id)');
        $this->addSql('ALTER TABLE page ADD auteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB62060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_140AB62060BB6FE6 ON page (auteur_id)');
    }
}
