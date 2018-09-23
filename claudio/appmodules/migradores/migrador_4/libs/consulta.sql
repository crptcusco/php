SELECT 
  t.nombre as tabla_nombre
, c.nombre as campo_nombre
, c.tipo_dato as campo_tipo
, c.categoria as campo_categoria
FROM tabla_has_campo tc
JOIN tabla t ON t.id=tc.tabla_id
JOIN campo c ON c.id=tc.campo_id
ORDER BY t.id,tc.id
LIMIT 35
;

desc em_casa;
