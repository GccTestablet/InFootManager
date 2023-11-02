<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231102155237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rename user to user_id and player to player_id';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE players DROP CONSTRAINT fk_264e43a68d93d649');
        $this->addSql('DROP INDEX uniq_264e43a68d93d649');
        $this->addSql('ALTER TABLE players RENAME COLUMN "user" TO user_id');
        $this->addSql('ALTER TABLE players ADD CONSTRAINT FK_264E43A6A76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_264E43A6A76ED395 ON players (user_id)');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT fk_1483a5e998197a65');
        $this->addSql('DROP INDEX uniq_1483a5e998197a65');
        $this->addSql('ALTER TABLE users RENAME COLUMN player TO player_id');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E999E6F5DF FOREIGN KEY (player_id) REFERENCES "players" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E999E6F5DF ON users (player_id)');
    }

    public function down(Schema $schema): void
    {

        $this->addSql('ALTER TABLE "players" DROP CONSTRAINT FK_264E43A6A76ED395');
        $this->addSql('DROP INDEX UNIQ_264E43A6A76ED395');
        $this->addSql('ALTER TABLE "players" RENAME COLUMN user_id TO "user"');
        $this->addSql('ALTER TABLE "players" ADD CONSTRAINT fk_264e43a68d93d649 FOREIGN KEY ("user") REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_264e43a68d93d649 ON "players" ("user")');
        $this->addSql('ALTER TABLE "users" DROP CONSTRAINT FK_1483A5E999E6F5DF');
        $this->addSql('DROP INDEX UNIQ_1483A5E999E6F5DF');
        $this->addSql('ALTER TABLE "users" RENAME COLUMN player_id TO player');
        $this->addSql('ALTER TABLE "users" ADD CONSTRAINT fk_1483a5e998197a65 FOREIGN KEY (player) REFERENCES players (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_1483a5e998197a65 ON "users" (player)');
    }
}
