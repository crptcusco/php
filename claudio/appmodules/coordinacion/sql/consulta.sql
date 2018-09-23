SELECT * FROM (
  SELECT @rownum:=@rownum+1 row_num, id
  FROM co_servicio_tipo, (SELECT @rownum:=0) R
  ORDER BY id DESC
) unido
LIMIT 15, 5
;
-- lo que busco
SELECT * FROM (
  SELECT @rownum:=@rownum+1 row_num, id
  FROM co_servicio_tipo, (SELECT @rownum:=0) R
  ORDER BY id DESC
) unido
WHERE id = 7
;

