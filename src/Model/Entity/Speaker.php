<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Speaker Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $about
 * @property string $twitter_link
 * @property string $facebook_link
 * @property string $linkedin_link
 * @property string $google_link
 * @property int $offer_id
 * @property int $edition_id
 * @property string $photo
 *
 * @property \App\Model\Entity\Offer $offer
 * @property \App\Model\Entity\Edition $edition
 */
class Speaker extends Entity
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
