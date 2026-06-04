CREATE TABLE demandes (
    id              INT(11)       AUTO_INCREMENT PRIMARY KEY,
    nom             VARCHAR(100)  NULL,
    telephone       VARCHAR(20)   NULL,
    email           VARCHAR(100)  NULL,
    modele          VARCHAR(255)  NULL,
    type_reparation VARCHAR(100)  NULL,
    message         TEXT          NULL,
    date_demande    TIMESTAMP     DEFAULT current_timestamp()
);