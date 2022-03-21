<?php

namespace App\Services;

interface NewsletterInterface
{
    public function subscribe(string $email, string $list = null);
    public function getListMember(string $email, string $list = null);
    public function deleteListMember(string $email, string $list = null);
    public function emailIsSubscribed(string $email = null);
}
