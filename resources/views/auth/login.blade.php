<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – ADOPTASTUR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f7f4;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: sans-serif;
        }
        .logo {
            font-size: 2rem;
            font-weight: 900;
            color: #2d6a4f;
            letter-spacing: -1px;
        }
        .logo span { color: #c9873a; }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,.08);
            width: 100%;
            max-width: 420px;
        }
        .form-control:focus {
            border-color: #52b788;
            box-shadow: 0 0 0 .2rem rgba(82,183,136,.2);
        }
        .btn-green {
            background: #2d6a4f;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
        }
        .btn-green:hover { background: #52b788; color: #fff; }
        .link-green { color: #2d6a4f; font-weight: 600; text-decoration: none; }
        .link-green:hover { color: #52b788; }
    </style>
</head>
<body>

    <div class="text-center mb-4">
        <a href="{{ url('/') }}" class="logo text-decoration-none">🐾 ADOPT<span>ASTUR</span></a>
        <p class="text-muted mt-1">Inicia sesión en tu cuenta</p>
    </div>

    <div class="card p-4">

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger py-2">
                @foreach ($errors->all() as $error)
                    <div><i class="bi bi-exclamation-circle me-1"></i>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- Mensaje de sesión (ej: "Tu cuenta ha sido verificada") --}}
        @if (session('status'))
            <div class="alert alert-success py-2">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="tu@email.com" required autofocus>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label for="password" class="form-label fw-semibold">Contraseña</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link-green" style="font-size:.85rem">¿La olvidaste?</a>
                    @endif
                </div>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="••••••••" required>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label text-muted" for="remember">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-green w-100 py-2">
                <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
            </button>
        </form>

    </div>

    @if (Route::has('register'))
        <p class="text-muted mt-3" style="font-size:.9rem">
            ¿No tienes cuenta? <a href="{{ route('register') }}" class="link-green">Regístrate</a>
        </p>
    @endif

    <p class="text-muted mt-2" style="font-size:.8rem">Proyecto Final DAW · IES Monte Naranco</p>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>