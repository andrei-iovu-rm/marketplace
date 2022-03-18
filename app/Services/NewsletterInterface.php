<?php

namespace App\Services;

interface NewsletterInterface
{
    public function subscribe(string $email, string $list = null);
    public function getListMember(string $subscriber_hash, string $list = null);
    public function deleteListMember(string $subscriber_hash, string $list = null);
}
