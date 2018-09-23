-- CONSULTAS DEL SGI
SELECT 
ss.fechaCreacion as fechaSolicitud,
concat(parSolicitante.razonSocial,' - ',parContacto.nombre,' - ',parContacto.sucursal) as 'SOLICITANTE_UNIDO',
parCliente.razonSocial as 'cliente',
concat(l.calle,' ',l.numero,' - ',dis.nombre,' - ',pro.nombre,' - ',dep.nombre) as 'direccion',
concat(nmt.nombre,'-',sc1.nombre ,' - ', sc2.nombre )as 'tipoBien',
p.id as 'idProyecto',
c.id as 'idCoordinacion'
FROM coordinacion c
INNER JOIN locacion l
INNER JOIN proyecto p
INNER JOIN detalleproyecto dp
INNER JOIN grupotasacion gt
INNER JOIN solicitudservicio ss
INNER JOIN subclasificacion2 sc2
INNER JOIN subclasificacion1 sc1
INNER JOIN motivotasacion mt
INNER JOIN naturalezamotivotasacion nmt
INNER JOIN participante parSolicitante
inner join participante parCliente
inner join participante parContacto
inner join distrito dis
inner join provincia pro
inner join departamento dep
ON c.idLocacion=l.id AND l.idProyecto=p.id 
AND p.idSolicitudServicio=ss.id 
AND l.id=dp.idLocacion 
AND gt.id=dp.idGrupoTasacion 
AND gt.idSubclasificacion2=sc2.id 
AND sc2.idsubclasificacion1=sc1.id 
AND sc1.idmotivotasacion = mt.id 
AND mt.idnaturalezamotivotasacion=nmt.id 
AND parSolicitante.id = ss.idSolicitante 
AND parCliente.id = ss.idCliente 
AND parContacto.id = ss.idContacto 
AND dis.id = l.idDistrito
AND l.idDistrito = dis.id 
AND dis.IdProvincia = pro.id 
AND pro.IdDepartamento = dep.id
order by ss.fechaCreacion desc;