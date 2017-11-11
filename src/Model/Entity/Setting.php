<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity
 *
 * @property int $id
 * @property int $edition_id
 * @property string $title
 * @property \Cake\I18n\Time $start_date
 * @property string $place
 * @property string $icon_type_1
 * @property string $icon_type_2
 * @property string $icon_edition
 * @property string $icon_speakers
 * @property string $icon_workshops
 * @property string $icon_attendees
 * @property string $icon_videos
 * @property string $icon_talk
 * @property string $email
 * @property string $newsletter_text
 * @property string $header_photo
 * @property string $offer_file
 *
 * @property \App\Model\Entity\Edition $edition
 */
class Setting extends Entity
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
