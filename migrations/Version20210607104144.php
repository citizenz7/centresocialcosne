<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607104144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8755515FF7747B4 ON activite (titre)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8755515989D9B62 ON activite (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_B8755515FF7747B4 ON activite');
        $this->addSql('DROP INDEX UNIQ_B8755515989D9B62 ON activite');
    }
}
