<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404153936 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX aup_idx');
        $this->addSql('DROP INDEX IDX_B052AF06F7384557');
        $this->addSql('DROP INDEX IDX_B052AF0650EAE44');
        $this->addSql('CREATE TEMPORARY TABLE __temp__asso_utilisateurs_produits AS SELECT id, id_utilisateur, id_produit, quantite FROM asso_utilisateurs_produits');
        $this->addSql('DROP TABLE asso_utilisateurs_produits');
        $this->addSql('CREATE TABLE asso_utilisateurs_produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_utilisateur INTEGER NOT NULL, id_produit INTEGER NOT NULL, quantite INTEGER NOT NULL, CONSTRAINT FK_B052AF0650EAE44 FOREIGN KEY (id_utilisateur) REFERENCES im2021_utilisateurs (pk) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B052AF06F7384557 FOREIGN KEY (id_produit) REFERENCES im2021_produits (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO asso_utilisateurs_produits (id, id_utilisateur, id_produit, quantite) SELECT id, id_utilisateur, id_produit, quantite FROM __temp__asso_utilisateurs_produits');
        $this->addSql('DROP TABLE __temp__asso_utilisateurs_produits');
        $this->addSql('CREATE UNIQUE INDEX aup_idx ON asso_utilisateurs_produits (id_utilisateur, id_produit)');
        $this->addSql('CREATE INDEX IDX_B052AF06F7384557 ON asso_utilisateurs_produits (id_produit)');
        $this->addSql('CREATE INDEX IDX_B052AF0650EAE44 ON asso_utilisateurs_produits (id_utilisateur)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_B052AF0650EAE44');
        $this->addSql('DROP INDEX IDX_B052AF06F7384557');
        $this->addSql('DROP INDEX aup_idx');
        $this->addSql('CREATE TEMPORARY TABLE __temp__asso_utilisateurs_produits AS SELECT id, id_utilisateur, id_produit, quantite FROM asso_utilisateurs_produits');
        $this->addSql('DROP TABLE asso_utilisateurs_produits');
        $this->addSql('CREATE TABLE asso_utilisateurs_produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_utilisateur INTEGER NOT NULL, id_produit INTEGER NOT NULL, quantite INTEGER NOT NULL)');
        $this->addSql('INSERT INTO asso_utilisateurs_produits (id, id_utilisateur, id_produit, quantite) SELECT id, id_utilisateur, id_produit, quantite FROM __temp__asso_utilisateurs_produits');
        $this->addSql('DROP TABLE __temp__asso_utilisateurs_produits');
        $this->addSql('CREATE INDEX IDX_B052AF0650EAE44 ON asso_utilisateurs_produits (id_utilisateur)');
        $this->addSql('CREATE INDEX IDX_B052AF06F7384557 ON asso_utilisateurs_produits (id_produit)');
        $this->addSql('CREATE UNIQUE INDEX aup_idx ON asso_utilisateurs_produits (id_utilisateur, id_produit)');
    }
}
