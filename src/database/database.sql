
USE testdbTerminal;
drop table if exists schemas;
drop table if exists templates;

drop table if exists infotherminal_schema;

drop table if exists user_login;
drop table if exists infotherminals; 

drop table if exists error_logs;

CREATE TABLE infotherminals (
    id INT NOT NULL IDENTITY(1,1),
    titel VARCHAR(50),
    ipAdresse VARCHAR(50),
    CONSTRAINT PK_infotherminals PRIMARY KEY (id)
);

INSERT INTO infotherminals (titel, ipAdresse) VALUES
('KantineOG', '0.0.0.0'),
('Aula', '0.0.0.1'),
('KantineELG', '0.0.0.2'),
('Empfang', '0.0.0.3'),
('Begegnungshaus', '0.0.0.4'),
('localhost', '127.0.0.1'),
('test', '10.1.11.8');

CREATE TABLE schemas (
    id INT NOT NULL IDENTITY(1,1),
    imagePath VARCHAR(255),
    selectedTime VARCHAR(50),
    isAktiv VARCHAR(1),
    startTime VARCHAR(50),
    endTime VARCHAR(50),
    startDateTime VARCHAR(50),
    endDateTime VARCHAR(50),
    timeAktiv VARCHAR(1),
    dateAktiv VARCHAR(1), 
    titel VARCHAR(50),
    wochentage VARCHAR(255),
    beschreibung VARCHAR(255),
    CONSTRAINT PK_schemas PRIMARY KEY (id) 
);

INSERT INTO schemas (imagePath, selectedTime, isAktiv, startTime, endTime, startDateTime, endDateTime, timeAktiv, dateAktiv, titel, beschreibung) VALUES
('img_689f16b07bf2f3.92530620.jpg', 10000, 1, NULL, NULL, NULL, NULL, 0, 1, 'Fundsachen', NULL),
('img_68ba8779b38547.17924392.jpg', 10000, 1, NULL, NULL, '2025-09-05 00:00', '9999-12-31 00:00', 0, 1, 'Klimaschutz', 'Info'),
('img_68be943e29e623.42272935.jpg', 15000, 1, '07:30', '17:30', '2025-09-09 00:00', '9999-12-31 23:59', 1, 1, 'Cafeteria', NULL),
('img_68ee67acb12b18.88862492.jpg', 10000, 1, NULL, NULL, '2025-10-14 00:00', '9999-12-31 23:59', 0, 1, 'Dienstagscafe', NULL),
('img_690def70e847b0.31789468.jpg', 15000, 1, '07:00', '18:00', '2025-11-10 00:00', '2026-09-30 23:59', 1, 1, 'Smokie', 'RP'),
('img_691726fda87bc4.04699269.jpg', 15000, 1, '07:00', '13:00', '2025-11-17 00:00', '2025-11-21 23:59', 1, 1, 'SP47', 'SP'),
('img_691c6d2ab8cf46.75390938.jpg', 20000, 1, '14:00', '18:00', '2025-11-18 00:00', '2025-12-03 23:59', 1, 1, 'Kerzenziehen.', 'Bild'),
('img_691d8fd3d17e22.77956838.jpg', 15000, 1, '07:00', '13:00', '2025-11-24 00:00', '2025-11-28 23:59', 1, 1, 'SP48', 'SP'),
('img_691d95fd52a847.21617752.jpg', 15000, 1, '07:00', '13:00', '2025-12-01 00:00', '2025-12-05 23:59', 1, 1, 'SP49', NULL),
('img_6926d5406f1ba8.36960401.jpg', 15000, 1, NULL, NULL, NULL, NULL, 0, 0, 'Christmas.', NULL);

CREATE table templates (
    id INT NOT NULL IDENTITY(1,1),
    fk_schema_id INT NOT NULL,
    templateName VARCHAR(50),
    typ VARCHAR(50),
    inhalt VARCHAR(255),
    CONSTRAINT FK_templates_schemas FOREIGN KEY (fk_schema_id)
        REFERENCES schemas(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE infotherminal_schema (
    id INT NOT NULL IDENTITY(1,1),
    fk_infotherminal_id INT NOT NULL,
    fk_schema_id INT NOT NULL,
    CONSTRAINT PK_infotherminal_schema PRIMARY KEY (fk_infotherminal_id, fk_schema_id),
    CONSTRAINT FK_infotherminal_schema_infotherminals FOREIGN KEY (fk_infotherminal_id) 
        REFERENCES infotherminals(id),
    CONSTRAINT FK_infotherminal_schema_schemas FOREIGN KEY (fk_schema_id) 
        REFERENCES schemas(id)
);

SELECT templates.
 *FROM schemas
RIGHT JOIN templates ON templates.fk_schema_id = schemas.id
where templates.fk_schema_id = 3;



CREATE TABLE user_login (
    id INT IDENTITY(1,1) PRIMARY KEY, -- Bleibt int für Auto-Inkrement
    username VARCHAR(50),
    password VARCHAR(255), -- Gehashte Passwörter
    remember_me VARCHAR(1) DEFAULT '1', -- '1' = Angemeldet bleiben, '0' = Nein
    is_admin VARCHAR(1) DEFAULT '0', -- '1' = Admin, '0' = Normaler User
    is_active VARCHAR(1) DEFAULT '1', -- '1' = Aktiv, '0' = Deaktiviert
    email VARCHAR(100),
    failed_attempts VARCHAR(10) DEFAULT '0', -- Anzahl als String
    last_failed_attempt VARCHAR(50), -- Datum als String (z.B. '2023-10-01 12:00:00')
    lockout_until VARCHAR(50), -- Datum als String
    last_login VARCHAR(50), -- Datum als String
    verification_code VARCHAR(10), -- Für Passwort-Reset
    verification_expires DATETIME, -- Ablaufdatum als echtes DATETIME
    created_at DATETIME DEFAULT GETDATE(), -- Erstellungsdatum im Format yyyy-mm-dd hh:mi:ss
 );



CREATE TABLE error_logs (
        message VARCHAR(255) NOT NULL, -- Fehler-Nachricht
        datum DATETIME DEFAULT GETDATE(), -- Aktuelles Datum und Zeit
);


