<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260115103549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient_classique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ingredient_classique_pizza (ingredient_classique_id INT NOT NULL, pizza_id INT NOT NULL, INDEX IDX_5C2B997158F28195 (ingredient_classique_id), INDEX IDX_5C2B9971D41D1D42 (pizza_id), PRIMARY KEY (ingredient_classique_id, pizza_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE pates (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE ingredient_classique_pizza ADD CONSTRAINT FK_5C2B997158F28195 FOREIGN KEY (ingredient_classique_id) REFERENCES ingredient_classique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_classique_pizza ADD CONSTRAINT FK_5C2B9971D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza ADD pates_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pizza ADD CONSTRAINT FK_CFDD826FC558AD12 FOREIGN KEY (pates_id) REFERENCES pates (id)');
        $this->addSql('CREATE INDEX IDX_CFDD826FC558AD12 ON pizza (pates_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient_classique_pizza DROP FOREIGN KEY FK_5C2B997158F28195');
        $this->addSql('ALTER TABLE ingredient_classique_pizza DROP FOREIGN KEY FK_5C2B9971D41D1D42');
        $this->addSql('DROP TABLE ingredient_classique');
        $this->addSql('DROP TABLE ingredient_classique_pizza');
        $this->addSql('DROP TABLE pates');
        $this->addSql('ALTER TABLE pizza DROP FOREIGN KEY FK_CFDD826FC558AD12');
        $this->addSql('DROP INDEX IDX_CFDD826FC558AD12 ON pizza');
        $this->addSql('ALTER TABLE pizza DROP pates_id');
    }
}
