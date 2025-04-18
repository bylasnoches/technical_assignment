<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241215200121 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE IF NOT EXISTS crypto_pair (
                id SERIAL PRIMARY KEY,
                base_currency VARCHAR(10) NOT NULL,
                quote_currency VARCHAR(10) NOT NULL,
                UNIQUE (base_currency, quote_currency)
            );
        ');

        $this->addSql('
            CREATE TABLE crypto_rate (
                id SERIAL PRIMARY KEY,
                pair_id INTEGER NOT NULL,
                rate DECIMAL(20, 8) NOT NULL,
                created_at TIMESTAMP NOT NULL,
                UNIQUE (pair_id, created_at)
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE "crypto_rate";');
        $this->addSql('DROP TABLE "crypto_pair";');
    }
}
