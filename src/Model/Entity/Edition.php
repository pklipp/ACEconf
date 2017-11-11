<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Edition Entity
 *
 * @property int $id
 * @property string $name
 *
 * @property \App\Model\Entity\Offer[] $offers
 * @property \App\Model\Entity\Setting[] $settings
 * @property \App\Model\Entity\Speaker[] $speakers
 * @property \App\Model\Entity\Submission[] $submissions
 */
class Edition extends Entity
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
