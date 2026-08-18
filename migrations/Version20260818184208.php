<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260818184208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dietary_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, restriction_level INT NOT NULL, UNIQUE INDEX UNIQ_BDDB89495E237E06 (name), UNIQUE INDEX UNIQ_BDDB89494C80AE2 (restriction_level), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6BAF78705E237E06 (name), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE planned_meal (id INT AUTO_INCREMENT NOT NULL, scheduled_for DATE NOT NULL, meal_time VARCHAR(255) NOT NULL, user_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_25AEE301A76ED395 (user_id), INDEX IDX_25AEE30159D8A214 (recipe_id), UNIQUE INDEX unique_planned_meal (user_id, recipe_id, scheduled_for, meal_time), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, cooking_time_minutes INT NOT NULL, short_description LONGTEXT DEFAULT NULL, instructions LONGTEXT NOT NULL, source VARCHAR(255) DEFAULT NULL, servings INT NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, dietary_type_id INT NOT NULL, creator_id INT NOT NULL, INDEX IDX_DA88B137E24A5B9C (dietary_type_id), INDEX IDX_DA88B13761220EA6 (creator_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE recipe_ingredient (id INT AUTO_INCREMENT NOT NULL, quantity NUMERIC(10, 2) NOT NULL, unit VARCHAR(20) NOT NULL, specification VARCHAR(255) DEFAULT NULL, recipe_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_22D1FE1359D8A214 (recipe_id), INDEX IDX_22D1FE13933FE08C (ingredient_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, is_blocked TINYINT NOT NULL, dietary_type_id INT DEFAULT NULL, INDEX IDX_8D93D649E24A5B9C (dietary_type_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE planned_meal ADD CONSTRAINT FK_25AEE301A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE planned_meal ADD CONSTRAINT FK_25AEE30159D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137E24A5B9C FOREIGN KEY (dietary_type_id) REFERENCES dietary_type (id)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13761220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE1359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE13933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E24A5B9C FOREIGN KEY (dietary_type_id) REFERENCES dietary_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planned_meal DROP FOREIGN KEY FK_25AEE301A76ED395');
        $this->addSql('ALTER TABLE planned_meal DROP FOREIGN KEY FK_25AEE30159D8A214');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137E24A5B9C');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13761220EA6');
        $this->addSql('ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE1359D8A214');
        $this->addSql('ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE13933FE08C');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E24A5B9C');
        $this->addSql('DROP TABLE dietary_type');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE planned_meal');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_ingredient');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
