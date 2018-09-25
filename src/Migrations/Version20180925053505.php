<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180925053505 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE systemevent (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, mes VARCHAR(400) NOT NULL, INDEX IDX_7747C94AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE systemevent ADD CONSTRAINT FK_7747C94AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users DROP group_id');
    }

    public function down(Schema $schema) : void
    {/*
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE newspage_newscategory DROP FOREIGN KEY FK_B6615BEE9D72BAE3');
        $this->addSql('ALTER TABLE newspage_newscategory DROP FOREIGN KEY FK_B6615BEE79DC4713');
        $this->addSql('CREATE TABLE nas (id INT AUTO_INCREMENT NOT NULL, nasname VARCHAR(128) NOT NULL COLLATE latin1_swedish_ci, shortname VARCHAR(32) DEFAULT NULL COLLATE latin1_swedish_ci, type VARCHAR(30) DEFAULT \'other\' COLLATE latin1_swedish_ci, ports INT DEFAULT NULL, secret VARCHAR(60) DEFAULT \'secret\' NOT NULL COLLATE latin1_swedish_ci, server VARCHAR(64) DEFAULT NULL COLLATE latin1_swedish_ci, community VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, description VARCHAR(200) DEFAULT \'RADIUS Client\' COLLATE latin1_swedish_ci, INDEX nasname (nasname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radacct (radacctid BIGINT AUTO_INCREMENT NOT NULL, acctsessionid VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, acctuniqueid VARCHAR(32) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, username VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, groupname VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, realm VARCHAR(64) DEFAULT \'\' COLLATE latin1_swedish_ci, nasipaddress VARCHAR(15) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, nasportid VARCHAR(15) DEFAULT NULL COLLATE latin1_swedish_ci, nasporttype VARCHAR(32) DEFAULT NULL COLLATE latin1_swedish_ci, acctstarttime DATETIME DEFAULT NULL, acctstoptime DATETIME DEFAULT NULL, acctsessiontime INT DEFAULT NULL, acctauthentic VARCHAR(32) DEFAULT NULL COLLATE latin1_swedish_ci, connectinfo_start VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, connectinfo_stop VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, acctinputoctets BIGINT DEFAULT NULL, acctoutputoctets BIGINT DEFAULT NULL, calledstationid VARCHAR(50) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, callingstationid VARCHAR(50) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, acctterminatecause VARCHAR(32) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, servicetype VARCHAR(32) DEFAULT NULL COLLATE latin1_swedish_ci, framedprotocol VARCHAR(32) DEFAULT NULL COLLATE latin1_swedish_ci, framedipaddress VARCHAR(15) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, acctstartdelay INT DEFAULT NULL, acctstopdelay INT DEFAULT NULL, xascendsessionsvrkey VARCHAR(10) DEFAULT NULL COLLATE latin1_swedish_ci, UNIQUE INDEX acctuniqueid (acctuniqueid), INDEX username (username), INDEX framedipaddress (framedipaddress), INDEX acctsessionid (acctsessionid), INDEX acctsessiontime (acctsessiontime), INDEX acctstarttime (acctstarttime), INDEX acctstoptime (acctstoptime), INDEX nasipaddress (nasipaddress), PRIMARY KEY(radacctid)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radcheck (id INT UNSIGNED AUTO_INCREMENT NOT NULL, username VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, attribute VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, op CHAR(2) DEFAULT \'==\' NOT NULL COLLATE latin1_swedish_ci, value VARCHAR(253) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, INDEX username (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radgroupcheck (id INT UNSIGNED AUTO_INCREMENT NOT NULL, groupname VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, attribute VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, op CHAR(2) DEFAULT \'==\' NOT NULL COLLATE latin1_swedish_ci, value VARCHAR(253) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, INDEX groupname (groupname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radgroupreply (id INT UNSIGNED AUTO_INCREMENT NOT NULL, groupname VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, attribute VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, op CHAR(2) DEFAULT \'=\' NOT NULL COLLATE latin1_swedish_ci, value VARCHAR(253) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, INDEX groupname (groupname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radpostauth (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, pass VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, reply VARCHAR(32) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, authdate DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radreply (id INT UNSIGNED AUTO_INCREMENT NOT NULL, username VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, attribute VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, op CHAR(2) DEFAULT \'=\' NOT NULL COLLATE latin1_swedish_ci, value VARCHAR(253) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, INDEX username (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radusergroup (username VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, groupname VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, priority INT DEFAULT 1 NOT NULL, INDEX username (username)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vmps_log (item_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'Item Id\', mac VARCHAR(18) NOT NULL COLLATE utf8_general_ci COMMENT \'Mac address\', vl_name VARCHAR(18) NOT NULL COLLATE utf8_general_ci COMMENT \'Vlan Name\', ip VARCHAR(20) NOT NULL COLLATE utf8_general_ci COMMENT \'NAS Ip\', interface VARCHAR(10) NOT NULL COLLATE utf8_general_ci COMMENT \'NAS Interface\', dt DATETIME NOT NULL COMMENT \'Date time set\', PRIMARY KEY(item_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vmps_nas (nas_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'Nas Id\', name VARCHAR(20) NOT NULL COLLATE utf8_general_ci COMMENT \'NAS Name\', ip VARCHAR(20) NOT NULL COLLATE utf8_general_ci COMMENT \'NAS Ip\', domain VARCHAR(200) NOT NULL COLLATE utf8_general_ci COMMENT \'NAS Domain\', PRIMARY KEY(nas_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE newscategory');
        $this->addSql('DROP TABLE newspage');
        $this->addSql('DROP TABLE newspage_newscategory');
        $this->addSql('DROP TABLE rewrite');
        $this->addSql('DROP TABLE systemevent');
        $this->addSql('ALTER TABLE users ADD group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vmps_items CHANGE item_id item_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'Item Id\', CHANGE mac mac VARCHAR(18) NOT NULL COLLATE utf8_general_ci COMMENT \'Mac address\', CHANGE vl_name vl_name VARCHAR(18) NOT NULL COLLATE utf8_general_ci COMMENT \'Vlan Name\', CHANGE username username VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT \'User Name\', CHANGE categ categ VARCHAR(20) NOT NULL COLLATE utf8_general_ci COMMENT \'User Cayegories\', CHANGE nas_name nas_name VARCHAR(20) NOT NULL COLLATE utf8_general_ci COMMENT \'NAS Id\'');
        $this->addSql('CREATE UNIQUE INDEX mac ON vmps_items (mac)');*/
    }
}
