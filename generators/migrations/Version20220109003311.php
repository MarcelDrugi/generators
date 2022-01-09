<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220109003311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE error_logs (id INT AUTO_INCREMENT NOT NULL, time BIGINT NOT NULL, request LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator1 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator10 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator11 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator12 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator13 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator14 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator15 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator16 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator17 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator18 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator19 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator2 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator20 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator3 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator4 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator5 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator6 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator7 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator8 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator9 (id BIGINT AUTO_INCREMENT NOT NULL, power_kw DOUBLE PRECISION DEFAULT NULL, time BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE error_logs');
        $this->addSql('DROP TABLE generator1');
        $this->addSql('DROP TABLE generator10');
        $this->addSql('DROP TABLE generator11');
        $this->addSql('DROP TABLE generator12');
        $this->addSql('DROP TABLE generator13');
        $this->addSql('DROP TABLE generator14');
        $this->addSql('DROP TABLE generator15');
        $this->addSql('DROP TABLE generator16');
        $this->addSql('DROP TABLE generator17');
        $this->addSql('DROP TABLE generator18');
        $this->addSql('DROP TABLE generator19');
        $this->addSql('DROP TABLE generator2');
        $this->addSql('DROP TABLE generator20');
        $this->addSql('DROP TABLE generator3');
        $this->addSql('DROP TABLE generator4');
        $this->addSql('DROP TABLE generator5');
        $this->addSql('DROP TABLE generator6');
        $this->addSql('DROP TABLE generator7');
        $this->addSql('DROP TABLE generator8');
        $this->addSql('DROP TABLE generator9');
    }
}
