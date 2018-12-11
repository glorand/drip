<?php

namespace Glorand\Drip\Tests\Models;

use Glorand\Drip\Models\Subscriber;
use PHPUnit\Framework\TestCase;

class SubscriberTest extends TestCase
{
    public function testModel()
    {
        $data = [
            'subscribers' => [
                [
                    'email'         => 'test@email.com',
                    'new_email'     => 'new@email.com',
                    'user_id'       => '12',
                    'time_zone'     => 'Europe/Amsterdam',
                    'ip_address'    => '127.0.0.1',
                    'custom_fields' => [
                        'custom_f_1' => 'val_custom_f_1',
                    ],
                    'tags'          => [
                        'tag_1' => 'val_tag_1',
                    ],
                    'remove_tags'   => [
                        'remove_tag_1' => 'remove_val_tag_1',
                    ],
                ],
            ],
        ];
        $subscriber = new Subscriber();
        $subscriber->setEmail('test@email.com')
            ->setNewEmail('new@email.com')
            ->setUserId('12')
            ->setTimeZone('Europe/Amsterdam')
            ->setIpAddress('127.0.0.1')
            ->setCustomFields(['custom_f_0' => 'val_custom_f_0'])
            ->addCustomField('custom_f_1', 'val_custom_f_1')
            ->removeCustomField('custom_f_0')
            ->setTags(['tag_2' => 'val_tag_2'])
            ->addTag('tag_1', 'val_tag_1')
            ->removeTag('tag_2')
            ->setRemoveTags(['remove_tag_1' => 'remove_val_tag_1']);
        $this->assertEquals($data, $subscriber->toDrip());
    }
}
