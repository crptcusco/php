-- SELECT * 
-- FROM(
-- SELECT DISTINCT marca FROM marca
-- ) as l
-- JOIN marca_history h ON h.nombre=l.marca 
-- ;

-- SELECT DISTINCT d.marca
-- FROM  marca d
-- WHERE NOT EXISTS
-- (
-- SELECT 1 from marca_history h
-- WHERE  h.nombre=d.marca 
-- ) 
-- ;

SELECT count(DISTINCT marca) FROM marca WHERE marca
       NOT IN 
    (SELECT nombre FROM marca_history WHERE nombre IS NOT NULL)
;

SELECT count(DISTINCT marca) FROM marca;
