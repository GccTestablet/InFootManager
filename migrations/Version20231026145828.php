<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231026145828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Tables User, Player and Team';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, user_id_id INT DEFAULT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, category VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_98197A659D86650F ON player (user_id_id)');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE player_team (team_id INT NOT NULL, player_id INT NOT NULL, PRIMARY KEY(team_id, player_id))');
        $this->addSql('CREATE INDEX IDX_66FAF62C296CD8AE ON player_team (team_id)');
        $this->addSql('CREATE INDEX IDX_66FAF62C99E6F5DF ON player_team (player_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, player_id_id INT DEFAULT NULL, email VARCHAR(200) NOT NULL, password VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D649C036E511 ON "user" (player_id_id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A659D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_team ADD CONSTRAINT FK_66FAF62C296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_team ADD CONSTRAINT FK_66FAF62C99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649C036E511 FOREIGN KEY (player_id_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A659D86650F');
        $this->addSql('ALTER TABLE player_team DROP CONSTRAINT FK_66FAF62C296CD8AE');
        $this->addSql('ALTER TABLE player_team DROP CONSTRAINT FK_66FAF62C99E6F5DF');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649C036E511');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE player_team');
        $this->addSql('DROP TABLE "user"');
    }
}
