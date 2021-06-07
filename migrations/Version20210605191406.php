<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210605191406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD views INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E66FF7747B4 ON article (titre)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E66989D9B62 ON article (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_497DD634FF7747B4 ON categorie (titre)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_497DD634989D9B62 ON categorie (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_140AB620FF7747B4 ON page (titre)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_140AB620989D9B62 ON page (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_23A0E66FF7747B4 ON article');
        $this->addSql('DROP INDEX UNIQ_23A0E66989D9B62 ON article');
        $this->addSql('ALTER TABLE article DROP views');
        $this->addSql('DROP INDEX UNIQ_497DD634FF7747B4 ON categorie');
        $this->addSql('DROP INDEX UNIQ_497DD634989D9B62 ON categorie');
        $this->addSql('DROP INDEX UNIQ_140AB620FF7747B4 ON page');
        $this->addSql('DROP INDEX UNIQ_140AB620989D9B62 ON page');
    }
}
