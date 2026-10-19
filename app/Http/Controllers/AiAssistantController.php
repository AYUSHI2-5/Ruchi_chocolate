<?php

namespace App\Http\Controllers;

use App\Services\AiAssistantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class AiAssistantController extends Controller
{
    public function __construct(
        protected AiAssistantService $aiService
    ) {}

    /**
     * Handle user conversation query.
     */
    public function chat(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'language' => 'nullable|string|in:en,hi,gu',
            'history' => 'nullable|array',
            'current_page' => 'nullable|string|max:255',
            'contact_form' => 'nullable|array',
            'contact_form.step' => 'nullable|string|max:32',
            'contact_form.fields' => 'nullable|array',
            'contact_form.fields.name' => 'nullable|string|max:255',
            'contact_form.fields.email' => 'nullable|string|max:255',
            'contact_form.fields.phone' => 'nullable|string|max:50',
            'contact_form.fields.subject' => 'nullable|string|max:255',
            'contact_form.fields.message' => 'nullable|string|max:5000',
            'contact_form.fields.phone_skipped' => 'nullable|boolean',
            'customisation_intake' => 'nullable|array',
            'customisation_intake.awaiting_description' => 'nullable|boolean',
        ]);

        try {
            $message = (string) $validated['message'];
            $language = (string) ($validated['language'] ?? 'en');
            $history = (array) ($validated['history'] ?? []);
            $currentPage = (string) ($validated['current_page'] ?? '');
            $contactForm = (array) ($validated['contact_form'] ?? []);
            $customisationIntake = (array) ($validated['customisation_intake'] ?? []);

            $result = $this->aiService->processMessage($message, $language, $history, $currentPage, $contactForm, $customisationIntake);

            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        } catch (Throwable $e) {
            Log::error('AI Assistant Error: '.$e->getMessage().' at '.$e->getFile().':'.$e->getLine());

            return response()->json([
                'success' => false,
                'error' => 'An error occurred while processing your request.',
                'data' => [
                    'message' => 'I apologize, but I had a momentary hiccup! Please feel free to ask again or chat with our team directly on WhatsApp (+91 7490828282).',
                    'speech_text' => 'Please feel free to ask again or chat with our team on WhatsApp.',
                    'action' => 'whatsapp',
                    'action_url' => 'https://wa.me/917490828282?text='.urlencode('Hi Ruchi Chocolates, I need assistance with an order.'),
                    'action_label' => 'Chat on WhatsApp',
                    'quick_replies' => ['Browse Products 🍫', 'Customise a Gift ✨'],
                ],
            ], 200);
        }
    }
}
