<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Offer Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $bio
 * @property string $vimeo
 * @property int $sponsor_id
 * @property int $edition_id
 *
 * @property \App\Model\Entity\Sponsor $sponsor
 * @property \App\Model\Entity\Edition $edition
 * @property \App\Model\Entity\Speaker[] $speakers
 */
class Offer extends Entity
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
