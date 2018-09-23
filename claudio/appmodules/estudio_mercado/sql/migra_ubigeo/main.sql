
SOURCE tables.sql;

SOURCE migrate_casa.sql;
SOURCE migrate_departamento.sql;
SOURCE migrate_local_comercial.sql;
SOURCE migrate_local_industrial.sql;
SOURCE migrate_terreno.sql;


--  paso1: poniendo el id en un el campo dic
SOURCE call.sql;

-- paso2: viendo mustra
SOURCE muestra.sql;


-- paso3: pasando bk -> ubi
SOURCE actualizar.sql;
