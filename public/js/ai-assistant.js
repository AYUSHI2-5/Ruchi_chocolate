/**
 * Ruchi Chocolates — Moving, Animated AI Virtual Website Guide
 * Features:
 * - Interactive 2D/3D Animated SVG Character Rig with multi-arm poses, visemes, and expressions
 * - Idle breathing, blinking, walking, thinking, listening, pointing, and explaining gestures
 * - Synchronized Lip-Sync Viseme Sequencing during natural female voice speech synthesis
 * - Conversational Voice Navigation & Route-to-Route State Preservation
 * - Real Microphone Web Speech Recognition with immediate voice command interception
 * - Smooth Scrolling, Spotlight Section Highlighting & Pointer Cues
 * - On-Page Tour Guide Beacon Dock (positioned safely on bottom-left, never overlapping WhatsApp)
 * - Accessibility: Prefers-Reduced-Motion fallback & screen reader ARIA support
 */
(function () {
    'use strict';

    // Root Element
    const rootEl = document.getElementById('rcAiAssistantRoot');
    if (!rootEl) return;

    const apiUrl = rootEl.getAttribute('data-api-url') || '/api/ai/chat';
    const panelBackdrop = document.getElementById('rcAiBackdrop');

    // 1. Floating Trigger Elements
    const avatarBtn = document.getElementById('rcAiAvatarBtn');
    const avatarFace = document.getElementById('rcAiAvatarFace');
    const avatarMouth = document.getElementById('rcAiAvatarMouth');
    const triggerLabel = document.getElementById('rcAiTriggerLabel');
    const triggerLabelText = document.getElementById('rcAiTriggerLabelText');
    const speakingBars = document.getElementById('rcAiSpeakingBars');

    // 2. Chat Panel Elements
    const chatPanel = document.getElementById('rcAiChatPanel');
    const headerAvatarWrap = document.getElementById('rcAiHeaderAvatarWrap');
    const headerMouth = document.getElementById('rcAiHeaderMouth');
    const stateBadge = document.getElementById('rcAiStateBadge');
    const headerSub = document.getElementById('rcAiHeaderSub');
    const closeBtn = document.getElementById('rcAiCloseBtn');
    const langSelect = document.getElementById('rcAiLangSelect');
    const voiceToggleBtn = document.getElementById('rcAiVoiceToggle');
    const micBtn = document.getElementById('rcAiMicBtn');
    const chatForm = document.getElementById('rcAiChatForm');
    const textInput = document.getElementById('rcAiTextInput');
    const messagesBody = document.getElementById('rcAiMessagesBody');
    const typingIndicator = document.getElementById('rcAiTypingIndicator');
    const voiceBanner = document.getElementById('rcAiVoiceBanner');
    const voiceStatusText = document.getElementById('rcAiVoiceStatusText');
    const voiceCancelBtn = document.getElementById('rcAiVoiceCancelBtn');
    const navBanner = document.getElementById('rcAiNavBanner');
    const navStatusText = document.getElementById('rcAiNavStatusText');
    const navFallbackLink = document.getElementById('rcAiNavFallbackLink');
    const noticeBar = document.getElementById('rcAiNoticeBar');

    // 3. Active Speech Control Bar Elements
    const speechControlBar = document.getElementById('rcAiSpeechControlBar');
    const speechStatusText = document.getElementById('rcAiSpeechStatusText');
    const speechPauseBtn = document.getElementById('rcAiSpeechPauseBtn');
    const speechPauseLabel = document.getElementById('rcAiSpeechPauseLabel');
    const speechStopBtn = document.getElementById('rcAiSpeechStopBtn');
    const speechMuteBtn = document.getElementById('rcAiSpeechMuteBtn');

    // 4. Autoplay Audio Unlock Elements
    const autoplayPrompt = document.getElementById('rcAiAutoplayPrompt');
    const enableAudioBtn = document.getElementById('rcAiEnableAudioBtn');

    // 5. On-Page Tour Guide Beacon Elements
    const tourBeacon = document.getElementById('rcAiTourGuideBeacon');
    const beaconCloseBtn = document.getElementById('rcAiBeaconCloseBtn');
    const beaconTitle = document.getElementById('rcAiBeaconTitle');
    const beaconText = document.getElementById('rcAiBeaconText');
    const beaconWave = document.getElementById('rcAiBeaconWave');
    const beaconReplayBtn = document.getElementById('rcAiBeaconReplayBtn');
    const beaconNextBtn = document.getElementById('rcAiBeaconNextBtn');
    const beaconChatBtn = document.getElementById('rcAiBeaconOpenChatBtn');

    // State Variables
    let isOpen = false;
    let voiceEnabled = true;
    let currentState = 'idle'; // 'idle', 'listening', 'thinking', 'speaking', 'navigating', 'pointing'
    let currentGesture = 'idle'; // 'idle', 'welcoming', 'listening', 'thinking', 'walking', 'speaking', 'pointing', 'pointing-down', 'explaining', 'interrupted'
    let isPaused = false;
    let audioUnlocked = false;
    let currentLanguage = 'en'; // 'en', 'hi', 'gu'
    let conversationHistory = [];
    let contactFormState = null;
    let recognition = null;
    let synth = window.speechSynthesis || null;
    let voices = [];
    let currentSpeechQueue = [];
    let currentQueueIndex = 0;
    let currentUtterance = null;
    let lastSpokenText = '';
    let lastSectionTarget = null;
    let keepAliveTimer = null;
    let navigationTimeout = null;
    let visemeTimer = null;
    let currentHighlightedEl = null;
    let highlightClearTimer = null;
    let pointerCueEl = null;

    // Language locales for Web Speech API
    const langLocales = {
        'en': 'en-IN',
        'hi': 'hi-IN',
        'gu': 'gu-IN'
    };

    /* =========================================================================
       1. Initialization, Voice Setup & State Restoration
       ========================================================================= */
    function init() {
        initVoices();
        setupEventListeners();
        restoreNavigationSession();
        updateVoiceToggleUI();
        setAvatarGesture('idle');
    }

    function initVoices() {
        if (!synth) return;
        loadVoices();
        if (synth.onvoiceschanged !== undefined) {
            synth.onvoiceschanged = loadVoices;
        }
    }

    function loadVoices() {
        if (!synth) return;
        voices = synth.getVoices() || [];
    }

    /**
     * Restore conversation history, voice settings, and guide customer to target section across page transitions.
     */
    function restoreNavigationSession() {
        const raw = sessionStorage.getItem('rc_ai_nav_state');
        if (!raw) return;

        try {
            const saved = JSON.parse(raw);
            sessionStorage.removeItem('rc_ai_nav_state');

            if (!saved) return;

            // 1. Restore voice preferences & language
            if (saved.voiceEnabled !== undefined) {
                voiceEnabled = Boolean(saved.voiceEnabled);
            }
            if (saved.currentLanguage) {
                currentLanguage = saved.currentLanguage;
                if (langSelect) langSelect.value = currentLanguage;
            }

            // 2. Restore conversation history
            if (Array.isArray(saved.conversationHistory)) {
                conversationHistory = saved.conversationHistory;
            }

            // 3. Re-open chat panel seamlessly
            openPanel();

            // 4. Deliver destination section explanation and spotlight
            const targetSection = saved.section_target || (saved.pendingExplanation && saved.pendingExplanation.section_target);
            const expl = saved.pendingExplanation;

            if (expl) {
                // Add to history
                conversationHistory.push({ role: 'assistant', content: expl.message || '' });
                appendAssistantMessage(expl);

                const executeSectionGuide = function () {
                    loadVoices();

                    // Focus and highlight section on the page
                    if (targetSection) {
                        focusSectionTargetForResponse(
                            targetSection,
                            expl.message || expl.speech_text || '',
                            expl.action || null
                        );
                    }

                    // Speak explanation aloud
                    if (voiceEnabled && (expl.speech_text || expl.message)) {
                        const speechToPlay = expl.speech_text || expl.message;
                        lastSpokenText = speechToPlay;
                        setTimeout(function () {
                            speakText(speechToPlay, targetSection?.gesture || 'explaining');
                        }, 500);
                    } else if (targetSection?.gesture) {
                        setAvatarGesture(targetSection.gesture);
                    }
                };

                if (document.readyState === 'complete') {
                    executeSectionGuide();
                } else {
                    window.addEventListener('load', executeSectionGuide, { once: true });
                }
            } else if (targetSection) {
                focusSectionTargetForResponse(targetSection, '', null);
            }

        } catch (e) {
            console.warn('Error restoring AI assistant navigation state:', e);
        }
    }

    function setupEventListeners() {
        // Floating trigger click opens panel & unlocks audio
        if (avatarBtn) {
            avatarBtn.addEventListener('click', function () {
                unlockAudio();
                togglePanel();
            });
        }

        // Close/Minimise button
        if (closeBtn) {
            closeBtn.addEventListener('click', closePanel);
        }

        if (panelBackdrop) {
            panelBackdrop.addEventListener('click', closePanel);
        }

        // Language selection
        if (langSelect) {
            langSelect.addEventListener('change', function () {
                currentLanguage = this.value;
                if (recognitionInstance) {
                    recognitionInstance.lang = langLocales[currentLanguage] || 'en-IN';
                }
                if (currentState === 'speaking') {
                    stopSpeech();
                }
            });
        }

        // Header Voice TTS Toggle (Mute / Unmute)
        if (voiceToggleBtn) {
            voiceToggleBtn.addEventListener('click', function () {
                unlockAudio();
                toggleVoiceOutput();
            });
        }

        // Speech Bar Controls: Pause / Resume
        if (speechPauseBtn) {
            speechPauseBtn.addEventListener('click', toggleSpeechPause);
        }

        // Speech Bar Controls: Stop / Interrupt
        if (speechStopBtn) {
            speechStopBtn.addEventListener('click', interruptSpeech);
        }

        // Speech Bar Controls: Mute
        if (speechMuteBtn) {
            speechMuteBtn.addEventListener('click', function () {
                toggleVoiceOutput(false);
            });
        }

        // Autoplay Enable Audio Button
        if (enableAudioBtn) {
            enableAudioBtn.addEventListener('click', function () {
                unlockAudio();
                hideAutoplayPrompt();
                if (lastSpokenText) {
                    speakText(lastSpokenText);
                }
            });
        }

        // Mic Button (Speech-to-Text)
        if (micBtn) {
            micBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                unlockAudio();
                toggleSpeechRecognition();
            });
        }

        // Cancel voice input button
        if (voiceCancelBtn) {
            voiceCancelBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                stopSpeechRecognition(true);
            });
        }

        // Text Form Submission
        if (chatForm) {
            chatForm.addEventListener('submit', function (e) {
                e.preventDefault();
                unlockAudio();
                const msg = textInput ? textInput.value.trim() : '';
                if (!msg) return;
                textInput.value = '';
                sendMessage(msg);
            });
        }

        // User interaction unlock anywhere in panel
        if (chatPanel) {
            chatPanel.addEventListener('click', unlockAudio, { passive: true });
        }

        // Quick action chips and message action buttons delegation
        if (messagesBody) {
            messagesBody.addEventListener('click', function (e) {
                unlockAudio();

                // Quick chip click
                const chip = e.target.closest('.rc-ai-chip');
                if (chip) {
                    const query = chip.getAttribute('data-query');
                    if (query) {
                        sendMessage(query);
                    }
                    return;
                }

                // Replay speech button
                const replayBtn = e.target.closest('.rc-ai-replay-btn');
                if (replayBtn) {
                    const speechText = replayBtn.getAttribute('data-speech');
                    if (speechText) {
                        voiceEnabled = true;
                        updateVoiceToggleUI();
                        speakText(speechText);
                    }
                    return;
                }

                // Product Quick View trigger button
                const prodBtn = e.target.closest('.rc-ai-pcard-btn');
                if (prodBtn) {
                    const prodId = prodBtn.getAttribute('data-product-id');
                    if (prodId && typeof window.rcOpenProductModal === 'function') {
                        window.rcOpenProductModal(prodId, prodBtn);
                    } else if (prodId) {
                        window.location.href = '/products';
                    }
                    return;
                }
            });
        }

        // Tour Guide Beacon Controls
        if (beaconCloseBtn) {
            beaconCloseBtn.addEventListener('click', hideTourGuideBeacon);
        }
        if (beaconReplayBtn) {
            beaconReplayBtn.addEventListener('click', function () {
                unlockAudio();
                if (lastSpokenText) {
                    voiceEnabled = true;
                    updateVoiceToggleUI();
                    speakText(lastSpokenText, lastSectionTarget?.gesture || 'explaining');
                    if (lastSectionTarget) {
                        focusSectionTarget(lastSectionTarget, lastSpokenText);
                    }
                }
            });
        }
        if (beaconNextBtn) {
            beaconNextBtn.addEventListener('click', function () {
                unlockAudio();
                openPanel();
                sendMessage('Go to the next section');
            });
        }
        if (beaconChatBtn) {
            beaconChatBtn.addEventListener('click', function () {
                unlockAudio();
                openPanel();
            });
        }

        // Escape key closes panel
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && isOpen) {
                closePanel();
            }
        });
    }

    /* =========================================================================
       2. Avatar Character Rig & Visual State Machine
       ========================================================================= */

    /**
     * Update the animated character rig state (floating trigger avatar).
     * Gestures follow conversation and navigation automatically.
     */
    function setAvatarGesture(gesture) {
        currentGesture = gesture;

        const containers = document.querySelectorAll('.rc-ai-character-container');
        containers.forEach(el => {
            el.setAttribute('data-character-state', gesture);
        });

        const rigs = document.querySelectorAll('.rc-chef-rig');
        rigs.forEach(rig => {
            rig.setAttribute('data-rig-state', gesture);
        });
    }

    /**
     * Lip-sync phoneme sequencing: cyclically alternates mouth viseme SVG paths
     * while speech audio is playing.
     */
    const visemes = ['is-viseme-open', 'is-viseme-round', 'is-viseme-wide', 'is-viseme-open'];
    let visemeIndex = 0;

    function startLipSync() {
        stopLipSync();
        visemeTimer = setInterval(function () {
            const containers = document.querySelectorAll('.rc-ai-character-container');
            const currentViseme = visemes[visemeIndex % visemes.length];
            visemeIndex++;
            containers.forEach(el => {
                el.classList.remove('is-viseme-open', 'is-viseme-round', 'is-viseme-wide', 'is-viseme-rest');
                el.classList.add(currentViseme);
            });
        }, 150);
    }

    function stopLipSync() {
        if (visemeTimer) {
            clearInterval(visemeTimer);
            visemeTimer = null;
        }
        const containers = document.querySelectorAll('.rc-ai-character-container');
        containers.forEach(el => {
            el.classList.remove('is-viseme-open', 'is-viseme-round', 'is-viseme-wide');
            el.classList.add('is-viseme-rest');
        });
    }

    function setAssistantState(state, meta) {
        currentState = state;

        // Reset badge classes
        if (stateBadge) {
            stateBadge.classList.remove('is-listening', 'is-thinking', 'is-speaking', 'is-navigating');
        }

        switch (state) {
            case 'listening':
                setAvatarGesture('listening');
                if (stateBadge) {
                    stateBadge.textContent = 'Listening';
                    stateBadge.classList.add('is-listening');
                }
                if (headerSub) headerSub.textContent = 'Listening to your voice...';
                if (triggerLabelText) triggerLabelText.textContent = 'Listening...';
                if (voiceBanner) voiceBanner.style.display = 'flex';
                if (navBanner) navBanner.style.display = 'none';
                break;

            case 'thinking':
                setAvatarGesture('thinking');
                if (stateBadge) {
                    stateBadge.textContent = 'Thinking';
                    stateBadge.classList.add('is-thinking');
                }
                if (headerSub) headerSub.textContent = 'Guiding you through Ruchi...';
                if (triggerLabelText) triggerLabelText.textContent = 'Thinking...';
                if (voiceBanner) voiceBanner.style.display = 'none';
                if (navBanner) navBanner.style.display = 'none';
                showTypingIndicator();
                break;

            case 'speaking':
                if (meta && meta.gesture) {
                    setAvatarGesture(meta.gesture);
                } else if (currentGesture === 'idle' || currentGesture === 'thinking') {
                    setAvatarGesture('speaking');
                }
                if (stateBadge) {
                    stateBadge.textContent = 'Guiding';
                    stateBadge.classList.add('is-speaking');
                }
                if (headerSub) headerSub.textContent = 'Speaking response aloud...';
                if (triggerLabelText) triggerLabelText.textContent = 'Explaining...';
                if (voiceBanner) voiceBanner.style.display = 'none';
                if (navBanner) navBanner.style.display = 'none';
                hideTypingIndicator();
                break;

            case 'navigating': {
                const pageName = (meta && meta.page_name) ? meta.page_name : 'the next page';
                setAvatarGesture('walking', {
                    pageName: pageName,
                    line: 'Taking you to ' + pageName + '…',
                });
                if (stateBadge) {
                    stateBadge.textContent = 'Navigating';
                    stateBadge.classList.add('is-navigating');
                }
                if (headerSub) headerSub.textContent = 'Walking you to ' + pageName + '...';
                if (triggerLabelText) triggerLabelText.textContent = 'Guiding...';
                if (voiceBanner) voiceBanner.style.display = 'none';
                if (navBanner) {
                    navBanner.style.display = 'flex';
                    if (navStatusText) navStatusText.textContent = 'Navigating to ' + pageName + '...';
                    if (navFallbackLink && meta && meta.url) {
                        navFallbackLink.href = meta.url;
                        navFallbackLink.style.display = 'inline';
                    }
                }
                hideTypingIndicator();
                break;
            }

            case 'pointing':
                setAvatarGesture(meta && meta.gesture ? meta.gesture : 'pointing');
                if (stateBadge) stateBadge.textContent = 'Guiding';
                break;

            case 'interrupted':
                setAvatarGesture('interrupted');
                if (stateBadge) stateBadge.textContent = 'Ready';
                break;

            case 'idle':
            default:
                setAvatarGesture('idle');
                if (stateBadge) {
                    stateBadge.textContent = 'Expert Guide';
                }
                if (headerSub) headerSub.textContent = 'Chocolatier & Virtual Guide';
                if (triggerLabelText) triggerLabelText.textContent = 'Ask Ruchi AI';
                if (voiceBanner) voiceBanner.style.display = 'none';
                if (navBanner) navBanner.style.display = 'none';
                hideTypingIndicator();
                break;
        }
    }

    /* =========================================================================
       3. Interactive Section Guidance, Scrolling & Spotlighting
       ========================================================================= */

    function clearCurrentHighlight() {
        if (highlightClearTimer) {
            clearTimeout(highlightClearTimer);
            highlightClearTimer = null;
        }
        if (currentHighlightedEl) {
            currentHighlightedEl.classList.remove('rc-ai-highlighted-section');
            currentHighlightedEl = null;
        }
        if (pointerCueEl && pointerCueEl.parentNode) {
            pointerCueEl.parentNode.removeChild(pointerCueEl);
            pointerCueEl = null;
        }
    }

    const lightweightFormSectionSelectors = ['.rc-custom-form-card', '.rc-contact-form-card'];

    function shouldUseLightweightFormFocus(sectionTarget, dataAction) {
        if (!sectionTarget || !sectionTarget.selector) {
            return false;
        }

        if (lightweightFormSectionSelectors.includes(sectionTarget.selector)) {
            return true;
        }

        return dataAction === 'prefill_customisation_form' || dataAction === 'prefill_contact_form';
    }

    /**
     * Form / WhatsApp flows: scroll only — no floating "Ruchi AI Guide" dock or on-page sparkle overlay.
     */
    function focusSectionTargetForResponse(sectionTarget, explanationText, dataAction) {
        if (!sectionTarget) {
            return;
        }

        lastSectionTarget = sectionTarget;

        if (shouldUseLightweightFormFocus(sectionTarget, dataAction)) {
            hideTourGuideBeacon();
            clearCurrentHighlight();

            const el = document.querySelector(sectionTarget.selector);
            if (el && sectionTarget.scroll !== false) {
                const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                el.scrollIntoView({
                    behavior: prefersReduced ? 'auto' : 'smooth',
                    block: 'center'
                });
            }

            return;
        }

        focusSectionTarget(sectionTarget, explanationText);
    }

    /**
     * Smoothly scroll to, spotlight, and present the section being explained.
     */
    function focusSectionTarget(target, explanationText) {
        if (!target || !target.selector) return;

        clearCurrentHighlight();

        const el = document.querySelector(target.selector);
        if (!el) {
            return;
        }

        currentHighlightedEl = el;

        // 1. Smoothly scroll target into center view (respects prefers-reduced-motion)
        if (target.scroll !== false) {
            const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            el.scrollIntoView({
                behavior: prefersReduced ? 'auto' : 'smooth',
                block: 'center'
            });
        }

        // 2. Apply spotlight highlight
        if (target.highlight !== false) {
            el.classList.add('rc-ai-highlighted-section');

            // 3. Attach pointer cue
            pointerCueEl = document.createElement('div');
            pointerCueEl.className = 'rc-ai-section-pointer-cue';
            pointerCueEl.innerHTML = `
                <span class="rc-ai-pointer-sparkle">✨</span>
                <span>${escapeHtml(target.title || 'Recommended Section')}</span>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8z"/></svg>
            `;
            if (window.getComputedStyle(el).position === 'static') {
                el.style.position = 'relative';
            }
            el.appendChild(pointerCueEl);

            // 4. Set character rig gesture
            const gesture = target.gesture || 'pointing';
            setAvatarGesture(gesture, {
                line: explanationText || (target.title ? 'Here is ' + target.title + '.' : ''),
                sectionHint: target.title ? 'Showing you: ' + target.title : undefined,
            });

            // 5. Display Tour Guide Beacon dock
            showTourGuideBeacon(target, explanationText);

            // 6. Automatically clear highlight after 12s so page returns to normal state
            highlightClearTimer = setTimeout(function () {
                clearCurrentHighlight();
            }, 12000);
        }
    }

    function showTourGuideBeacon(target, explanationText) {
        if (!tourBeacon) return;

        if (beaconTitle) {
            beaconTitle.textContent = target.title || 'Exploring Section';
        }
        if (beaconText) {
            const clean = explanationText
                ? explanationText.replace(/\*\*.*?\*\*/g, '').replace(/[#*•]/g, '').replace(/\n+/g, ' ').trim()
                : 'Guiding you through this section.';
            beaconText.textContent = clean.length > 130 ? clean.slice(0, 130) + '...' : clean;
        }

        tourBeacon.style.display = 'block';
        requestAnimationFrame(function () {
            tourBeacon.classList.add('is-visible');
        });
    }

    function hideTourGuideBeacon() {
        if (!tourBeacon) return;
        tourBeacon.classList.remove('is-visible');
        setTimeout(function () {
            tourBeacon.style.display = 'none';
        }, 300);
        clearCurrentHighlight();
    }

    /* =========================================================================
       4. Panel Toggle & Audio Unlocking
       ========================================================================= */
    function togglePanel() {
        if (isOpen) {
            closePanel();
        } else {
            openPanel();
        }
    }

    function openPanel() {
        isOpen = true;
        chatPanel.classList.add('is-open');
        chatPanel.setAttribute('aria-hidden', 'false');
        avatarBtn.setAttribute('aria-expanded', 'true');
        if (panelBackdrop) {
            panelBackdrop.classList.add('is-visible');
            panelBackdrop.setAttribute('aria-hidden', 'false');
        }
        document.body.classList.add('rc-ai-panel-open');
        clearNotice();
        // Enlarge avatar into guide panel & play welcoming animation
        setAvatarGesture('welcoming');
        if (textInput) {
            setTimeout(() => textInput.focus(), 300);
        }
    }

    function closePanel() {
        isOpen = false;
        chatPanel.classList.remove('is-open');
        chatPanel.setAttribute('aria-hidden', 'true');
        avatarBtn.setAttribute('aria-expanded', 'false');
        if (panelBackdrop) {
            panelBackdrop.classList.remove('is-visible');
            panelBackdrop.setAttribute('aria-hidden', 'true');
        }
        document.body.classList.remove('rc-ai-panel-open');
        stopSpeech();
        stopSpeechRecognition();
        setAssistantState('idle');
        setAvatarGesture('idle');
    }

    function unlockAudio() {
        if (audioUnlocked) return;
        audioUnlocked = true;
        hideAutoplayPrompt();

        if (synth) {
            try {
                if (synth.paused) {
                    synth.resume();
                }
                const silentUtterance = new SpeechSynthesisUtterance('');
                silentUtterance.volume = 0;
                silentUtterance.rate = 2;
                synth.speak(silentUtterance);
            } catch (_) {}
        }
    }

    function showAutoplayPrompt() {
        if (autoplayPrompt) {
            autoplayPrompt.style.display = 'flex';
        }
    }

    function hideAutoplayPrompt() {
        if (autoplayPrompt) {
            autoplayPrompt.style.display = 'none';
        }
    }

    function toggleVoiceOutput(forceState) {
        if (forceState !== undefined) {
            voiceEnabled = Boolean(forceState);
        } else {
            voiceEnabled = !voiceEnabled;
        }

        updateVoiceToggleUI();

        if (!voiceEnabled && currentState === 'speaking') {
            stopSpeech();
        }
    }

    function updateVoiceToggleUI() {
        if (!voiceToggleBtn) return;
        const iconOn = voiceToggleBtn.querySelector('.rc-ai-icon-speaker-on');
        const iconOff = voiceToggleBtn.querySelector('.rc-ai-icon-speaker-off');

        if (voiceEnabled) {
            voiceToggleBtn.classList.add('is-active');
            voiceToggleBtn.setAttribute('title', 'Voice replies enabled. Click to mute.');
            if (iconOn) iconOn.style.display = 'block';
            if (iconOff) iconOff.style.display = 'none';
        } else {
            voiceToggleBtn.classList.remove('is-active');
            voiceToggleBtn.setAttribute('title', 'Voice replies muted. Click to enable.');
            if (iconOn) iconOn.style.display = 'none';
            if (iconOff) iconOff.style.display = 'block';
        }
    }

    function showNotice(msg, isError) {
        if (!noticeBar) return;
        noticeBar.textContent = msg;
        noticeBar.style.display = 'block';
        noticeBar.style.background = isError ? 'rgba(239, 68, 68, 0.12)' : 'rgba(217, 119, 6, 0.12)';
        noticeBar.style.color = isError ? '#b91c1c' : '#92400e';
    }

    function clearNotice() {
        if (!noticeBar) {
            return;
        }
        noticeBar.style.display = 'none';
        noticeBar.textContent = '';
    }

    /* =========================================================================
       5. Real Speech Recognition & Immediate Voice Command Handling
       ========================================================================= */
    let recognitionInstance = null;
    let isListening = false;
    let isProcessingSpeech = false;
    let hasSubmittedVoice = false;
    let accumulatedTranscript = '';
    let hasMicrophonePermission = false;

    function setMicState(state, message = '') {
        switch (state) {
            case 'listening':
                isListening = true;
                isProcessingSpeech = false;
                if (micBtn) {
                    micBtn.classList.add('is-listening');
                    micBtn.classList.remove('is-processing');
                    micBtn.setAttribute('title', 'Listening to your voice... Click to stop recording');
                    micBtn.setAttribute('aria-label', 'Stop listening');
                }
                if (voiceBanner) {
                    voiceBanner.style.display = 'flex';
                }
                if (voiceStatusText) {
                    voiceStatusText.textContent = message || getListeningPromptText();
                }
                setAssistantState('listening');
                clearNotice();
                break;

            case 'processing':
                isListening = false;
                isProcessingSpeech = true;
                if (micBtn) {
                    micBtn.classList.remove('is-listening');
                    micBtn.classList.add('is-processing');
                    micBtn.setAttribute('title', 'Processing your speech...');
                    micBtn.setAttribute('aria-label', 'Processing speech');
                }
                if (voiceBanner) {
                    voiceBanner.style.display = 'flex';
                }
                if (voiceStatusText) {
                    voiceStatusText.textContent = message || 'Processing your speech...';
                }
                if (stateBadge) {
                    stateBadge.textContent = 'Processing';
                    stateBadge.className = 'rc-ai-state-badge is-thinking';
                }
                if (triggerLabelText) {
                    triggerLabelText.textContent = 'Processing...';
                }
                break;

            case 'permission-denied':
                isListening = false;
                isProcessingSpeech = false;
                hasMicrophonePermission = false;
                if (micBtn) {
                    micBtn.classList.remove('is-listening', 'is-processing');
                    micBtn.setAttribute('title', 'Microphone access denied');
                    micBtn.setAttribute('aria-label', 'Microphone access denied');
                }
                if (voiceBanner) voiceBanner.style.display = 'none';
                showNotice('Microphone access was denied. To speak, click the camera/microphone icon in your browser address bar and choose "Allow".', true);
                setAssistantState('idle');
                break;

            case 'unsupported':
                isListening = false;
                isProcessingSpeech = false;
                if (micBtn) {
                    micBtn.classList.remove('is-listening', 'is-processing');
                    micBtn.setAttribute('title', 'Voice input not supported in this browser');
                }
                if (voiceBanner) voiceBanner.style.display = 'none';
                showNotice('Voice microphone input is not supported in this browser. You can type your questions in the chat box!', false);
                setAssistantState('idle');
                break;

            case 'error':
                isListening = false;
                isProcessingSpeech = false;
                if (micBtn) {
                    micBtn.classList.remove('is-listening', 'is-processing');
                    micBtn.setAttribute('title', 'Voice recognition error. Click to retry');
                }
                if (voiceBanner) voiceBanner.style.display = 'none';
                showNotice(message || 'Voice recognition encountered an issue. Click the microphone to try again.', true);
                setAssistantState('idle');
                break;

            case 'idle':
            default:
                isListening = false;
                isProcessingSpeech = false;
                if (micBtn) {
                    micBtn.classList.remove('is-listening', 'is-processing');
                    micBtn.setAttribute('title', 'Speak using your microphone');
                    micBtn.setAttribute('aria-label', 'Speak using your microphone');
                }
                if (voiceBanner) voiceBanner.style.display = 'none';
                if (currentState === 'listening') {
                    setAssistantState('idle');
                }
                break;
        }
    }

    function getListeningPromptText() {
        if (currentLanguage === 'hi') return 'सुन रही हूँ... अब बोलिए';
        if (currentLanguage === 'gu') return 'સાંભળી રહી છું... હવે બોલો';
        return 'Listening to your voice... Speak now';
    }

    async function toggleSpeechRecognition() {
        unlockAudio();

        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (!SpeechRecognition) {
            setMicState('unsupported');
            return;
        }

        if (isListening) {
            stopSpeechRecognition(false);
            return;
        }

        await startSpeechRecognition();
    }

    async function startSpeechRecognition() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (!SpeechRecognition) {
            setMicState('unsupported');
            return;
        }

        // Stop any running speech narration so assistant does not hear herself
        stopSpeech();
        cleanupRecognitionInstance();

        // Request permission if needed
        if (!hasMicrophonePermission && navigator.mediaDevices && typeof navigator.mediaDevices.getUserMedia === 'function') {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                hasMicrophonePermission = true;
                stream.getTracks().forEach(track => track.stop());
            } catch (err) {
                console.warn('Microphone permission error:', err);
                if (err.name === 'NotAllowedError' || err.name === 'PermissionDeniedError') {
                    setMicState('permission-denied');
                    return;
                }
            }
        }

        try {
            recognitionInstance = new SpeechRecognition();
            recognitionInstance.continuous = false;
            recognitionInstance.interimResults = true;
            recognitionInstance.maxAlternatives = 1;

            const localeMap = {
                'en': 'en-IN',
                'hi': 'hi-IN',
                'gu': 'gu-IN'
            };
            recognitionInstance.lang = localeMap[currentLanguage] || 'en-IN';

            hasSubmittedVoice = false;
            accumulatedTranscript = '';

            recognitionInstance.onstart = function () {
                setMicState('listening');
            };

            recognitionInstance.onresult = function (event) {
                let interimText = '';
                let finalText = '';

                for (let i = event.resultIndex; i < event.results.length; ++i) {
                    const result = event.results[i];
                    if (result.isFinal) {
                        finalText += result[0].transcript;
                    } else {
                        interimText += result[0].transcript;
                    }
                }

                const currentRecognized = (finalText || interimText).trim();
                if (currentRecognized) {
                    accumulatedTranscript = currentRecognized;
                    if (textInput) {
                        textInput.value = currentRecognized;
                    }
                    if (voiceStatusText) {
                        voiceStatusText.textContent = 'Heard: "' + currentRecognized + '"';
                    }
                }

                if (finalText.trim() && !hasSubmittedVoice) {
                    accumulatedTranscript = finalText.trim();
                    finalizeAndSubmitVoice(accumulatedTranscript);
                }
            };

            recognitionInstance.onspeechend = function () {
                if (!hasSubmittedVoice && accumulatedTranscript) {
                    setMicState('processing');
                }
            };

            recognitionInstance.onerror = function (event) {
                console.warn('SpeechRecognition error:', event.error);
                cleanupRecognitionInstance();

                const err = event.error;
                if (err === 'not-allowed' || err === 'service-not-allowed') {
                    setMicState('permission-denied');
                } else if (err === 'no-speech') {
                    setMicState('error', 'No voice detected. Please click the microphone and try speaking again.');
                } else if (err === 'audio-capture') {
                    setMicState('error', 'No microphone detected or microphone is currently in use.');
                } else if (err === 'network') {
                    setMicState('error', 'Voice recognition network error. Please check your internet connection or type your question.');
                } else if (err === 'aborted') {
                    setMicState('idle');
                } else {
                    setMicState('error', 'Voice recognition error (' + err + '). Click to retry.');
                }
            };

            recognitionInstance.onend = function () {
                if (!hasSubmittedVoice && accumulatedTranscript.trim()) {
                    finalizeAndSubmitVoice(accumulatedTranscript.trim());
                } else if (!isProcessingSpeech) {
                    setMicState('idle');
                }
                cleanupRecognitionInstance();
            };

            recognitionInstance.start();
        } catch (err) {
            console.error('Failed to start SpeechRecognition:', err);
            cleanupRecognitionInstance();
            setMicState('error', 'Unable to start speech recognition. Please try again or type.');
        }
    }

    function cleanupRecognitionInstance() {
        if (recognitionInstance) {
            try {
                recognitionInstance.onstart = null;
                recognitionInstance.onresult = null;
                recognitionInstance.onerror = null;
                recognitionInstance.onend = null;
                recognitionInstance.abort();
            } catch (_) {}
            recognitionInstance = null;
        }
    }

    /**
     * Intercept direct voice commands locally with zero latency, or dispatch to chatbot.
     */
    function finalizeAndSubmitVoice(text) {
        if (hasSubmittedVoice || !text || !text.trim()) {
            setMicState('idle');
            return;
        }
        hasSubmittedVoice = true;

        const cleanQuery = text.trim();
        setMicState('processing');
        cleanupRecognitionInstance();

        if (textInput) {
            textInput.value = '';
        }

        // Direct Local Voice Commands:
        // 1. "Stop speaking" / "Quiet"
        if (/^(stop speaking|stop talking|stop audio|stop voice|quiet|be quiet|shut up|stop it|stop|ruk jao|chup ho jao)$/i.test(cleanQuery)) {
            setTimeout(function () {
                setMicState('idle');
                interruptSpeech();
                hideTourGuideBeacon();
                appendUserMessage(cleanQuery);
                appendAssistantMessage({
                    message: "I've stopped speaking. What would you like to explore next? You can ask me to navigate or explain any section!",
                    quick_replies: ['Explain That Again 🔁', 'Show Products 🎁', 'Customise a Gift ✨']
                });
            }, 100);
            return;
        }

        // 2. "Explain that again" / "Repeat that"
        if (/^(explain (that|this|it) again|explain this part again|repeat (that|this|it)?|say that again|speak again)$/i.test(cleanQuery)) {
            setTimeout(function () {
                setMicState('idle');
                appendUserMessage(cleanQuery);
                if (lastSpokenText) {
                    voiceEnabled = true;
                    updateVoiceToggleUI();
                    speakText(lastSpokenText, lastSectionTarget?.gesture || 'explaining');
                    if (lastSectionTarget) {
                        focusSectionTarget(lastSectionTarget, lastSpokenText);
                    }
                } else {
                    sendMessage(cleanQuery);
                }
            }, 100);
            return;
        }

        // 3. "Take me back" / "Go back"
        if (/^(take me back|go back|previous page)$/i.test(cleanQuery)) {
            setTimeout(function () {
                setMicState('idle');
                appendUserMessage(cleanQuery);
                if (window.history.length > 1) {
                    appendAssistantMessage({
                        message: "Taking you back to your previous page...",
                        speech_text: "Taking you back now."
                    });
                    setTimeout(() => window.history.back(), 500);
                } else {
                    sendMessage(cleanQuery);
                }
            }, 100);
            return;
        }

        // Submit query to conversational engine
        setTimeout(function () {
            setMicState('idle');
            sendMessage(cleanQuery);
        }, 200);
    }

    function stopSpeechRecognition(isCancel = false) {
        if (isCancel) {
            hasSubmittedVoice = true;
            accumulatedTranscript = '';
            if (textInput) textInput.value = '';
        }
        cleanupRecognitionInstance();
        setMicState('idle');
    }

    /* =========================================================================
       6. Natural Female Voice Speech Synthesis & Synchronized Gestures
       ========================================================================= */
    function getFemaleVoice(targetLocale) {
        if (!voices || voices.length === 0) {
            loadVoices();
        }
        if (!voices || voices.length === 0) return null;

        const langPrefix = targetLocale.slice(0, 2).toLowerCase();
        const femaleKeywords = ['female', 'woman', 'neerja', 'swara', 'dhwani', 'heera', 'zira', 'kalpana', 'veena', 'priya', 'natural'];

        // 1. Exact locale matching female name keywords
        let match = voices.find(v => {
            const vLang = (v.lang || '').replace('_', '-').toLowerCase();
            const vName = (v.name || '').toLowerCase();
            return vLang === targetLocale.toLowerCase() && femaleKeywords.some(kw => vName.includes(kw));
        });
        if (match) return match;

        // 2. Language prefix matching female name keywords
        match = voices.find(v => {
            const vLang = (v.lang || '').replace('_', '-').toLowerCase();
            const vName = (v.name || '').toLowerCase();
            return vLang.startsWith(langPrefix) && femaleKeywords.some(kw => vName.includes(kw));
        });
        if (match) return match;

        // 3. Exact locale match
        match = voices.find(v => (v.lang || '').replace('_', '-').toLowerCase() === targetLocale.toLowerCase());
        if (match) return match;

        // 4. Language prefix match
        match = voices.find(v => (v.lang || '').replace('_', '-').toLowerCase().startsWith(langPrefix));
        if (match) return match;

        // 5. Fallback for Gujarati to Hindi or Indian English
        if (langPrefix === 'gu') {
            const fallback = getFemaleVoice('hi-IN') || getFemaleVoice('en-IN');
            if (fallback) return fallback;
        }

        // 6. Generic female voice fallback
        match = voices.find(v => {
            const vName = (v.name || '').toLowerCase();
            return femaleKeywords.some(kw => vName.includes(kw));
        });
        if (match) return match;

        return voices[0] || null;
    }

    function chunkSpeechText(text) {
        const clean = text
            .replace(/\*\*(.*?)\*\*/g, '$1')
            .replace(/\*(.*?)\*/g, '$1')
            .replace(/https?:\/\/\S+/g, '')
            .replace(/[🍫🎁✨🚚🔍🏷️🔄💬📞💖💍🎉🎂💐•\-\[\]\(\)]/g, ' ')
            .replace(/\s+/g, ' ')
            .trim();

        if (!clean) return [];

        const sentences = clean.split(/(?<=[.!?।])\s+/);
        const chunks = [];

        for (let s of sentences) {
            s = s.trim();
            if (!s) continue;
            if (s.length > 150) {
                const parts = s.split(/(?<=[,;])\s+/);
                for (let p of parts) {
                    p = p.trim();
                    if (p) chunks.push(p);
                }
            } else {
                chunks.push(s);
            }
        }

        return chunks.length > 0 ? chunks : [clean];
    }

    let activeSpeakingGesture = 'speaking';

    function speakText(text, gesture) {
        if (!synth) return;
        if (!voiceEnabled) return;

        lastSpokenText = text;
        activeSpeakingGesture = gesture || 'speaking';
        stopSpeech();

        setAvatarGesture(activeSpeakingGesture, {
            line: text,
            badge: activeSpeakingGesture === 'walking' ? 'On the way' : 'Replying',
        });

        const chunks = chunkSpeechText(text);
        if (chunks.length === 0) return;

        currentSpeechQueue = chunks;
        currentQueueIndex = 0;
        isPaused = false;

        speakNextChunk();
        startKeepAliveTimer();
    }

    function speakNextChunk() {
        if (!synth || !voiceEnabled) {
            stopSpeakingAnimation();
            return;
        }

        if (currentQueueIndex >= currentSpeechQueue.length) {
            stopSpeakingAnimation();
            stopKeepAliveTimer();
            if (currentState === 'speaking') {
                setAssistantState('idle');
            }
            if (textInput && isOpen) {
                textInput.focus();
            }
            return;
        }

        const chunkText = currentSpeechQueue[currentQueueIndex];
        const targetLocale = langLocales[currentLanguage] || 'en-IN';

        try {
            const utterance = new SpeechSynthesisUtterance(chunkText);
            currentUtterance = utterance;

            utterance.lang = targetLocale;
            utterance.rate = 0.98;
            utterance.pitch = 1.05;

            const selectedVoice = getFemaleVoice(targetLocale);
            if (selectedVoice) {
                utterance.voice = selectedVoice;
            }

            // Real audio synchronization: animation starts only when sound physically begins
            utterance.onstart = function () {
                startSpeakingAnimation(activeSpeakingGesture);
            };

            utterance.onend = function () {
                currentQueueIndex++;
                speakNextChunk();
            };

            utterance.onerror = function (event) {
                console.warn('SpeechSynthesis error:', event);
                if (event.error === 'not-allowed') {
                    showAutoplayPrompt();
                    stopSpeakingAnimation();
                    return;
                }
                currentQueueIndex++;
                if (currentQueueIndex < currentSpeechQueue.length) {
                    speakNextChunk();
                } else {
                    stopSpeakingAnimation();
                    stopKeepAliveTimer();
                }
            };

            synth.speak(utterance);
        } catch (err) {
            console.warn('SpeechSynthesis speak failed:', err);
            stopSpeakingAnimation();
            stopKeepAliveTimer();
        }
    }

    function startKeepAliveTimer() {
        stopKeepAliveTimer();
        keepAliveTimer = setInterval(function () {
            if (synth && currentState === 'speaking' && !isPaused && synth.speaking) {
                synth.pause();
                synth.resume();
            }
        }, 10000);
    }

    function stopKeepAliveTimer() {
        if (keepAliveTimer) {
            clearInterval(keepAliveTimer);
            keepAliveTimer = null;
        }
    }

    function toggleSpeechPause() {
        if (!synth || currentState !== 'speaking') return;

        if (isPaused) {
            try {
                synth.resume();
            } catch (_) {}
            isPaused = false;
            updateSpeechPauseUI(false);
            startLipSync();
            if (avatarFace) avatarFace.classList.add('is-speaking');
            if (headerAvatarWrap) headerAvatarWrap.classList.add('is-speaking');
            if (speakingBars) speakingBars.classList.add('is-active');
            if (beaconWave) beaconWave.classList.add('is-active');
            if (speechControlBar) speechControlBar.classList.remove('is-paused');
        } else {
            try {
                synth.pause();
            } catch (_) {}
            isPaused = true;
            updateSpeechPauseUI(true);
            stopLipSync();
            if (avatarFace) avatarFace.classList.remove('is-speaking');
            if (headerAvatarWrap) headerAvatarWrap.classList.remove('is-speaking');
            if (speakingBars) speakingBars.classList.remove('is-active');
            if (beaconWave) beaconWave.classList.remove('is-active');
            if (speechControlBar) speechControlBar.classList.add('is-paused');
        }
    }

    function updateSpeechPauseUI(paused) {
        if (!speechPauseBtn) return;
        const iconPause = speechPauseBtn.querySelector('.rc-ai-icon-pause');
        const iconPlay = speechPauseBtn.querySelector('.rc-ai-icon-play');
        if (paused) {
            if (iconPause) iconPause.style.display = 'none';
            if (iconPlay) iconPlay.style.display = 'block';
            if (speechPauseLabel) speechPauseLabel.textContent = 'Resume';
            speechPauseBtn.setAttribute('title', 'Resume speech narration');
        } else {
            if (iconPause) iconPause.style.display = 'block';
            if (iconPlay) iconPlay.style.display = 'none';
            if (speechPauseLabel) speechPauseLabel.textContent = 'Pause';
            speechPauseBtn.setAttribute('title', 'Pause speech narration');
        }
    }

    function interruptSpeech() {
        stopSpeech();
        if (navigationTimeout) {
            clearTimeout(navigationTimeout);
            navigationTimeout = null;
        }
        setAssistantState('interrupted');
        setTimeout(() => setAssistantState('idle'), 1500);
        showNotice('Speech stopped.', false);
    }

    function stopSpeech() {
        currentSpeechQueue = [];
        currentQueueIndex = 0;
        currentUtterance = null;
        isPaused = false;
        stopKeepAliveTimer();

        if (synth) {
            try {
                synth.cancel();
            } catch (_) {}
        }
        stopSpeakingAnimation();
    }

    function startSpeakingAnimation(gesture) {
        setAssistantState('speaking', { gesture: gesture || 'speaking' });
        startLipSync();

        if (avatarFace) avatarFace.classList.add('is-speaking');
        if (headerAvatarWrap) headerAvatarWrap.classList.add('is-speaking');
        if (avatarBtn) avatarBtn.classList.add('is-speaking');
        if (speakingBars) speakingBars.classList.add('is-active');
        if (beaconWave) beaconWave.classList.add('is-active');

        if (speechControlBar) {
            speechControlBar.style.display = 'flex';
            speechControlBar.classList.remove('is-paused');
        }
        if (speechStatusText) {
            speechStatusText.textContent = getSpeakingStatusText();
        }
        updateSpeechPauseUI(false);
    }

    function stopSpeakingAnimation() {
        stopLipSync();
        if (avatarFace) avatarFace.classList.remove('is-speaking');
        if (headerAvatarWrap) headerAvatarWrap.classList.remove('is-speaking');
        if (avatarBtn) avatarBtn.classList.remove('is-speaking');
        if (speakingBars) speakingBars.classList.remove('is-active');
        if (beaconWave) beaconWave.classList.remove('is-active');

        if (speechControlBar) {
            speechControlBar.style.display = 'none';
            speechControlBar.classList.remove('is-paused');
        }
    }

    function getSpeakingStatusText() {
        if (currentLanguage === 'hi') return 'रुचि AI बोल रही हैं...';
        if (currentLanguage === 'gu') return 'રુચિ AI બોલી રહી છે...';
        return 'Ruchi AI is speaking...';
    }

    function isContactPagePath() {
        const path = window.location.pathname.replace(/\/$/, '') || '/';
        return path === '/contact';
    }

    function readContactFormFieldsFromDom() {
        return {
            name: document.getElementById('contact_name')?.value?.trim() || '',
            email: document.getElementById('contact_email')?.value?.trim() || '',
            phone: document.getElementById('contact_phone')?.value?.trim() || '',
            subject: document.getElementById('contact_subject')?.value?.trim() || '',
            message: document.getElementById('contact_message')?.value?.trim() || '',
            phone_skipped: false
        };
    }

    function getContactFormPayload() {
        if (!isContactPagePath()) {
            return null;
        }

        const domFields = readContactFormFieldsFromDom();
        if (!contactFormState) {
            return { step: null, fields: domFields };
        }

        return {
            step: contactFormState.step ?? null,
            fields: {
                ...domFields,
                ...(contactFormState.fields || {}),
                phone_skipped: Boolean(contactFormState.fields?.phone_skipped)
            }
        };
    }

    function applyCustomisationDetailsPrefill(text) {
        if (!text || typeof text !== 'string') {
            return;
        }

        const textarea = document.getElementById('customisation-details');
        if (!textarea) {
            return;
        }

        textarea.value = text.trim();
        textarea.dispatchEvent(new Event('input', { bubbles: true }));
        textarea.scrollIntoView({ behavior: 'smooth', block: 'center' });

        const formCard = document.querySelector('.rc-custom-form-card');
        if (formCard) {
            formCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    function applyContactFormPrefill(fields) {
        if (!fields || typeof fields !== 'object') {
            return;
        }

        const map = {
            name: 'contact_name',
            email: 'contact_email',
            phone: 'contact_phone',
            subject: 'contact_subject',
            message: 'contact_message'
        };

        Object.entries(map).forEach(([key, id]) => {
            const el = document.getElementById(id);
            if (!el || fields[key] === undefined || fields[key] === null) {
                return;
            }
            el.value = String(fields[key]);
            el.dispatchEvent(new Event('input', { bubbles: true }));
            el.classList.remove('is-invalid');
        });

        const formCard = document.querySelector('.rc-contact-form-card');
        if (formCard) {
            formCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    function syncContactFormStateFromResponse(data) {
        if (!data || !data.contact_form) {
            return;
        }

        if (data.contact_form.step === 'complete' && data.contact_form.fields) {
            applyContactFormPrefill(data.contact_form.fields);
            contactFormState = null;
            return;
        }

        if (data.contact_form.step === null || data.contact_form.step === undefined) {
            contactFormState = null;
            return;
        }

        contactFormState = {
            step: data.contact_form.step,
            fields: data.contact_form.fields || {}
        };
    }

    /* =========================================================================
       7. Conversational Navigation & API Communication
       ========================================================================= */
    async function sendMessage(text) {
        appendUserMessage(text);
        setAssistantState('thinking');

        conversationHistory.push({ role: 'user', content: text });

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        try {
            const res = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    message: text,
                    language: currentLanguage,
                    current_page: window.location.pathname,
                    history: conversationHistory.slice(-6),
                    contact_form: getContactFormPayload()
                })
            });

            hideTypingIndicator();

            if (!res.ok) {
                throw new Error('Server returned ' + res.status);
            }

            const json = await res.json();
            const data = json.data || {};

            conversationHistory.push({ role: 'assistant', content: data.message || '' });

            // 1. Render message in chat
            appendAssistantMessage(data);

            syncContactFormStateFromResponse(data);

            if (data.action === 'prefill_contact_form' && data.contact_form?.fields) {
                applyContactFormPrefill(data.contact_form.fields);
            }

            if (data.customisation_details) {
                applyCustomisationDetailsPrefill(data.customisation_details);
            }

            // 2. Direct action handling (e.g. stop speech)
            if (data.action === 'stop_speech') {
                interruptSpeech();
                hideTourGuideBeacon();
                return;
            }

            // 3. Section targeting on current page
            if (data.section_target) {
                focusSectionTargetForResponse(
                    data.section_target,
                    data.message || data.speech_text || '',
                    data.action || null
                );
            }

            // 4. Check if website navigation was triggered
            if (data.navigation && data.navigation.navigate && data.navigation.url) {
                handleNavigationTransition(data);
                return;
            }

            // 5. In-place speech explanation
            const spokenText = data.speech_text || data.message || '';
            const gesture = data.avatar_gesture || data.section_target?.gesture || 'speaking';

            if (voiceEnabled && spokenText) {
                speakText(spokenText, gesture);
            } else {
                setAvatarGesture(gesture);
                setTimeout(() => setAssistantState('idle'), 2000);
            }

        } catch (err) {
            console.error('Chat API Error:', err);
            hideTypingIndicator();

            const fallbackData = {
                message: "I had a momentary connection hiccup! You can ask again, or tap below to chat directly with our team on WhatsApp.",
                speech_text: "I had a momentary connection issue. You can ask again or chat with our team on WhatsApp.",
                action: 'whatsapp',
                action_url: 'https://wa.me/917490828282?text=' + encodeURIComponent('Hi Ruchi Chocolates, I need help with: ' + text),
                action_label: 'Chat on WhatsApp (+91 7490828282)'
            };
            appendAssistantMessage(fallbackData);
            setAssistantState('idle');

            if (voiceEnabled) {
                speakText(fallbackData.speech_text);
            }
        }
    }

    /**
     * Handle navigation transitions: speaks initial acknowledgment, saves pending explanation,
     * changes avatar to walking gesture, and navigates.
     */
    function handleNavigationTransition(data) {
        stopSpeechRecognition(true);
        const nav = data.navigation;

        // Check if destination is already current page
        const currentPath = window.location.pathname.replace(/\/$/, '') || '/';
        const targetPath = (new URL(nav.url, window.location.origin)).pathname.replace(/\/$/, '') || '/';

        if (currentPath === targetPath) {
            // Already on target page: scroll and explain directly without reloading!
            const sectionTarget = nav.section_target || (nav.explanation && nav.explanation.section_target);
            if (sectionTarget) {
                focusSectionTargetForResponse(
                    sectionTarget,
                    nav.explanation?.message || data.message || '',
                    nav.explanation?.action || data.action || null
                );
            }
            const speech = nav.explanation?.speech_text || data.speech_text || data.message;
            if (voiceEnabled && speech) {
                speakText(speech, sectionTarget?.gesture || 'explaining');
            }
            return;
        }

        // Different page: show walking animation and navigate
        setAssistantState('navigating', {
            page_name: nav.page_name,
            url: nav.url
        });

        // Persist session across route change
        const stateToSave = {
            isOpen: true,
            voiceEnabled: voiceEnabled,
            currentLanguage: currentLanguage,
            conversationHistory: conversationHistory,
            section_target: nav.section_target || (nav.explanation && nav.explanation.section_target) || null,
            pendingExplanation: nav.explanation || null,
            destinationUrl: nav.url,
            destinationPageName: nav.page_name || ''
        };
        sessionStorage.setItem('rc_ai_nav_state', JSON.stringify(stateToSave));

        // Speak opening acknowledgment
        const ackSpeech = nav.pre_speech || data.speech_text || data.message;
        if (voiceEnabled && ackSpeech) {
            speakText(ackSpeech, 'walking');
        }

        navigationTimeout = setTimeout(function () {
            window.location.href = nav.url;
        }, 1700);
    }

    /* =========================================================================
       8. Message UI Rendering
       ========================================================================= */
    function appendUserMessage(text) {
        const msgEl = document.createElement('div');
        msgEl.className = 'rc-ai-message rc-ai-message--user';
        msgEl.innerHTML = `
            <div class="rc-ai-msg-content">
                <div class="rc-ai-bubble">${escapeHtml(text)}</div>
                <div class="rc-ai-msg-time">${getCurrentTime()}</div>
            </div>
        `;
        messagesBody.appendChild(msgEl);
        scrollToBottom();
    }

    function appendAssistantMessage(data) {
        const msgEl = document.createElement('div');
        msgEl.className = 'rc-ai-message rc-ai-message--assistant';

        const assetBase = window.location.origin;
        const avatarUrl = assetBase + '/images/ruchi-chef-avatar-head.png';

        const formattedHtml = formatMarkdown(data.message || '');

        let productsHtml = '';
        if (Array.isArray(data.products) && data.products.length > 0) {
            productsHtml = `<div class="rc-ai-products-grid">` + data.products.map(p => `
                <div class="rc-ai-product-card" data-id="${escapeHtml(p.id)}">
                    <div class="rc-ai-pcard-media">
                        <img src="${escapeHtml(p.image)}" alt="${escapeHtml(p.title)}" class="rc-ai-pcard-img" loading="lazy">
                    </div>
                    <div class="rc-ai-pcard-body">
                        <h4 class="rc-ai-pcard-title" title="${escapeHtml(p.title)}">${escapeHtml(p.title)}</h4>
                        <span class="rc-ai-pcard-price">₹${escapeHtml(p.price)}</span>
                        <button type="button" class="rc-ai-pcard-btn" data-product-id="${escapeHtml(p.id)}">
                            Quick View
                        </button>
                    </div>
                </div>
            `).join('') + `</div>`;
        }

        let actionHtml = '';
        if (data.action_url && data.action_label) {
            const isWa = data.action === 'whatsapp' || data.action_url.includes('wa.me');
            const targetAttr = isWa ? 'target="_blank" rel="noopener noreferrer"' : '';
            const btnClass = isWa ? 'rc-ai-action-btn rc-ai-action-btn--whatsapp' : 'rc-ai-action-btn';
            const iconSvg = isWa 
                ? `<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm5.79 14.07c-.24.67-1.39 1.28-1.92 1.36-.5.08-1.14.12-3.37-.8-2.67-1.11-4.38-3.83-4.51-4.01-.13-.18-1.07-1.42-1.07-2.71 0-1.29.68-1.92.92-2.18.24-.26.53-.33.71-.33.18 0 .36.002.51.01.16.01.38-.06.59.45.24.57.81 1.97.88 2.11.07.15.12.32.02.51-.1.2-.15.32-.3.49-.15.17-.31.39-.45.52-.15.15-.31.31-.13.62.18.31.8 1.31 1.71 2.12 1.17 1.04 2.16 1.36 2.47 1.51.31.15.49.13.67-.08.18-.21.78-.91.99-1.22.21-.31.42-.26.71-.15.29.11 1.83.86 2.15 1.02.32.16.53.24.61.37.08.14.08.79-.16 1.46z"/></svg>`
                : `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>`;

            actionHtml = `
                <div class="rc-ai-action-btn-wrap">
                    <a href="${escapeHtml(data.action_url)}" class="${btnClass}" ${targetAttr}>
                        ${iconSvg}
                        <span>${escapeHtml(data.action_label)}</span>
                    </a>
                </div>
            `;
        }

        let chipsHtml = '';
        if (Array.isArray(data.quick_replies) && data.quick_replies.length > 0) {
            chipsHtml = `
                <div class="rc-ai-chips-list" style="margin-top: 10px;">
                    ${data.quick_replies.map(chip => `<button type="button" class="rc-ai-chip" data-query="${escapeHtml(chip)}"><span>${escapeHtml(chip)}</span></button>`).join('')}
                </div>
            `;
        }

        const speechDataAttr = escapeHtml(data.speech_text || data.message || '');

        msgEl.innerHTML = `
            <div class="rc-ai-msg-avatar">
                <img src="${avatarUrl}" alt="Ruchi AI">
            </div>
            <div class="rc-ai-msg-content">
                <div class="rc-ai-bubble">
                    ${formattedHtml}
                    ${productsHtml}
                    ${actionHtml}
                    ${chipsHtml}
                </div>
                <div style="display:flex; align-items:center; justify-content:space-between; margin-top: 4px;">
                    <span class="rc-ai-msg-time">${getCurrentTime()}</span>
                    <button type="button" class="rc-ai-replay-btn" data-speech="${speechDataAttr}" title="Replay voice audio">
                        🔊 Replay Voice
                    </button>
                </div>
            </div>
        `;

        messagesBody.appendChild(msgEl);
        scrollToBottom();
    }

    function showTypingIndicator() {
        if (!typingIndicator) return;
        messagesBody.appendChild(typingIndicator);
        typingIndicator.style.display = 'flex';
        scrollToBottom();
    }

    function hideTypingIndicator() {
        if (!typingIndicator) return;
        typingIndicator.style.display = 'none';
    }

    function scrollToBottom() {
        if (messagesBody) {
            setTimeout(() => {
                messagesBody.scrollTop = messagesBody.scrollHeight;
            }, 60);
        }
    }

    /* =========================================================================
       9. Utility Helpers
       ========================================================================= */
    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function formatMarkdown(text) {
        if (!text) return '';
        let escaped = escapeHtml(text);

        escaped = escaped.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        escaped = escaped.replace(/\*(.*?)\*/g, '<em>$1</em>');
        escaped = escaped.replace(/(?:^|\n)[•\-]\s+(.*?)(?=\n|$)/g, '<div style="padding-left:14px; position:relative; margin: 3px 0;"><span style="position:absolute; left:2px; color:#8c3a2c;">•</span>$1</div>');
        escaped = escaped.replace(/\n\n/g, '<br><br>');
        escaped = escaped.replace(/\n/g, '<br>');

        return escaped;
    }

    function getCurrentTime() {
        const now = new Date();
        return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    // Launch assistant on DOM Ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Expose programmatic trigger
    window.rcOpenAiAssistant = function (optionalQuery) {
        unlockAudio();
        openPanel();
        if (optionalQuery) {
            sendMessage(optionalQuery);
        }
    };
    window.rcCloseAiAssistant = closePanel;
})();
