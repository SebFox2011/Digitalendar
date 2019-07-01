<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190701093305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event_langage (event_id INT NOT NULL, langage_id INT NOT NULL, INDEX IDX_4907438971F7E88B (event_id), INDEX IDX_49074389957BB53C (langage_id), PRIMARY KEY(event_id, langage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_langage ADD CONSTRAINT FK_4907438971F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_langage ADD CONSTRAINT FK_49074389957BB53C FOREIGN KEY (langage_id) REFERENCES langage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD users_id INT NOT NULL, ADD cities_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA767B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7CAC75398 FOREIGN KEY (cities_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA767B3B43D ON event (users_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7CAC75398 ON event (cities_id)');
        $this->addSql('ALTER TABLE participant ADD event_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B1171F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D79F6B1171F7E88B ON participant (event_id)');
        $this->addSql('CREATE INDEX IDX_D79F6B11A76ED395 ON participant (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE event_langage');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA767B3B43D');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7CAC75398');
        $this->addSql('DROP INDEX IDX_3BAE0AA767B3B43D ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA7CAC75398 ON event');
        $this->addSql('ALTER TABLE event DROP users_id, DROP cities_id');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B1171F7E88B');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11A76ED395');
        $this->addSql('DROP INDEX IDX_D79F6B1171F7E88B ON participant');
        $this->addSql('DROP INDEX IDX_D79F6B11A76ED395 ON participant');
        $this->addSql('ALTER TABLE participant DROP event_id, DROP user_id');
    }
}
