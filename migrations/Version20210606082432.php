<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210606082432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page ADD is_featured TINYINT(1) NOT NULL, ADD is_about TINYINT(1) NOT NULL, ADD is_team TINYINT(1) NOT NULL, ADD is_partenaire TINYINT(1) NOT NULL, ADD is_conseiladmin TINYINT(1) NOT NULL, ADD is_projetsocial TINYINT(1) NOT NULL, ADD is_benevole TINYINT(1) NOT NULL, ADD is_historique TINYINT(1) NOT NULL, ADD is_organigramme TINYINT(1) NOT NULL, ADD is_venir TINYINT(1) NOT NULL, ADD is_mentionslegales TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page DROP is_featured, DROP is_about, DROP is_team, DROP is_partenaire, DROP is_conseiladmin, DROP is_projetsocial, DROP is_benevole, DROP is_historique, DROP is_organigramme, DROP is_venir, DROP is_mentionslegales');
    }
}
