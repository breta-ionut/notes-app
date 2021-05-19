<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210519213147 extends AbstractMigration
{
    /**
     * {@inheritDoc}
     */
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users (id INT UNSIGNED AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(4096) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    /**
     * {@inheritDoc}
     */
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');
    }
}
