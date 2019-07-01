<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190701093427 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA767B3B43D');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7CAC75398');
        $this->addSql('DROP INDEX IDX_3BAE0AA7CAC75398 ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA767B3B43D ON event');
        $this->addSql('ALTER TABLE event ADD user_id INT NOT NULL, ADD city_id INT NOT NULL, DROP users_id, DROP cities_id');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA78BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7A76ED395 ON event (user_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA78BAC62AF ON event (city_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A76ED395');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA78BAC62AF');
        $this->addSql('DROP INDEX IDX_3BAE0AA7A76ED395 ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA78BAC62AF ON event');
        $this->addSql('ALTER TABLE event ADD users_id INT NOT NULL, ADD cities_id INT NOT NULL, DROP user_id, DROP city_id');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA767B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7CAC75398 FOREIGN KEY (cities_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7CAC75398 ON event (cities_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA767B3B43D ON event (users_id)');
    }
}
