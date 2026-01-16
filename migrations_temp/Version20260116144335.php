<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260116144335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient_classique_pizza ADD CONSTRAINT FK_5C2B997158F28195 FOREIGN KEY (ingredient_classique_id) REFERENCES ingredient_classique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_classique_pizza ADD CONSTRAINT FK_5C2B9971D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza ADD CONSTRAINT FK_CFDD826FC558AD12 FOREIGN KEY (pates_id) REFERENCES pates (id)');
        $this->addSql('ALTER TABLE pizza ADD CONSTRAINT FK_CFDD826FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, DROP nom, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient_classique_pizza DROP FOREIGN KEY FK_5C2B997158F28195');
        $this->addSql('ALTER TABLE ingredient_classique_pizza DROP FOREIGN KEY FK_5C2B9971D41D1D42');
        $this->addSql('ALTER TABLE pizza DROP FOREIGN KEY FK_CFDD826FC558AD12');
        $this->addSql('ALTER TABLE pizza DROP FOREIGN KEY FK_CFDD826FA76ED395');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_EMAIL ON user');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL, DROP roles, CHANGE email email VARCHAR(255) NOT NULL');
    }
}
