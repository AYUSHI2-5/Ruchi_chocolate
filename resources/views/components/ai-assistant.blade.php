{{-- =========================================================================
     Ruchi Chocolates — AI Voice & Text Shopping Assistant with Animated Avatar
     ========================================================================= --}}
<div id="rcAiAssistantRoot" class="rc-ai-root" data-api-url="{{ route('api.ai.chat') }}">

    <div id="rcAiBackdrop" class="rc-ai-backdrop" aria-hidden="true"></div>

    {{-- Floating trigger: chef avatar + label (single control) --}}
    <div id="rcAiFloatingTrigger" class="rc-ai-trigger-wrap">
        <button
            type="button"
            id="rcAiAvatarBtn"
            class="rc-ai-trigger-cluster"
            aria-expanded="false"
            aria-controls="rcAiChatPanel"
            aria-label="Ask Ruchi AI — open chocolate gifting assistant"
            title="Ask Ruchi AI — Your Chocolate Gifting Specialist"
        >
            <span class="rc-ai-trigger-label" id="rcAiTriggerLabel">
                <svg class="rc-ai-sparkle-icon" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8z"/>
                </svg>
                <span id="rcAiTriggerLabelText">Ask Ruchi AI</span>
            </span>

            <div class="rc-ai-character-figure rc-chef-rig rc-chef-rig--trigger" id="rcAiCharacterFigure" data-rig-state="idle">
                <div class="rc-chef-rig-body-wrap">
                    <img
                        src="{{ asset('images/ruchi-chef-avatar.png') }}"
                        alt=""
                        class="rc-ai-character-img rc-chef-rig-base-img"
                        id="rcAiCharacterImg"
                    >
                    <div class="rc-chef-rig-eyes-wrap" aria-hidden="true">
                        <span class="rc-chef-rig-eyelid rc-chef-rig-eyelid--left"></span>
                        <span class="rc-chef-rig-eyelid rc-chef-rig-eyelid--right"></span>
                    </div>
                    <div class="rc-ai-speaking-bars" id="rcAiSpeakingBars" aria-hidden="true">
                        <span></span><span></span><span></span><span></span>
                    </div>
                </div>
                <span class="rc-ai-status-dot" id="rcAiStatusDot" title="Online"></span>
            </div>

            {{-- Legacy hooks kept for voice/lip-sync scripts --}}
            <span id="rcAiRigTrigger" class="rc-ai-sr-only" aria-hidden="true"></span>
            <div id="rcAiAvatarFace" class="rc-ai-sr-only" aria-hidden="true">
                <span class="rc-ai-avatar-mouth" id="rcAiAvatarMouth" aria-hidden="true"></span>
            </div>
            <img
                src="{{ asset('images/ruchi-ai-avatar.jpg') }}"
                alt=""
                class="rc-ai-sr-only"
                id="rcAiAvatarImg"
                aria-hidden="true"
            >
        </button>
    </div>

    {{-- 2. Floating AI Chat Panel --}}
    <section 
        id="rcAiChatPanel" 
        class="rc-ai-panel" 
        role="dialog" 
        aria-modal="true" 
        aria-labelledby="rcAiPanelTitle"
        aria-hidden="true"
    >
        <!-- Panel Header -->
        <header class="rc-ai-panel-header">
            <div class="rc-ai-header-brand">
                <div class="rc-ai-header-avatar-wrap" id="rcAiHeaderAvatarWrap">
                    <img
                        src="{{ asset('images/ruchi-chef-avatar-head.png') }}"
                        alt="Ruchi AI"
                        class="rc-ai-header-avatar rc-ai-header-avatar--chef"
                    >
                    <img
                        src="{{ asset('images/ruchi-ai-avatar.jpg') }}"
                        alt="Ruchi AI"
                        class="rc-ai-header-avatar rc-ai-header-avatar--fallback"
                        style="display:none;"
                    >
                    <span class="rc-ai-header-avatar-mouth" id="rcAiHeaderMouth" aria-hidden="true" style="display:none;"></span>
                    <span class="rc-ai-header-status-dot"></span>
                </div>
                <div class="rc-ai-header-info">
                    <div class="rc-ai-header-title-row">
                        <h3 id="rcAiPanelTitle" class="rc-ai-header-title">Ruchi AI</h3>
                        <span class="rc-ai-badge" id="rcAiStateBadge">Expert</span>
                    </div>
                    <p class="rc-ai-header-sub" id="rcAiHeaderSub">Chocolatier &amp; Gifting Assistant</p>
                </div>
            </div>

            <!-- Header Action Controls -->
            <div class="rc-ai-header-actions">
                <!-- Language Selector -->
                <div class="rc-ai-lang-select-wrap" title="Change Language">
                    <select id="rcAiLangSelect" class="rc-ai-lang-select" aria-label="Select Assistant Language">
                        <option value="en">English (India)</option>
                        <option value="hi">हिन्दी (Hindi)</option>
                        <option value="gu">ગુજરાતી (Gujarati)</option>
                    </select>
                </div>

                <!-- Speaker / Voice Toggle -->
                <button 
                    type="button" 
                    id="rcAiVoiceToggle" 
                    class="rc-ai-icon-btn is-active" 
                    title="Toggle voice narration (Text-to-Speech)"
                    aria-label="Toggle voice output"
                >
                    <!-- Speaker On -->
                    <svg class="rc-ai-icon-speaker-on" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                    </svg>
                    <!-- Speaker Off -->
                    <svg class="rc-ai-icon-speaker-off" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                        <line x1="23" y1="9" x2="17" y2="15"></line>
                        <line x1="17" y1="9" x2="23" y2="15"></line>
                    </svg>
                </button>

                <!-- Minimise / Close Button -->
                <button 
                    type="button" 
                    id="rcAiCloseBtn" 
                    class="rc-ai-icon-btn rc-ai-close-btn" 
                    title="Minimise chat"
                    aria-label="Minimise chat"
                >
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        </header>

        <!-- Browser Autoplay Unlock Notice (if required by browser) -->
        <div id="rcAiAutoplayPrompt" class="rc-ai-autoplay-prompt" style="display:none;" aria-live="polite">
            <div class="rc-ai-autoplay-text">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                    <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                </svg>
                <span>Voice replies are on. Click to enable sound playback:</span>
            </div>
            <button type="button" id="rcAiEnableAudioBtn" class="rc-ai-enable-audio-btn">
                Enable Voice Replies
            </button>
        </div>

        <!-- Voice Recognition Status Banner (Visible when listening) -->
        <div id="rcAiVoiceBanner" class="rc-ai-voice-banner" style="display:none;" aria-live="polite">
            <div class="rc-ai-voice-banner-content">
                <span class="rc-ai-voice-pulsing-dot"></span>
                <span id="rcAiVoiceStatusText">Listening to your voice... Speak now</span>
            </div>
            <button type="button" id="rcAiVoiceCancelBtn" class="rc-ai-voice-cancel-btn">Cancel</button>
        </div>

        <!-- Active Website Navigation Status Banner (Visible when redirecting/navigating) -->
        <div id="rcAiNavBanner" class="rc-ai-nav-banner" style="display:none;" aria-live="polite">
            <div class="rc-ai-nav-banner-content">
                <span class="rc-ai-nav-spinner" aria-hidden="true"></span>
                <div class="rc-ai-nav-info">
                    <span id="rcAiNavStatusText" class="rc-ai-nav-status">Navigating to page...</span>
                    <a href="#" id="rcAiNavFallbackLink" class="rc-ai-nav-fallback-link" style="display:none;">Click here if not redirected automatically</a>
                </div>
            </div>
        </div>

        <!-- Chat Conversation Messages Body -->
        <div id="rcAiMessagesBody" class="rc-ai-messages-body" role="log" aria-live="polite">
            
            <!-- Welcome Greeting Card -->
            <div class="rc-ai-message rc-ai-message--assistant">
                <div class="rc-ai-msg-avatar">
                    <img src="{{ asset('images/ruchi-chef-avatar-head.png') }}" alt="Ruchi AI">
                </div>
                <div class="rc-ai-msg-content">
                    <div class="rc-ai-bubble rc-ai-bubble--welcome">
                        <div class="rc-ai-welcome-header">
                            <span class="rc-ai-welcome-badge">🍫 Handcrafted with Love</span>
                        </div>
                        <p class="rc-ai-welcome-text">
                            <strong>Hi! I'm Ruchi's AI Assistant.</strong> How can I make your day sweeter?
                        </p>
                        <p class="rc-ai-welcome-sub">
                            Ask me about our handmade chocolates, personalized gifts, shop pickup, or current offers!
                        </p>
                    </div>
                    <div class="rc-ai-msg-time" id="rcAiWelcomeTime">Just now</div>
                </div>
            </div>

            <!-- Quick Action Chips -->
            <div class="rc-ai-quick-actions-wrap" id="rcAiQuickActions">
                <span class="rc-ai-quick-title">Same help you get on WhatsApp:</span>
                <div class="rc-ai-chips-list">
                    <button type="button" class="rc-ai-chip" data-query="Browse Products">
                        <span>🎁 Browse Products</span>
                    </button>
                    <button type="button" class="rc-ai-chip" data-query="Customise a Gift">
                        <span>✨ Customise a Gift</span>
                    </button>
                    <button type="button" class="rc-ai-chip" data-query="Talk to a Human on WhatsApp">
                        <span>💬 Chat on WhatsApp</span>
                    </button>
                </div>
            </div>

            <!-- Typing Indicator (Hidden by default) -->
            <div id="rcAiTypingIndicator" class="rc-ai-typing-indicator" style="display:none;" aria-hidden="true">
                <div class="rc-ai-msg-avatar">
                    <img src="{{ asset('images/ruchi-chef-avatar-head.png') }}" alt="Ruchi AI">
                </div>
                <div class="rc-ai-typing-bubble">
                    <span class="rc-ai-typing-dot"></span>
                    <span class="rc-ai-typing-dot"></span>
                    <span class="rc-ai-typing-dot"></span>
                </div>
            </div>

        </div>

        <!-- Chat Input Form Footer -->
        <footer class="rc-ai-panel-footer">
            <!-- Active Voice Playback & Control Bar (Visible when assistant is speaking) -->
            <div id="rcAiSpeechControlBar" class="rc-ai-speech-control-bar" style="display:none;" aria-live="polite">
                <div class="rc-ai-speech-info">
                    <!-- Live Audio Waveform Indicator -->
                    <div class="rc-ai-live-waveform" aria-hidden="true">
                        <span></span><span></span><span></span><span></span><span></span>
                    </div>
                    <span id="rcAiSpeechStatusText" class="rc-ai-speech-status-text">Ruchi AI is speaking...</span>
                </div>
                <div class="rc-ai-speech-actions">
                    <!-- Pause/Resume Button -->
                    <button type="button" id="rcAiSpeechPauseBtn" class="rc-ai-speech-action-btn" title="Pause speech narration" aria-label="Pause speech narration">
                        <svg class="rc-ai-icon-pause" width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                            <rect x="6" y="4" width="4" height="16" rx="1"></rect>
                            <rect x="14" y="4" width="4" height="16" rx="1"></rect>
                        </svg>
                        <svg class="rc-ai-icon-play" width="13" height="13" viewBox="0 0 24 24" fill="currentColor" style="display:none;">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                        <span id="rcAiSpeechPauseLabel">Pause</span>
                    </button>
                    <!-- Stop/Interrupt Button -->
                    <button type="button" id="rcAiSpeechStopBtn" class="rc-ai-speech-action-btn rc-ai-speech-action-btn--stop" title="Interrupt and stop speaking" aria-label="Interrupt and stop speaking">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                            <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                        </svg>
                        <span>Stop</span>
                    </button>
                    <!-- Mute Button -->
                    <button type="button" id="rcAiSpeechMuteBtn" class="rc-ai-speech-action-btn rc-ai-speech-action-btn--mute" title="Mute voice replies" aria-label="Mute voice replies">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                            <path d="M9 9v3a3 3 0 0 0 5.12 2.12M15 9.34V4a3 3 0 0 0-5.94-.6"></path>
                            <path d="M17 16.95A7 7 0 0 1 5 12v-2m14 0v2a7 7 0 0 1-.11 1.23"></path>
                        </svg>
                        <span>Mute</span>
                    </button>
                </div>
            </div>

            <!-- Mic status / Notice bar -->
            <div id="rcAiNoticeBar" class="rc-ai-notice-bar" style="display:none;"></div>

            <form id="rcAiChatForm" class="rc-ai-input-form" autocomplete="off">
                <!-- Voice Input Microphone Button -->
                <button 
                    type="button" 
                    id="rcAiMicBtn" 
                    class="rc-ai-mic-btn" 
                    title="Speak using your microphone" 
                    aria-label="Activate voice speech recognition"
                >
                    <svg class="rc-ai-mic-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                        <line x1="12" y1="19" x2="12" y2="23"></line>
                        <line x1="8" y1="23" x2="16" y2="23"></line>
                    </svg>
                </button>

                <!-- Text Input Field -->
                <div class="rc-ai-input-wrap">
                    <input 
                        type="text" 
                        id="rcAiTextInput" 
                        class="rc-ai-text-input" 
                        placeholder="Ask about chocolates, flavours, gifts..." 
                        aria-label="Type your message"
                        maxlength="1000"
                    >
                </div>

                <!-- Send Button -->
                <button 
                    type="submit" 
                    id="rcAiSendBtn" 
                    class="rc-ai-send-btn" 
                    title="Send message" 
                    aria-label="Send message"
                >
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </form>

            <div class="rc-ai-footer-hint">
                <span>🎙️ Voice &amp; text enabled • Powered by Ruchi AI Knowledge Engine</span>
            </div>
        </footer>

    </section>

    {{-- 3. On-Page Virtual Website Tour Guide Companion Dock (Section Guide) --}}
    <aside 
        id="rcAiTourGuideBeacon" 
        class="rc-ai-tour-beacon" 
        style="display:none;" 
        aria-live="polite"
        aria-label="Ruchi AI Interactive Guide Companion"
    >
        <div class="rc-ai-beacon-inner">
            <!-- Animated Guide Character Rig -->
            <div class="rc-ai-beacon-avatar-col">
                <div class="rc-ai-beacon-character-wrap" id="rcAiBeaconCharacterWrap">
                    @include('components.ai-avatar-character', ['id' => 'rcAiRigBeacon', 'size' => '85px'])
                </div>
            </div>

            <!-- Guide Speech Bubble & Context Controls -->
            <div class="rc-ai-beacon-content">
                <div class="rc-ai-beacon-header">
                    <span class="rc-ai-beacon-badge" id="rcAiBeaconBadge">
                        <svg class="rc-ai-sparkle-icon" width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8z"/>
                        </svg>
                        <span id="rcAiBeaconBadgeText">Ruchi AI Guide</span>
                    </span>
                    <button type="button" id="rcAiBeaconCloseBtn" class="rc-ai-beacon-close-btn" title="Dismiss guide highlight" aria-label="Dismiss guide">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <h4 class="rc-ai-beacon-title" id="rcAiBeaconTitle">Exploring This Section</h4>
                <p class="rc-ai-beacon-text" id="rcAiBeaconText">I am guiding you to this section.</p>

                <!-- Audio Wave & Actions -->
                <div class="rc-ai-beacon-actions">
                    <div class="rc-ai-beacon-wave" id="rcAiBeaconWave" aria-hidden="true">
                        <span></span><span></span><span></span><span></span>
                    </div>
                    <button type="button" id="rcAiBeaconReplayBtn" class="rc-ai-beacon-btn rc-ai-beacon-btn--replay" title="Repeat explanation aloud">
                        <span>🔊 Replay</span>
                    </button>
                    <button type="button" id="rcAiBeaconNextBtn" class="rc-ai-beacon-btn rc-ai-beacon-btn--next" title="Guide to next section">
                        <span>➡️ Next Section</span>
                    </button>
                    <button type="button" id="rcAiBeaconOpenChatBtn" class="rc-ai-beacon-btn rc-ai-beacon-btn--chat" title="Open full conversation">
                        <span>💬 Chat</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Pointer arrow pointing toward the spotlighted element -->
        <div class="rc-ai-beacon-pointer-arrow" id="rcAiBeaconPointerArrow" aria-hidden="true"></div>
    </aside>

</div>
