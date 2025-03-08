<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250308155345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE check_in_out (id SERIAL NOT NULL, user_id_id INT NOT NULL, shift_id_id INT NOT NULL, uuid UUID NOT NULL, check_in_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, check_out_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_180E64CD9D86650F ON check_in_out (user_id_id)');
        $this->addSql('CREATE INDEX IDX_180E64CD74AA7809 ON check_in_out (shift_id_id)');
        $this->addSql('COMMENT ON COLUMN check_in_out.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE department (id SERIAL NOT NULL, uuid UUID NOT NULL, name VARCHAR(100) NOT NULL, description TEXT DEFAULT NULL, is_internal BOOLEAN NOT NULL, contact_people JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN department.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE location (id SERIAL NOT NULL, uuid UUID NOT NULL, name VARCHAR(100) NOT NULL, description TEXT DEFAULT NULL, is_internal BOOLEAN NOT NULL, map_embed_code TEXT DEFAULT NULL, contact_people JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN location.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE news (id SERIAL NOT NULL, uuid UUID NOT NULL, title VARCHAR(200) NOT NULL, content TEXT NOT NULL, is_pinned BOOLEAN NOT NULL, visible_to VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN news.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE shift (id SERIAL NOT NULL, shift_type_id INT NOT NULL, location_id INT NOT NULL, uuid UUID NOT NULL, start_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, max_participants INT NOT NULL, is_night_shift BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A50B3B45A81DB0EA ON shift (shift_type_id)');
        $this->addSql('CREATE INDEX IDX_A50B3B4564D218E ON shift (location_id)');
        $this->addSql('COMMENT ON COLUMN shift.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE shift_application (id SERIAL NOT NULL, user_id_id INT NOT NULL, shift_id_id INT NOT NULL, uuid UUID NOT NULL, status VARCHAR(255) NOT NULL, applied_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FBE5FD39D86650F ON shift_application (user_id_id)');
        $this->addSql('CREATE INDEX IDX_FBE5FD374AA7809 ON shift_application (shift_id_id)');
        $this->addSql('COMMENT ON COLUMN shift_application.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE shift_type (id SERIAL NOT NULL, department_id INT NOT NULL, uuid UUID NOT NULL, name VARCHAR(100) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B9E728E6AE80F5DF ON shift_type (department_id)');
        $this->addSql('COMMENT ON COLUMN shift_type.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE check_in_out ADD CONSTRAINT FK_180E64CD9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE check_in_out ADD CONSTRAINT FK_180E64CD74AA7809 FOREIGN KEY (shift_id_id) REFERENCES shift (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shift ADD CONSTRAINT FK_A50B3B45A81DB0EA FOREIGN KEY (shift_type_id) REFERENCES shift_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shift ADD CONSTRAINT FK_A50B3B4564D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shift_application ADD CONSTRAINT FK_FBE5FD39D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shift_application ADD CONSTRAINT FK_FBE5FD374AA7809 FOREIGN KEY (shift_id_id) REFERENCES shift (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shift_type ADD CONSTRAINT FK_B9E728E6AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE check_in_out DROP CONSTRAINT FK_180E64CD9D86650F');
        $this->addSql('ALTER TABLE check_in_out DROP CONSTRAINT FK_180E64CD74AA7809');
        $this->addSql('ALTER TABLE shift DROP CONSTRAINT FK_A50B3B45A81DB0EA');
        $this->addSql('ALTER TABLE shift DROP CONSTRAINT FK_A50B3B4564D218E');
        $this->addSql('ALTER TABLE shift_application DROP CONSTRAINT FK_FBE5FD39D86650F');
        $this->addSql('ALTER TABLE shift_application DROP CONSTRAINT FK_FBE5FD374AA7809');
        $this->addSql('ALTER TABLE shift_type DROP CONSTRAINT FK_B9E728E6AE80F5DF');
        $this->addSql('DROP TABLE check_in_out');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE shift');
        $this->addSql('DROP TABLE shift_application');
        $this->addSql('DROP TABLE shift_type');
    }
}
