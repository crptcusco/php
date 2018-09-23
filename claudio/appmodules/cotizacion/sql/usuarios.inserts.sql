-- ----------------------------------------------------- datos
INSERT INTO  login_user(full_name, login,pass)
VALUES
('Claudio Rodriguez','crodriguez','0192023a7bbd73250516f069df18b500'), -- admin123
('Carla Vivar','c_vivar','96d2c5f6a6cb8f18ae0584cfd75ab8fb'), -- carla2
('Karin Pisconti','k_pisconti','201e9e6ba83cb0749d503e932e785081'), -- karin3
('Erwin Pezo','e_pezo','d047c1c1b2457ca2d7b1d4b93d59be81'), -- erwin6
('Janet Macedo','j_macedo','af33c792844406e9fa166d782d9902fa'), -- janet4
('Carlos Alfonso','c_alfonso','0447474adb46681d5511ba7b4e20b74a'), -- alfonso9
('Edwin Tequen','e_tequen','1a4535650480641dcc183a77ef33aff9') -- chotequen
;
INSERT INTO  login_profile(full_name) VALUES
('Admin'),
('Comercial'),
('Adminisistracion'),
('Asistencia')

;
INSERT INTO  login_user_has_profile(user_id, profile_id) VALUES
(1,1),
(2,2),
(3,2),
(4,2),
(5,3),
(6,4),
(7,1)
;
INSERT INTO login_resource(full_name) VALUES
('Cotizacion'), 
('Facturacion'),
('Asistencia')
;
INSERT INTO login_profile_has_resource
(query_accion, add_accion, edit_accion, delete_accion, resource_id, profile_id) VALUES
(1,1,1,1,1,1),
(1,1,1,1,2,1),
(1,1,1,1,3,1),
(1,1,1,1,1,2),
(1,1,1,1,2,3),
(1,1,1,1,3,3),
(1,1,1,1,3,4)
;
----------------------------------------------------- query
SELECT * FROM login_user
;
SELECT * FROM login_profile
;
SELECT * FROM login_user_has_profile
;
SELECT * FROM login_resource
;
SELECT * FROM login_profile_has_resource
;
SELECT 
  u.login as 'user'
, r.full_name as 'resource'
, p.full_name as 'profile'
FROM login_profile p
JOIN login_user_has_profile up ON up.profile_id = p.id
JOIN login_profile_has_resource pr ON pr.profile_id = p.id
JOIN login_user u ON u.id = up.user_id
JOIN login_resource r ON r.id = pr.resource_id
;

