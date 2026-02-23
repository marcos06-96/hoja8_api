<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – ADOPTASTUR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f7f4;
            min-height: 100vh;
            font-family: sans-serif;
        }
        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 900;
            color: #2d6a4f !important;
        }
        .navbar-brand span { color: #c9873a; }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,.08);
        }
        .token-box {
            background: #1a2e22;
            color: #52b788;
            border-radius: 10px;
            padding: 1rem 1.2rem;
            font-family: monospace;
            font-size: .85rem;
            word-break: break-all;
            position: relative;
        }
        .btn-green {
            background: #2d6a4f;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
        }
        .btn-green:hover { background: #52b788; color: #fff; }
        .badge-rol {
            font-size: .8rem;
            padding: .4rem .9rem;
            border-radius: 50px;
            font-weight: 700;
        }
        .badge-admin     { background: #2d6a4f; color: #fff; }
        .badge-protectora { background: #c9873a; color: #fff; }
        .badge-usuario   { background: #5b8dee; color: #fff; }
        .copy-btn {
            position: absolute;
            top: .6rem; right: .6rem;
            background: rgba(82,183,136,.2);
            border: none;
            border-radius: 6px;
            color: #52b788;
            padding: .3rem .6rem;
            font-size: .8rem;
            cursor: pointer;
            transition: background .2s;
        }
        .copy-btn:hover { background: rgba(82,183,136,.4); }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm px-3">
        <a class="navbar-brand" href="{{ url('/') }}">🐾 ADOPT<span>ASTUR</span></a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-muted" style="font-size:.9rem">{{ $user->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-box-arrow-right me-1"></i>Salir
                </button>
            </form>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <!-- Bienvenida -->
                <div class="card p-4 mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div style="font-size:2.5rem">👋</div>
                        <div>
                            <h5 class="mb-1 fw-bold">Hola, {{ $user->name }}</h5>
                            <p class="mb-0 text-muted" style="font-size:.9rem">{{ $user->email }}</p>
                        </div>
                        <div class="ms-auto">
                            @if($user->hasRole('admin'))
                                <span class="badge-rol badge-admin">Admin</span>
                            @elseif($user->hasRole('protectora'))
                                <span class="badge-rol badge-protectora">Protectora</span>
                            @else
                                <span class="badge-rol badge-usuario">Usuario</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Token -->
                <div class="card p-4 mb-4">
                    <h6 class="fw-bold mb-1">
                        <i class="bi bi-key-fill me-2 text-success"></i>Tu token de acceso
                    </h6>
                    <p class="text-muted mb-3" style="font-size:.85rem">
                        Usa este token en las cabeceras de tus peticiones a la API:
                        <code>Authorization: Bearer {token}</code>
                    </p>
                    <div class="token-box" id="tokenBox">
                        {{ $token }}
                        <button class="copy-btn" onclick="copiarToken()">
                            <i class="bi bi-clipboard" id="copyIcon"></i>
                        </button>
                    </div>
                    <p class="text-muted mt-2 mb-0" style="font-size:.78rem">
                        <i class="bi bi-info-circle me-1"></i>Guárdalo en un lugar seguro, no se volverá a mostrar.
                    </p>
                </div>

                <!-- Permisos -->
                <div class="card p-4">
    <h6 class="fw-bold mb-3">
        <i class="bi bi-shield-check me-2 text-success"></i>Abilities de tu token
    </h6>
    <ul class="list-unstyled mb-0">
       
       
        @foreach($abilities as $ability)
        @if ($ability=='*')
           <li class="mb-2">
                <i class="bi bi-check-circle-fill text-success me-2"></i>'Todas las habilidades'
            </li> 
        @else
        
            <li class="mb-2">
                <i class="bi bi-check-circle-fill text-success me-2"></i>{{ $ability }}
            </li>
        
        @endif @endforeach
    </ul>
</div>

            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function copiarToken() {
        const token = `{{ $token }}`;
        navigator.clipboard.writeText(token).then(() => {
            const icon = document.getElementById('copyIcon');
            icon.classList.replace('bi-clipboard', 'bi-clipboard-check');
            setTimeout(() => icon.classList.replace('bi-clipboard-check', 'bi-clipboard'), 2000);
        });
    }
</script>
</body>
</html>