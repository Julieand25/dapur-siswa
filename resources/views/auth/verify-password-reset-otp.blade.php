<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sahkan OTP – Dapur Siswa MADANI UPSI</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9fafb;
            padding: 24px;
        }

        .container {
            width: 100%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
        }

        .logo-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            text-align: center;
        }

        .logo-wrap img {
            width: 180px;
            max-width: 100%;
            object-fit: contain;
        }

        .card {
            width: 100%;
            background: #fff;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.04);
        }

        .card h2 {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
        }

        .card p {
            font-size: 13.5px;
            color: #4b5563;
            line-height: 1.6;
        }

        .card .email-highlight {
            font-weight: 600;
            color: #111827;
        }

        .status-msg {
            font-size: 13px;
            color: #15803d;
            background: #dcfce7;
            border-radius: 6px;
            padding: 10px 14px;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .error-msg {
            font-size: 12px;
            color: #dc2626;
            margin-top: 6px;
        }

        .otp-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 20px 0 8px;
        }

        .otp-input {
            width: 56px;
            height: 64px;
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            color: #111827;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.15s;
        }

        .otp-input:focus {
            border-color: #1a56db;
            box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.1);
        }

        .otp-input.has-error {
            border-color: #dc2626;
        }

        .actions {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            gap: 12px;
        }

        .btn {
            display: inline-block;
            padding: 12px 22px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: filter 0.15s, transform 0.1s;
            border: none;
        }

        .btn:hover  { filter: brightness(1.08); transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }

        .btn-primary { background: #1a56db; color: #fff; }
        .btn-primary:disabled { background: #93b4f5; cursor: not-allowed; }

        .btn-resend {
            background: none;
            color: #1a56db;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            padding: 8px 4px;
        }

        .btn-resend:hover { color: #1e40af; }
        .btn-resend:disabled { color: #9ca3af; cursor: not-allowed; }

        .back-link {
            background: none;
            color: #6b7280;
            font-size: 13px;
            font-weight: 500;
            text-decoration: underline;
            cursor: pointer;
            border: none;
            padding: 8px 4px;
        }

        .back-link:hover { color: #374151; }

        @media (max-width: 480px) {
            .card { padding: 24px 20px; }
            .otp-input { width: 48px; height: 56px; font-size: 22px; }
            .otp-group { gap: 6px; }
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="logo-wrap">
            <img src="{{ asset('images/dapur-siswa-logo.png') }}" alt="Dapur Siswa MADANI UPSI">
        </div>

        <div class="card">
            <h2>Sahkan Kod OTP</h2>
            <p>
                Sila masukkan kod OTP 4 angka yang telah dihantar ke
                <span class="email-highlight">{{ $email }}</span>
            </p>

            @if (session('status') == 'otp-sent')
                <div class="status-msg">
                    Kod OTP baharu telah dihantar ke emel anda.
                </div>
            @endif

            <form method="POST" action="{{ route('password.reset.otp.verify') }}">
                @csrf

                <div class="otp-group">
                    <input
                        type="text"
                        name="otp[]"
                        maxlength="1"
                        inputmode="numeric"
                        pattern="[0-9]"
                        class="otp-input {{ $errors->any() ? 'has-error' : '' }}"
                        id="otp-1"
                        autofocus
                        autocomplete="one-time-code"
                        required
                    >
                    <input
                        type="text"
                        name="otp[]"
                        maxlength="1"
                        inputmode="numeric"
                        pattern="[0-9]"
                        class="otp-input {{ $errors->any() ? 'has-error' : '' }}"
                        id="otp-2"
                        required
                    >
                    <input
                        type="text"
                        name="otp[]"
                        maxlength="1"
                        inputmode="numeric"
                        pattern="[0-9]"
                        class="otp-input {{ $errors->any() ? 'has-error' : '' }}"
                        id="otp-3"
                        required
                    >
                    <input
                        type="text"
                        name="otp[]"
                        maxlength="1"
                        inputmode="numeric"
                        pattern="[0-9]"
                        class="otp-input {{ $errors->any() ? 'has-error' : '' }}"
                        id="otp-4"
                        required
                    >
                </div>

                @if ($errors->any())
                    <div class="error-msg">{{ $errors->first() }}</div>
                @endif

                <div class="actions">
                    <button type="submit" form="resend-form" class="btn-resend" id="resend-btn">Hantar Semula</button>

                    <button type="submit" class="btn btn-primary" id="submit-btn" disabled>Sahkan</button>
                </div>
            </form>

        </div>

        <a href="{{ route('password.request') }}" class="back-link">Kembali</a>

    </div>

    <form id="resend-form" method="POST" action="{{ route('password.email') }}" style="display:none;">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
    </form>

    <script>
        (function () {
            var inputs = document.querySelectorAll('.otp-input');
            var submitBtn = document.getElementById('submit-btn');

            function updateSubmitState() {
                var allFilled = true;
                for (var i = 0; i < inputs.length; i++) {
                    if (!inputs[i].value || !/^\d$/.test(inputs[i].value)) {
                        allFilled = false;
                        break;
                    }
                }
                submitBtn.disabled = !allFilled;
            }

            function handleInput(e) {
                var el = e.target;
                var val = el.value;
                el.value = val.replace(/[^0-9]/g, '').slice(-1);
                updateSubmitState();

                if (el.value && el.nextElementSibling && el.nextElementSibling.classList.contains('otp-input')) {
                    el.nextElementSibling.focus();
                }
            }

            function handleKeydown(e) {
                var el = e.target;
                if (e.key === 'Backspace' && !el.value && el.previousElementSibling && el.previousElementSibling.classList.contains('otp-input')) {
                    el.previousElementSibling.focus();
                }
                if (e.key === 'ArrowLeft' && el.previousElementSibling && el.previousElementSibling.classList.contains('otp-input')) {
                    el.previousElementSibling.focus();
                }
                if (e.key === 'ArrowRight' && el.nextElementSibling && el.nextElementSibling.classList.contains('otp-input')) {
                    el.nextElementSibling.focus();
                }
            }

            function handlePaste(e) {
                e.preventDefault();
                var paste = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
                var digits = paste.slice(0, 4).split('');
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].value = digits[i] || '';
                }
                var lastIndex = Math.min(digits.length, inputs.length) - 1;
                if (lastIndex >= 0) {
                    inputs[lastIndex].focus();
                }
                updateSubmitState();
            }

            for (var i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('input', handleInput);
                inputs[i].addEventListener('keydown', handleKeydown);
                inputs[i].addEventListener('paste', handlePaste);
            }

            var resendBtn = document.getElementById('resend-btn');
            var countdown = 0;
            var timer = null;

            resendBtn.addEventListener('click', function (e) {
                if (countdown > 0) {
                    e.preventDefault();
                    return;
                }
                countdown = 60;
                resendBtn.disabled = true;
                resendBtn.textContent = 'Hantar Semula (' + countdown + 's)';
                timer = setInterval(function () {
                    countdown--;
                    if (countdown <= 0) {
                        clearInterval(timer);
                        timer = null;
                        resendBtn.disabled = false;
                        resendBtn.textContent = 'Hantar Semula';
                    } else {
                        resendBtn.textContent = 'Hantar Semula (' + countdown + 's)';
                    }
                }, 1000);
            });
        })();
    </script>

</body>
</html>
