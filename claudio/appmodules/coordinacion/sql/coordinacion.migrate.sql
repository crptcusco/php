INSERT INTO login_profile (full_name) VALUES ('Operaciones');
-- SELECT * FROM login_profile WHERE full_name='Operaciones';

INSERT INTO login_resource (full_name) VALUES ('Coordinacion');
-- SELECT * FROM login_resource WHERE full_name='Operaciones';

INSERT INTO login_profile_has_resource(profile_id, resource_id) VALUES
(1,5),
(2,5),
(6,5)
;

INSERT INTO login_user(full_name, login, pass)
VALUES ('Andy Altamirano', 'a_altamirano', '3cf87cea38169a6116da560c59bded96'), -- andy70 
       ('Gerardo Espinoza', 'g_espinoza', '9dc589826ba9c12919db3e7050c3be3c'), -- gerardo82
       ('Marlo Gomez', 'm_gomez', 'dc1a5231bd30320df4bdb0dc1a4cab8c'), -- marlo11
       ('Raul Catillo', 'r_castillo', '106bcb5260323f6537a6b2a60271db87') -- raul95
;

-- SELECT id, full_name, login FROM login_user ORDER BY id DESC LIMIT 4 ;

INSERT login_user_has_profile(user_id, profile_id) VALUES
(15, 6),
(16, 6),
(17, 6),
(18, 6)
;
