SELECT 
  em.tipoinmueble
, em.fechatasacion as 'FECHA  DE TASACION'
, Date_format(em.fechatasacion,'%d/%m/%Y')
FROM estudiomercadoinmueble em
WHERE 
em.idInformeTasacion=10057
;
