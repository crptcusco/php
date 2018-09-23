SELECT *
FROM informetasacion i
INNER JOIN proyecto p ON i.idProyecto = p.id
INNER JOIN solicitudservicio s
ON i.idProyecto=p.id AND s.id=p.idSolicitudServicio
LIMIT 100;
