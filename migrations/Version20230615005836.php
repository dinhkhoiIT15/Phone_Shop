<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615005836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, phone_name VARCHAR(255) NOT NULL, price NUMERIC(10, 1) NOT NULL, date DATE NOT NULL, INDEX IDX_444F97DD4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone_supplier (phone_id INT NOT NULL, supplier_id INT NOT NULL, INDEX IDX_536D7F723B7323CB (phone_id), INDEX IDX_536D7F722ADD6D8C (supplier_id), PRIMARY KEY(phone_id, supplier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, pro_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, phone_id INT NOT NULL, INDEX IDX_E54BC0059395C3F3 (customer_id), INDEX IDX_E54BC0053B7323CB (phone_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, sup_name VARCHAR(255) NOT NULL, importer TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DD4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE phone_supplier ADD CONSTRAINT FK_536D7F723B7323CB FOREIGN KEY (phone_id) REFERENCES phone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE phone_supplier ADD CONSTRAINT FK_536D7F722ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC0059395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC0053B7323CB FOREIGN KEY (phone_id) REFERENCES phone (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DD4584665A');
        $this->addSql('ALTER TABLE phone_supplier DROP FOREIGN KEY FK_536D7F723B7323CB');
        $this->addSql('ALTER TABLE phone_supplier DROP FOREIGN KEY FK_536D7F722ADD6D8C');
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC0059395C3F3');
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC0053B7323CB');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE phone');
        $this->addSql('DROP TABLE phone_supplier');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE sale');
        $this->addSql('DROP TABLE supplier');
    }
}
