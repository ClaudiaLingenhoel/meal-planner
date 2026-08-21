<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260821120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add optional calories per serving to recipes.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recipe ADD calories_per_serving INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recipe DROP calories_per_serving');
    }
}