<?php

namespace App\Services;

class ContactWhatsAppInquiry
{
    /**
     * @param  array{name: string, email: string, phone?: string|null, subject: string, message: string}  $fields
     */
    public function buildMessage(array $fields): string
    {
        $name = trim($fields['name']);
        $email = trim($fields['email']);
        $phone = trim((string) ($fields['phone'] ?? ''));
        $subject = trim($fields['subject']);
        $message = trim($fields['message']);

        $phoneLine = $phone !== '' ? "Phone: {$phone}\n" : '';

        return "Hello Ruchi Homemade Chocolates,\n\n"
            ."I submitted a message through your website contact form:\n\n"
            ."Name: {$name}\n"
            ."Email: {$email}\n"
            .$phoneLine
            ."Subject: {$subject}\n\n"
            ."Message:\n{$message}\n\n"
            .'Thank you!';
    }

    /**
     * @param  array{name: string, email: string, phone?: string|null, subject: string, message: string}  $fields
     */
    public function buildInquiryUrl(array $fields): string
    {
        $baseUrl = rtrim((string) config('ruchi.whatsapp_url'), '/');

        return $baseUrl.'?text='.rawurlencode($this->buildMessage($fields));
    }
}
