{{-- =========================================================================
     Ruchi Chocolates — Interactive Animated SVG Avatar Character Rig
     Features:
     - Idle breathing and natural eyelid blinking
     - Dynamic eyebrow expressions (listening, thinking, smiling)
     - Multi-viseme mouth morphing for lip-sync with speech synthesis
     - Articulated arms with gestures: Idle, Welcoming/Wave, Listening,
       Thinking, Walking/Guiding, Pointing (Left/Right/Down), and Explaining
     - Visual gesture FX: Listening sound waves, thought sparkles, pointing cue
     ========================================================================= --}}
@php
    $rigId = $id ?? 'rcAiRig';
    $rigClass = $class ?? '';
    $rigSize = $size ?? '100%';
@endphp

<div class="rc-ai-character-container {{ $rigClass }}" id="{{ $rigId }}" data-character-state="idle" aria-hidden="true">
    <svg 
        class="rc-ai-character-svg" 
        viewBox="0 0 140 160" 
        width="{{ $rigSize }}" 
        height="{{ $rigSize }}" 
        xmlns="http://www.w3.org/2000/svg"
    >
        <defs>
            <!-- Skin Gradient -->
            <radialGradient id="{{ $rigId }}-skin" cx="50%" cy="40%" r="60%">
                <stop offset="0%" stop-color="#FFF2EC"/>
                <stop offset="70%" stop-color="#FCDCD1"/>
                <stop offset="100%" stop-color="#F6C5B5"/>
            </radialGradient>

            <!-- Hair Gradient (Dark Rich Chocolate) -->
            <linearGradient id="{{ $rigId }}-hair" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#4A2016"/>
                <stop offset="50%" stop-color="#2D110A"/>
                <stop offset="100%" stop-color="#1A0A06"/>
            </linearGradient>

            <!-- Uniform Gradient (Warm Luxury Chocolate Brown) -->
            <linearGradient id="{{ $rigId }}-uniform" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" stop-color="#5A2C1D"/>
                <stop offset="60%" stop-color="#3E1A0F"/>
                <stop offset="100%" stop-color="#280F08"/>
            </linearGradient>

            <!-- Gold Accents Gradient -->
            <linearGradient id="{{ $rigId }}-gold" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#FCE082"/>
                <stop offset="50%" stop-color="#D4AF37"/>
                <stop offset="100%" stop-color="#A67C1E"/>
            </linearGradient>

            <!-- Rosy Blush Filter -->
            <radialGradient id="{{ $rigId }}-blush" cx="50%" cy="50%" r="50%">
                <stop offset="0%" stop-color="#F7A1B5" stop-opacity="0.6"/>
                <stop offset="100%" stop-color="#F7A1B5" stop-opacity="0"/>
            </radialGradient>
        </defs>

        <!-- 1. GESTURE EFFECTS BACKGROUND (Sound waves, thoughts, walking stars) -->
        <g class="rc-rig-fx-layer">
            <!-- Listening Waves (Near Right Ear) -->
            <g class="rc-fx-listen" opacity="0">
                <path d="M 108 55 A 16 16 0 0 1 108 75" fill="none" stroke="#D4AF37" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M 115 50 A 24 24 0 0 1 115 80" fill="none" stroke="#D4AF37" stroke-width="2" stroke-linecap="round"/>
                <path d="M 122 45 A 32 32 0 0 1 122 85" fill="none" stroke="#D4AF37" stroke-width="1.5" stroke-linecap="round"/>
            </g>

            <!-- Thinking Sparkles (Above Head) -->
            <g class="rc-fx-think" opacity="0">
                <circle cx="85" cy="22" r="2.5" fill="#D4AF37"/>
                <circle cx="95" cy="14" r="4" fill="#D4AF37"/>
                <circle cx="108" cy="8" r="6" fill="#FCE082"/>
                <path d="M 108 2 L 110 6 L 114 8 L 110 10 L 108 14 L 106 10 L 102 8 L 106 6 Z" fill="#FFF"/>
            </g>

            <!-- Walking / Travelling Trail Sparkles -->
            <g class="rc-fx-walk" opacity="0">
                <circle cx="20" cy="140" r="3" fill="#D4AF37" opacity="0.7"/>
                <circle cx="15" cy="148" r="2" fill="#FCE082" opacity="0.6"/>
                <circle cx="125" cy="140" r="3" fill="#D4AF37" opacity="0.7"/>
                <circle cx="130" cy="148" r="2" fill="#FCE082" opacity="0.6"/>
            </g>

            <!-- Pointing Guide Target Beam Accent -->
            <g class="rc-fx-point" opacity="0">
                <line x1="128" y1="92" x2="140" y2="86" stroke="#D4AF37" stroke-width="2.5" stroke-linecap="round" stroke-dasharray="3,3"/>
                <circle cx="138" cy="87" r="3" fill="#D4AF37"/>
            </g>
        </g>

        <!-- 2. CHARACTER BODY & TORSO (Chocolatier Uniform) -->
        <g class="rc-rig-body-layer">
            <!-- Torso / Chef Jacket -->
            <path d="M 38 122 Q 36 155 30 160 L 110 160 Q 104 155 102 122 Q 88 125 70 125 Q 52 125 38 122 Z" fill="url(#{{ $rigId }}-uniform)"/>
            
            <!-- White/Cream Chef Apron Panel -->
            <path d="M 48 124 L 54 160 L 86 160 L 92 124 Q 70 126 48 124 Z" fill="#FFFDF9" stroke="#E6D7CE" stroke-width="1"/>
            
            <!-- Apron Gold Neck Strap & Trim -->
            <path d="M 48 124 Q 70 135 92 124" fill="none" stroke="url(#{{ $rigId }}-gold)" stroke-width="2.5"/>
            <line x1="70" y1="130" x2="70" y2="160" stroke="#E6D7CE" stroke-width="1" stroke-dasharray="3,3"/>
            
            <!-- Gold Chef Badge / Insignia -->
            <circle cx="62" cy="138" r="3.5" fill="url(#{{ $rigId }}-gold)"/>
            <circle cx="78" cy="138" r="3.5" fill="url(#{{ $rigId }}-gold)"/>
            <path d="M 68 144 Q 70 142 72 144 L 72 152 Q 70 154 68 152 Z" fill="#8B4513"/>
            
            <!-- Delicate Neck -->
            <path d="M 60 102 L 60 124 Q 70 126 80 124 L 80 102 Z" fill="url(#{{ $rigId }}-skin)"/>
        </g>

        <!-- 3. ARTICULATED LEFT ARM (Viewer's Left) -->
        <g class="rc-rig-left-arm">
            <!-- Default / Rest Arm -->
            <g class="rc-arm-left-rest">
                <path d="M 38 124 Q 28 136 28 152" fill="none" stroke="url(#{{ $rigId }}-uniform)" stroke-width="12" stroke-linecap="round"/>
                <!-- Left Hand -->
                <circle cx="28" cy="154" r="6" fill="url(#{{ $rigId }}-skin)"/>
            </g>
            <!-- Left Arm Explaining (Open Palm Raised) -->
            <g class="rc-arm-left-explain" opacity="0">
                <path d="M 38 124 Q 20 126 16 112" fill="none" stroke="url(#{{ $rigId }}-uniform)" stroke-width="12" stroke-linecap="round"/>
                <circle cx="14" cy="108" r="7" fill="url(#{{ $rigId }}-skin)"/>
                <path d="M 12 105 Q 16 100 20 108" fill="none" stroke="#E2A695" stroke-width="1.5"/>
            </g>
        </g>

        <!-- 4. HEAD, HAIR & FACIAL FEATURES -->
        <g class="rc-rig-head-layer">
            <!-- Back Hair Mass -->
            <path d="M 32 60 Q 24 95 32 118 Q 42 124 50 115 Q 40 85 46 60 Z" fill="url(#{{ $rigId }}-hair)"/>
            <path d="M 108 60 Q 116 95 108 118 Q 98 124 90 115 Q 100 85 94 60 Z" fill="url(#{{ $rigId }}-hair)"/>

            <!-- Face Oval -->
            <ellipse cx="70" cy="78" rx="34" ry="38" fill="url(#{{ $rigId }}-skin)"/>

            <!-- Left Ear & Earring -->
            <ellipse cx="36" cy="80" rx="4.5" ry="7" fill="url(#{{ $rigId }}-skin)"/>
            <circle cx="36" cy="85" r="2" fill="url(#{{ $rigId }}-gold)"/>

            <!-- Right Ear & Earring -->
            <ellipse cx="104" cy="80" rx="4.5" ry="7" fill="url(#{{ $rigId }}-skin)"/>
            <circle cx="104" cy="85" r="2" fill="url(#{{ $rigId }}-gold)"/>

            <!-- Rosy Cheeks -->
            <circle cx="50" cy="88" r="7" fill="url(#{{ $rigId }}-blush)"/>
            <circle cx="90" cy="88" r="7" fill="url(#{{ $rigId }}-blush)"/>

            <!-- Front Hair & Bangs -->
            <path d="M 36 62 Q 50 36 70 38 Q 90 36 104 62 Q 95 50 82 52 Q 68 44 56 52 Q 44 48 36 62 Z" fill="url(#{{ $rigId }}-hair)"/>
            <path d="M 36 62 Q 42 82 48 88 Q 44 75 42 66 Z" fill="url(#{{ $rigId }}-hair)"/>
            <path d="M 104 62 Q 98 82 92 88 Q 96 75 98 66 Z" fill="url(#{{ $rigId }}-hair)"/>

            <!-- Chocolatier Headband / Mini Toque -->
            <path d="M 46 42 Q 70 34 94 42" fill="none" stroke="url(#{{ $rigId }}-gold)" stroke-width="4.5" stroke-linecap="round"/>
            <path d="M 52 40 Q 56 22 70 20 Q 84 22 88 40 Z" fill="#FFFDF9" stroke="#E6D7CE" stroke-width="1.2"/>
            <circle cx="70" cy="22" r="3" fill="url(#{{ $rigId }}-gold)"/>

            <!-- Delicate Nose -->
            <path d="M 69 77 Q 70 82 72 82" fill="none" stroke="#E2A695" stroke-width="1.6" stroke-linecap="round"/>

            <!-- 4A. ANIMATED EYEBROWS -->
            <g class="rc-rig-eyebrows">
                <!-- Left Eyebrow -->
                <path class="rc-rig-brow rc-rig-brow--left" d="M 48 64 Q 56 61 62 65" fill="none" stroke="#3A170F" stroke-width="2.2" stroke-linecap="round"/>
                <!-- Right Eyebrow -->
                <path class="rc-rig-brow rc-rig-brow--right" d="M 78 65 Q 84 61 92 64" fill="none" stroke="#3A170F" stroke-width="2.2" stroke-linecap="round"/>
            </g>

            <!-- 4B. EYES & ANIMATED BLINKING EYELIDS -->
            <g class="rc-rig-eyes-layer">
                <!-- Left Eye -->
                <g class="rc-rig-eye rc-rig-eye--left">
                    <ellipse cx="55" cy="72" rx="6.5" ry="7.5" fill="#FFF"/>
                    <!-- Pupil / Iris (Warm Chocolate Brown) -->
                    <ellipse class="rc-rig-pupil" cx="55.5" cy="72" rx="4.5" ry="5.5" fill="#4A2016"/>
                    <circle cx="56.5" cy="70" r="1.8" fill="#FFF"/>
                    <circle cx="54" cy="74.5" r="0.9" fill="#FFF"/>
                    <!-- Upper Eyelashes -->
                    <path d="M 48 70 Q 55 64 62 70" fill="none" stroke="#2D110A" stroke-width="2" stroke-linecap="round"/>
                    <!-- Blinking Eyelid Cover -->
                    <path class="rc-rig-eyelid rc-rig-eyelid--left" d="M 48 70 Q 55 64 62 70 L 62 70 Q 55 70 48 70 Z" fill="url(#{{ $rigId }}-skin)"/>
                </g>

                <!-- Right Eye -->
                <g class="rc-rig-eye rc-rig-eye--right">
                    <ellipse cx="85" cy="72" rx="6.5" ry="7.5" fill="#FFF"/>
                    <!-- Pupil / Iris -->
                    <ellipse class="rc-rig-pupil" cx="84.5" cy="72" rx="4.5" ry="5.5" fill="#4A2016"/>
                    <circle cx="85.5" cy="70" r="1.8" fill="#FFF"/>
                    <circle cx="83" cy="74.5" r="0.9" fill="#FFF"/>
                    <!-- Upper Eyelashes -->
                    <path d="M 78 70 Q 85 64 92 70" fill="none" stroke="#2D110A" stroke-width="2" stroke-linecap="round"/>
                    <!-- Blinking Eyelid Cover -->
                    <path class="rc-rig-eyelid rc-rig-eyelid--right" d="M 78 70 Q 85 64 92 70 L 92 70 Q 85 70 78 70 Z" fill="url(#{{ $rigId }}-skin)"/>
                </g>
            </g>

            <!-- 4C. MORPHING VISEME MOUTH (Lip-Sync Engine) -->
            <g class="rc-rig-mouth-layer" id="{{ $rigId }}-mouth">
                <!-- Viseme: Rest / Gentle Smile -->
                <path class="rc-viseme rc-viseme--rest" d="M 62 93 Q 70 98 78 93" fill="none" stroke="#C54E57" stroke-width="2.6" stroke-linecap="round"/>
                
                <!-- Viseme: Open (Talking "ah/eh") -->
                <path class="rc-viseme rc-viseme--open" d="M 61 91 Q 70 102 79 91 Q 70 93 61 91 Z" fill="#992B35" stroke="#C54E57" stroke-width="1.5" opacity="0"/>
                
                <!-- Viseme: Round (Talking "oh/oo") -->
                <ellipse class="rc-viseme rc-viseme--round" cx="70" cy="93" rx="4.5" ry="5.5" fill="#992B35" stroke="#C54E57" stroke-width="1.5" opacity="0"/>
                
                <!-- Viseme: Wide (Talking "ee/smile") -->
                <path class="rc-viseme rc-viseme--wide" d="M 59 91 Q 70 100 81 91 Q 70 94 59 91 Z" fill="#C54E57" stroke="#C54E57" stroke-width="1.2" opacity="0"/>
            </g>
        </g>

        <!-- 5. ARTICULATED RIGHT ARM (Viewer's Right — Multi-Gesture System) -->
        <g class="rc-rig-right-arm">
            <!-- 5A. Rest Pose (Arm along side) -->
            <g class="rc-arm-pose rc-arm-pose--idle">
                <path d="M 102 124 Q 112 136 112 152" fill="none" stroke="url(#{{ $rigId }}-uniform)" stroke-width="12" stroke-linecap="round"/>
                <circle cx="112" cy="154" r="6" fill="url(#{{ $rigId }}-skin)"/>
            </g>

            <!-- 5B. Welcoming / Wave Pose (Hand raised, friendly greeting) -->
            <g class="rc-arm-pose rc-arm-pose--wave" opacity="0">
                <path d="M 102 124 Q 120 110 122 84" fill="none" stroke="url(#{{ $rigId }}-uniform)" stroke-width="11" stroke-linecap="round"/>
                <!-- Waving Hand -->
                <circle cx="122" cy="78" r="7" fill="url(#{{ $rigId }}-skin)"/>
                <path d="M 120 74 Q 126 68 128 75" fill="none" stroke="#E2A695" stroke-width="1.5"/>
            </g>

            <!-- 5C. Listening Pose (Hand cupped to ear, attentive listening) -->
            <g class="rc-arm-pose rc-arm-pose--listen" opacity="0">
                <path d="M 102 124 Q 122 110 110 76" fill="none" stroke="url(#{{ $rigId }}-uniform)" stroke-width="11" stroke-linecap="round"/>
                <!-- Cupped Hand at Ear -->
                <path d="M 108 72 Q 116 70 114 82 Q 106 82 108 72 Z" fill="url(#{{ $rigId }}-skin)" stroke="#E2A695" stroke-width="1"/>
            </g>

            <!-- 5D. Thinking Pose (Hand touching chin, thoughtful pose) -->
            <g class="rc-arm-pose rc-arm-pose--think" opacity="0">
                <path d="M 102 124 Q 110 120 86 100" fill="none" stroke="url(#{{ $rigId }}-uniform)" stroke-width="11" stroke-linecap="round"/>
                <!-- Hand Touching Chin -->
                <circle cx="84" cy="98" r="6" fill="url(#{{ $rigId }}-skin)"/>
                <line x1="84" y1="98" x2="80" y2="92" stroke="url(#{{ $rigId }}-skin)" stroke-width="3" stroke-linecap="round"/>
            </g>

            <!-- 5E. Pointing Pose (Right Arm Extended Directly Pointing Toward Content) -->
            <g class="rc-arm-pose rc-arm-pose--point-right" opacity="0">
                <path d="M 102 124 Q 116 112 130 94" fill="none" stroke="url(#{{ $rigId }}-uniform)" stroke-width="11" stroke-linecap="round"/>
                <!-- Hand with Pointing Index Finger -->
                <circle cx="130" cy="92" r="5.5" fill="url(#{{ $rigId }}-skin)"/>
                <line x1="130" y1="92" x2="140" y2="86" stroke="url(#{{ $rigId }}-skin)" stroke-width="3.5" stroke-linecap="round"/>
            </g>

            <!-- 5F. Pointing Down / Beside Pose -->
            <g class="rc-arm-pose rc-arm-pose--point-down" opacity="0">
                <path d="M 102 124 Q 122 132 128 148" fill="none" stroke="url(#{{ $rigId }}-uniform)" stroke-width="11" stroke-linecap="round"/>
                <circle cx="128" cy="148" r="5.5" fill="url(#{{ $rigId }}-skin)"/>
                <line x1="128" y1="148" x2="132" y2="158" stroke="url(#{{ $rigId }}-skin)" stroke-width="3.5" stroke-linecap="round"/>
            </g>

            <!-- 5G. Explaining Pose (Palms Outward) -->
            <g class="rc-arm-pose rc-arm-pose--explain" opacity="0">
                <path d="M 102 124 Q 120 126 124 112" fill="none" stroke="url(#{{ $rigId }}-uniform)" stroke-width="11" stroke-linecap="round"/>
                <circle cx="126" cy="108" r="7" fill="url(#{{ $rigId }}-skin)"/>
                <path d="M 124 105 Q 128 100 132 108" fill="none" stroke="#E2A695" stroke-width="1.5"/>
            </g>
        </g>
    </svg>
</div>
