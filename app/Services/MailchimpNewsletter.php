<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements NewsletterInterface
{
    public function __construct(protected ApiClient $client)
    {
    }

    public function getCacheKey(string $email)
    {
        return 'subscribed_' . md5($email);
    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

    public function getListMember(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->getListMember($list, md5($email));
    }

    public function deleteListMember(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->deleteListMember($list, md5($email));
    }

    public function emailIsSubscribed(string $email = null)
    {
        if (!empty($email)) {
            return Cache::rememberForever($this->getCacheKey($email), function () use ($email) {
                try {
                    $newsletterUser = $this->getListMember($email);
                    if($newsletterUser->status === 'subscribed') {
                        return true;
                    }
                } catch (\Exception $e) {
                }
                return false;
            });
        }

        return false;
    }
}
