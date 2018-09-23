<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Terreno Entity
 *
 * @property int $id
 * @property string $coordinacion
 * @property float $area
 * @property float $valorunitario
 * @property float $total
 * @property float $longitud
 * @property float $latitud
 * @property string $observacion
 * @property string $ruta
 */
class Terreno extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
