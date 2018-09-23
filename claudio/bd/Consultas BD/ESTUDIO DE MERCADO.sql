-- SELECCION UBIGEOS
select departamento.nombre, provincia.nombre, distrito.nombre  
from ubi_distrito distrito
inner join ubi_provincia provincia on distrito.distrito_id = provincia.provincia_id
inner join ubi_departamento departamento on departamento.departamento_id = provincia.departamento_id;

-- DETALLE DE ESTUDIOS
set @id=23;
select emca.id,'CASA' as tipo,
estudio_fecha as fecha,
proyecto_id as proyecto,
informe_id as informe,
ubidep.nombre as departamento,
ubipro.nombre as provincia,
ubidis.nombre as distrito,
ubicacion as ubicacion,
terreno_area as terreno,
terreno_valorunitario as valorunitario,
valor_comercial as valorcomercial,
zonificacion as zonificacion
from em_casa as emca
inner join ubi_departamento as ubidep on emca.ubi_departamento_id = ubidep.departamento_id
inner join ubi_provincia as ubipro on emca.ubi_provincia_id = ubipro.provincia_id
inner join ubi_distrito as ubidis on emca.ubi_distrito_id = ubidis.distrito_id
where consultor_id = @id 
union select emde.id,'DEPARTAMENTO' as tipo,
estudio_fecha as fecha,
proyecto_id as proyecto,
informe_id as informe,
ubidep.nombre as departamento,
ubipro.nombre as provincia,
ubidis.nombre as distrito,
ubicacion as ubicacion,
terreno_area as terreno,
terreno_valorunitario as valorunitario,
valor_comercial as valorcomercial,
zonificacion as zonificacion
from em_departamento as emde
inner join ubi_departamento as ubidep on emde.ubi_departamento_id = ubidep.departamento_id
inner join ubi_provincia as ubipro on emde.ubi_provincia_id = ubipro.provincia_id
inner join ubi_distrito as ubidis on emde.ubi_distrito_id = ubidis.distrito_id
where consultor_id = @id
union select emloco.id,'LOCAL COMERCIAL' as tipo,
estudio_fecha as fecha,
proyecto_id as proyecto,
informe_id as informe,
ubidep.nombre as departamento,
ubipro.nombre as provincia,
ubidis.nombre as distrito,
ubicacion as ubicacion,
terreno_area as terreno,
terreno_valorunitario as valorunitario,
valor_comercial as valorcomercial,
zonificacion as zonificacion
from em_local_comercial emloco
inner join ubi_departamento as ubidep on emloco.ubi_departamento_id = ubidep.departamento_id
inner join ubi_provincia as ubipro on emloco.ubi_provincia_id = ubipro.provincia_id
inner join ubi_distrito as ubidis on emloco.ubi_distrito_id = ubidis.distrito_id
where consultor_id = @id 
union select emloin.id,'LOCAL INDUSTRIAL' as tipo,
estudio_fecha as fecha,
proyecto_id as proyecto,
informe_id as informe,
ubidep.nombre as departamento,
ubipro.nombre as provincia,
ubidis.nombre as distrito,
ubicacion as ubicacion,
terreno_area as terreno,
terreno_valorunitario as valorunitario,
valor_comercial as valorcomercial,
zonificacion as zonificacion
from em_local_industrial emloin
inner join ubi_departamento as ubidep on emloin.ubi_departamento_id = ubidep.departamento_id
inner join ubi_provincia as ubipro on emloin.ubi_provincia_id = ubipro.provincia_id
inner join ubi_distrito as ubidis on emloin.ubi_distrito_id = ubidis.distrito_id
where consultor_id = @id
union select emte.id,'TERRENO' as tipo,
estudio_fecha as fecha,
proyecto_id as proyecto,
informe_id as informe,
ubidep.nombre as departamento,
ubipro.nombre as provincia,
ubidis.nombre as distrito,
ubicacion as ubicacion,
terreno_area as terreno,
terreno_valorunitario as valorunitario,
valor_comercial as valorcomercial,
zonificacion as zonificacion 
from em_terreno emte
inner join ubi_departamento as ubidep on emte.ubi_departamento_id = ubidep.departamento_id
inner join ubi_provincia as ubipro on emte.ubi_provincia_id = ubipro.provincia_id
inner join ubi_distrito as ubidis on emte.ubi_distrito_id = ubidis.distrito_id
where consultor_id = @id;
