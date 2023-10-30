<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231030150321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add tables Users, Players and Teams';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE "players_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "teams_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "users_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "players" (id INT NOT NULL, "user" INT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, category VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_264E43A68D93D649 ON "players" ("user")');
        $this->addSql('CREATE TABLE "teams" (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE player_team (team_id INT NOT NULL, player_id INT NOT NULL, PRIMARY KEY(team_id, player_id))');
        $this->addSql('CREATE INDEX IDX_66FAF62C296CD8AE ON player_team (team_id)');
        $this->addSql('CREATE INDEX IDX_66FAF62C99E6F5DF ON player_team (player_id)');
        $this->addSql('CREATE TABLE "users" (id INT NOT NULL, player INT DEFAULT NULL, email VARCHAR(200) NOT NULL, password VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E998197A65 ON "users" (player)');
        $this->addSql('ALTER TABLE "players" ADD CONSTRAINT FK_264E43A68D93D649 FOREIGN KEY ("user") REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_team ADD CONSTRAINT FK_66FAF62C296CD8AE FOREIGN KEY (team_id) REFERENCES "teams" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_team ADD CONSTRAINT FK_66FAF62C99E6F5DF FOREIGN KEY (player_id) REFERENCES "players" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "users" ADD CONSTRAINT FK_1483A5E998197A65 FOREIGN KEY (player) REFERENCES "players" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE "players_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "teams_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "users_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "players" DROP CONSTRAINT FK_264E43A68D93D649');
        $this->addSql('ALTER TABLE player_team DROP CONSTRAINT FK_66FAF62C296CD8AE');
        $this->addSql('ALTER TABLE player_team DROP CONSTRAINT FK_66FAF62C99E6F5DF');
        $this->addSql('ALTER TABLE "users" DROP CONSTRAINT FK_1483A5E998197A65');
        $this->addSql('DROP TABLE "players"');
        $this->addSql('DROP TABLE "teams"');
        $this->addSql('DROP TABLE player_team');
        $this->addSql('DROP TABLE "users"');
    }
}
