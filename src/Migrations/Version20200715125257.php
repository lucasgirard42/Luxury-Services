<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200715125257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, jobsector_id INT DEFAULT NULL, name_of_society VARCHAR(255) NOT NULL, contact_name VARCHAR(255) DEFAULT NULL, contact_position VARCHAR(255) DEFAULT NULL, phone_contact VARCHAR(255) DEFAULT NULL, email_contact VARCHAR(255) DEFAULT NULL, notes VARCHAR(255) DEFAULT NULL, INDEX IDX_C74404559712287C (jobsector_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_sector (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate (id INT AUTO_INCREMENT NOT NULL, job_sector_id INT DEFAULT NULL, candidate_file_id INT DEFAULT NULL, experience_id INT DEFAULT NULL, gender VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, passport TINYINT(1) NOT NULL, cv VARCHAR(255) NOT NULL, profil_picture VARCHAR(255) NOT NULL, current_location VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, place_of_birth VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, confirm_email VARCHAR(255) NOT NULL, availability TINYINT(1) DEFAULT NULL, short_description VARCHAR(255) NOT NULL, note VARCHAR(255) DEFAULT NULL, INDEX IDX_C8B28E4419252776 (job_sector_id), INDEX IDX_C8B28E441C1AD4CD (candidate_file_id), INDEX IDX_C8B28E4446E90E27 (experience_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate_file (id INT AUTO_INCREMENT NOT NULL, date_created DATE DEFAULT NULL, date_updated DATE DEFAULT NULL, date_deleted DATE DEFAULT NULL, files VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, experience_time DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, job_sector_id INT DEFAULT NULL, job_type_id INT DEFAULT NULL, reference INT NOT NULL, description VARCHAR(255) DEFAULT NULL, activity VARCHAR(255) DEFAULT NULL, notes VARCHAR(255) DEFAULT NULL, job_title VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, closing_date DATE DEFAULT NULL, salary INT DEFAULT NULL, date_creation DATE DEFAULT NULL, INDEX IDX_288A3A4E19EB6921 (client_id), INDEX IDX_288A3A4E19252776 (job_sector_id), INDEX IDX_288A3A4E5FA33B08 (job_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_type (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404559712287C FOREIGN KEY (jobsector_id) REFERENCES job_sector (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E4419252776 FOREIGN KEY (job_sector_id) REFERENCES job_sector (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E441C1AD4CD FOREIGN KEY (candidate_file_id) REFERENCES candidate_file (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E4446E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E19252776 FOREIGN KEY (job_sector_id) REFERENCES job_sector (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E5FA33B08 FOREIGN KEY (job_type_id) REFERENCES job_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E19EB6921');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404559712287C');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E4419252776');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E19252776');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E441C1AD4CD');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E4446E90E27');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E5FA33B08');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE job_sector');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('DROP TABLE candidate_file');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE job_type');
    }
}
