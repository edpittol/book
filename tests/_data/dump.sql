PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE doctrine_migration_versions (version VARCHAR(191) NOT NULL, executed_at DATETIME DEFAULT NULL, execution_time INTEGER DEFAULT NULL, PRIMARY KEY(version));
INSERT INTO doctrine_migration_versions VALUES('DoctrineMigrations\Version20241204004553','2024-12-05 14:20:19',2);
CREATE TABLE bookmark (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, google_books_id VARCHAR(12) NOT NULL);
CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        );
DELETE FROM sqlite_sequence;
CREATE UNIQUE INDEX google_books_id ON bookmark (google_books_id);
CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name);
CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at);
CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at);
COMMIT;
