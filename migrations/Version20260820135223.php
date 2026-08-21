<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260820135223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add servings to planned meals and initialise existing rows from their recipes.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE planned_meal ADD servings INT DEFAULT NULL');
        $this->addSql('UPDATE planned_meal pm INNER JOIN recipe r ON pm.recipe_id = r.id SET pm.servings = r.servings');
        $this->addSql('ALTER TABLE planned_meal MODIFY servings INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE planned_meal DROP servings');
    }
}
