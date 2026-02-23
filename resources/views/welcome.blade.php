<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADOPTASTUR</title>
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
        .btn-green {
            background: #2d6a4f;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
        }
        .btn-green:hover { background: #52b788; color: #fff; }
        .btn-outline-green {
            border: 2px solid #2d6a4f;
            color: #2d6a4f;
            border-radius: 8px;
            font-weight: 700;
            background: transparent;
        }
        .btn-outline-green:hover { background: #2d6a4f; color: #fff; }
    </style>
</head>
<body>

    <div class="text-center mb-4">
        <div class="logo">🐾 ADOPT<span>ASTUR</span></div>
        <p class="text-muted mt-1">Adopción animal en Asturias</p>
    </div>

    <div class="card p-4 text-center">
        <p class="text-muted mb-4">Conectamos animales con familias en el Principado de Asturias.</p>
        <div class="d-grid gap-3">
            <a href="{{ route('login') }}" class="btn btn-green py-2">
                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar sesión
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-green py-2">
                <i class="bi bi-person-plus me-2"></i>Crear cuenta
            </a>
        </div>
    </div>

    <p class="text-muted mt-4" style="font-size:.8rem">Proyecto Final DAW · IES Monte Naranco</p>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>