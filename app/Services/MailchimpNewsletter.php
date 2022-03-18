<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements NewsletterInterface
{
    public function __construct(protected ApiClient $client)
    {
    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

    public function getListMember(string $subscriber_hash, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->getListMember($list, $subscriber_hash);
    }

    public function deleteListMember(string $subscriber_hash, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->deleteListMember($list, $subscriber_hash);
    }
}
