<?php
// Vista del inicio de sesión. Variables que envía LoginController::inicio_login():
// $error, $correoAnterior, $rolAnterior, $recordar
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0A3D1F">
    <title>Iniciar sesión · RutaSegura</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@400..800&display=swap">
    <style>
        /* Paleta tomada del escudo de la I.E. N° 4 */
        :root {
            --verde-bosque: #0A3D1F;
            --verde-medio: #0C4626;
            --verde-oscuro: #082E19;
            --verde-escudo: #1E8C3A;
            --amarillo: #F4D21F;
            --llama: #E84C2B;
            --azul: #1F3A8C;
            --marfil: #FBFBF4;
            --texto-85: rgba(251, 251, 244, 0.85);
            --texto-70: rgba(251, 251, 244, 0.7);
            --texto-55: rgba(251, 251, 244, 0.55);
            --borde-campo: rgba(251, 251, 244, 0.25);
            --error: #FF8A6B;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            position: relative;
            display: grid;
            grid-template-rows: auto 1fr auto;
            min-height: 100vh;
            min-height: 100dvh;
            overflow-x: hidden;
            font-family: "Plus Jakarta Sans", system-ui, -apple-system, "Segoe UI", sans-serif;
            font-size: 16px;
            color: var(--marfil);
            background: var(--verde-bosque) linear-gradient(160deg, var(--verde-bosque) 0%, var(--verde-medio) 55%, var(--verde-oscuro) 100%) fixed;
        }

        .oculto {
            position: absolute; width: 1px; height: 1px;
            overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap;
        }

        /* Fondo */
        .franja {
            position: fixed; inset: 0 0 auto 0; height: 6px; z-index: 5;
            background: linear-gradient(90deg,
                var(--verde-escudo) 0 25%, var(--amarillo) 25% 50%,
                var(--llama) 50% 75%, var(--azul) 75% 100%);
        }

        .resplandor {
            position: fixed; inset: 0; pointer-events: none;
            background: radial-gradient(at 55% 50%, rgba(244, 210, 31, 0.10) 0%, rgba(10, 61, 31, 0) 55%);
        }

        .mapa {
            position: fixed; left: 50%; top: 52%;
            width: min(1300px, 110vw); height: auto;
            transform: translate(-46%, -50%);
            opacity: 0.9;
            pointer-events: none;
        }

        /* Encabezado institucional */
        .encabezado {
            position: relative; z-index: 2;
            display: flex; align-items: center; gap: 14px;
            padding: 36px 44px 0;
        }

        .escudo {
            width: 52px; height: 52px; flex: none;
            border-radius: 50%;
            object-fit: contain;
            background: #fff;
            border: 3px solid var(--amarillo);
            box-shadow: 0 0 0 3px var(--verde-escudo);
        }

        .institucion {
            display: flex; flex-direction: column; gap: 1px;
            padding-left: 14px;
            border-left: 3px solid var(--amarillo);
            line-height: 1.35;
        }
        .institucion strong { font-size: 18px; font-weight: 700; }
        .institucion span { font-size: 15px; color: var(--texto-70); }

        /* Tarjeta de vidrio */
        .centro {
            position: relative; z-index: 2;
            display: grid; place-items: center;
            padding: 32px 20px;
        }

        .tarjeta {
            display: flex; flex-direction: column; gap: 13px;
            width: 100%; max-width: 450px;
            padding: 38px;
            border-radius: 22px;
            background: rgba(8, 40, 22, 0.62);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.12), 0 30px 80px rgba(0, 0, 0, 0.35);
            -webkit-backdrop-filter: blur(20px) saturate(1.4);
            backdrop-filter: blur(20px) saturate(1.4);
        }

        .eyebrow {
            font-size: 15px; font-weight: 700;
            color: var(--amarillo);
            letter-spacing: 3px; text-transform: uppercase;
        }
        h1 { font-size: 36px; font-weight: 700; line-height: 1.1; letter-spacing: -0.8px; }
        .subtitulo { margin-top: -4px; color: var(--texto-70); }

        .barras { display: flex; gap: 5px; padding: 2px 0; }
        .barras i { width: 40px; height: 5px; border-radius: 3px; }
        .barras i:nth-child(1) { background: var(--verde-escudo); }
        .barras i:nth-child(2) { background: var(--amarillo); }
        .barras i:nth-child(3) { background: var(--llama); }
        .barras i:nth-child(4) { background: var(--azul); }

        .alerta {
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid rgba(232, 76, 43, 0.45);
            background: rgba(232, 76, 43, 0.12);
            color: var(--error);
            font-size: 14px; line-height: 1.4;
        }

        /* Selector de rol: dos radios con aspecto de pestañas */
        .rol {
            display: flex; gap: 4px;
            padding: 4px;
            border: 0; border-radius: 12px;
            background: rgba(0, 0, 0, 0.22);
        }
        .rol input { position: absolute; opacity: 0; pointer-events: none; }
        .rol label {
            flex: 1;
            padding: 8px;
            border-radius: 9px;
            border-bottom: 3px solid transparent;
            text-align: center;
            font-weight: 600;
            color: rgba(251, 251, 244, 0.75);
            cursor: pointer;
        }
        .rol label:hover { background: rgba(255, 255, 255, 0.06); }
        .rol input:checked + label {
            background: var(--marfil);
            color: var(--verde-bosque);
            font-weight: 700;
            border-bottom-color: var(--verde-escudo);
        }
        .rol input:focus-visible + label { outline: 2px solid var(--amarillo); outline-offset: 2px; }
        .rol-corto { display: none; }

        /* Campos */
        .campo { display: flex; flex-direction: column; gap: 7px; }
        .campo > label { font-size: 15px; font-weight: 600; color: var(--texto-85); }

        .entrada {
            display: flex; align-items: center; gap: 10px;
            padding: 0 14px;
            border-radius: 11px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid var(--borde-campo);
        }
        .entrada:focus-within { border-color: var(--amarillo); box-shadow: 0 0 0 3px rgba(244, 210, 31, 0.15); }
        .entrada.invalida { border-color: var(--llama); }
        .entrada svg {
            width: 22px; height: 22px; flex: none;
            fill: none; stroke: var(--texto-70); stroke-width: 1.8;
            stroke-linecap: round; stroke-linejoin: round;
        }
        .entrada input {
            flex: 1; min-width: 0;
            padding: 13px 0;
            border: 0; outline: 0;
            background: transparent;
            color: var(--marfil);
            font: inherit; font-size: 17px;
        }
        .entrada input::placeholder { color: var(--texto-55); }
        .entrada input:-webkit-autofill {
            -webkit-text-fill-color: var(--marfil);
            -webkit-box-shadow: 0 0 0 40px #123d24 inset;
        }

        .mostrar {
            padding: 6px 2px;
            border: 0; background: none; cursor: pointer;
            font: inherit; font-size: 15px; font-weight: 600;
            color: var(--amarillo);
        }
        .mostrar:hover { text-decoration: underline; }
        .mostrar:focus-visible { outline: 2px solid var(--amarillo); border-radius: 4px; }

        .recordar {
            display: flex; align-items: center; gap: 10px;
            width: fit-content;
            font-size: 15px; color: var(--texto-85);
            cursor: pointer;
        }
        .recordar input { width: 20px; height: 20px; accent-color: var(--amarillo); }

        .boton {
            margin-top: 2px; padding: 14px;
            border: 0; border-radius: 12px; cursor: pointer;
            background: var(--amarillo);
            color: var(--verde-bosque);
            font: inherit; font-size: 18px; font-weight: 700;
        }
        .boton:hover { filter: brightness(1.06); }
        .boton:focus-visible { outline: 3px solid var(--marfil); outline-offset: 2px; }
        .boton[disabled] { cursor: progress; filter: saturate(0.7); }

        .nota {
            display: flex; align-items: center; gap: 10px;
            padding-top: 13px;
            border-top: 1px solid rgba(251, 251, 244, 0.15);
            font-size: 15px; line-height: 1.35;
            color: var(--texto-70);
        }
        .nota b { color: var(--texto-85); }
        .nota svg {
            width: 26px; height: 26px; flex: none;
            fill: none; stroke: var(--llama); stroke-width: 1.8;
            stroke-linecap: round; stroke-linejoin: round;
        }

        /* Ubicación y pie */
        .ubicacion {
            position: fixed; left: 44px; bottom: 44px; z-index: 1;
            display: flex; align-items: center; gap: 14px;
        }
        .ubicacion > svg { width: 28px; height: 42px; }
        .ubicacion strong {
            display: block;
            font-size: 15px; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase;
        }
        .ubicacion span {
            font-family: "JetBrains Mono", ui-monospace, Consolas, monospace;
            font-size: 14px; color: rgba(251, 251, 244, 0.6);
        }

        .pie {
            position: relative; z-index: 1;
            padding: 0 44px 28px;
            text-align: right;
            font-size: 14px; color: var(--texto-55);
        }

        /* Pantallas medianas: la ubicación no debe tapar la tarjeta */
        @media (max-width: 1100px), (max-height: 760px) {
            .ubicacion { display: none; }
            .pie { text-align: center; }
        }

        /* Móvil: la tarjeta se vuelve una hoja inferior */
        @media (max-width: 600px) {
            body { grid-template-rows: auto 1fr; }

            .encabezado {
                flex-direction: column; justify-content: center;
                padding: 56px 16px 0;
                text-align: center;
            }
            .escudo { width: 72px; height: 72px; }
            .institucion { align-items: center; padding-left: 0; border-left: 0; }
            .institucion strong { font-size: 17px; }
            .institucion span { display: none; }

            .mapa { width: 160vw; top: 30%; transform: translate(-50%, -50%); }

            .centro { align-items: end; padding: 28px 0 0; }

            .tarjeta {
                max-width: none;
                padding: 26px 16px calc(20px + env(safe-area-inset-bottom));
                border-radius: 26px 26px 0 0;
                border-bottom: 0;
            }
            .tarjeta::before {
                content: "";
                width: 44px; height: 5px;
                margin: -12px auto 4px;
                border-radius: 3px;
                background: rgba(251, 251, 244, 0.3);
            }
            .eyebrow, .subtitulo, .barras, .pie { display: none; }
            h1 { font-size: 30px; }
            .rol-largo { display: none; }
            .rol-corto { display: inline; }
            .entrada input { font-size: 16px; } /* evita el zoom automático en iOS */
        }
    </style>
</head>
<body>

    <div class="franja" aria-hidden="true"></div>
    <div class="resplandor" aria-hidden="true"></div>
    <svg class="mapa" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 456 406" width="456" height="406">
<defs>
<pattern id="p" width="6" height="6" patternUnits="userSpaceOnUse"><circle cx="1" cy="1" r="0.7" fill="#FBFBF4" fill-opacity="0.22"></circle></pattern>
<clipPath id="c"><path d="M414 30 L401 31 L395 36 L332 128 L319 127 L311 131 L301 131 L298 129 L293 132 L274 132 L271 129 L264 131 L258 131 L256 134 L243 133 L239 134 L236 137 L231 137 L226 133 L212 131 L204 135 L195 134 L188 146 L180 146 L167 155 L147 161 L138 167 L129 168 L119 174 L111 174 L100 180 L95 180 L73 175 L67 172 L57 177 L49 189 L38 189 L30 192 L36 196 L37 201 L40 204 L41 216 L51 235 L51 254 L56 255 L72 241 L74 237 L74 228 L77 225 L73 225 L72 220 L76 217 L79 209 L94 207 L101 202 L105 202 L106 207 L104 209 L104 212 L108 217 L108 223 L113 227 L115 237 L123 242 L126 250 L126 256 L144 267 L150 267 L152 274 L158 281 L160 301 L168 306 L174 348 L171 351 L164 351 L158 349 L156 350 L156 355 L154 357 L141 357 L137 354 L129 352 L101 351 L106 359 L112 361 L117 367 L123 363 L128 363 L133 369 L151 370 L154 375 L157 375 L161 371 L171 370 L177 366 L184 366 L195 363 L201 360 L206 355 L213 356 L217 359 L239 358 L252 362 L266 361 L425 57 L422 54 L424 46 L422 44 L415 42 Z"></path></clipPath>
</defs>
<path d="M414 30 L401 31 L395 36 L332 128 L319 127 L311 131 L301 131 L298 129 L293 132 L274 132 L271 129 L264 131 L258 131 L256 134 L243 133 L239 134 L236 137 L231 137 L226 133 L212 131 L204 135 L195 134 L188 146 L180 146 L167 155 L147 161 L138 167 L129 168 L119 174 L111 174 L100 180 L95 180 L73 175 L67 172 L57 177 L49 189 L38 189 L30 192 L36 196 L37 201 L40 204 L41 216 L51 235 L51 254 L56 255 L72 241 L74 237 L74 228 L77 225 L73 225 L72 220 L76 217 L79 209 L94 207 L101 202 L105 202 L106 207 L104 209 L104 212 L108 217 L108 223 L113 227 L115 237 L123 242 L126 250 L126 256 L144 267 L150 267 L152 274 L158 281 L160 301 L168 306 L174 348 L171 351 L164 351 L158 349 L156 350 L156 355 L154 357 L141 357 L137 354 L129 352 L101 351 L106 359 L112 361 L117 367 L123 363 L128 363 L133 369 L151 370 L154 375 L157 375 L161 371 L171 370 L177 366 L184 366 L195 363 L201 360 L206 355 L213 356 L217 359 L239 358 L252 362 L266 361 L425 57 L422 54 L424 46 L422 44 L415 42 Z" fill="#FBFBF4" fill-opacity="0.04"></path>
<rect x="0" y="0" width="456" height="406" fill="url(#p)" clip-path="url(#c)"></rect>
<path d="M414 30 L401 31 L395 36 L332 128 L319 127 L311 131 L301 131 L298 129 L293 132 L274 132 L271 129 L264 131 L258 131 L256 134 L243 133 L239 134 L236 137 L231 137 L226 133 L212 131 L204 135 L195 134 L188 146 L180 146 L167 155 L147 161 L138 167 L129 168 L119 174 L111 174 L100 180 L95 180 L73 175 L67 172 L57 177 L49 189 L38 189 L30 192 L36 196 L37 201 L40 204 L41 216 L51 235 L51 254 L56 255 L72 241 L74 237 L74 228 L77 225 L73 225 L72 220 L76 217 L79 209 L94 207 L101 202 L105 202 L106 207 L104 209 L104 212 L108 217 L108 223 L113 227 L115 237 L123 242 L126 250 L126 256 L144 267 L150 267 L152 274 L158 281 L160 301 L168 306 L174 348 L171 351 L164 351 L158 349 L156 350 L156 355 L154 357 L141 357 L137 354 L129 352 L101 351 L106 359 L112 361 L117 367 L123 363 L128 363 L133 369 L151 370 L154 375 L157 375 L161 371 L171 370 L177 366 L184 366 L195 363 L201 360 L206 355 L213 356 L217 359 L239 358 L252 362 L266 361 L425 57 L422 54 L424 46 L422 44 L415 42 Z" fill="none" stroke="#F4D21F" stroke-opacity="0.75" stroke-width="1" stroke-linejoin="round"></path>
<circle cx="277.7" cy="229.4" r="10" fill="none" stroke="#F4D21F" stroke-opacity="0.6" stroke-width="0.8"></circle>
<circle cx="277.7" cy="229.4" r="3.5" fill="#F4D21F"></circle>
</svg>

    <header class="encabezado">
        <img class="escudo" src="<?= htmlspecialchars($base, ENT_QUOTES, 'UTF-8') ?>/img/escudo.jpg" alt="Escudo de la Institución Educativa N° 4">
        <div class="institucion">
            <strong>Institución Educativa N° 4</strong>
            <span>San José Campestre · Maicao</span>
        </div>
    </header>

    <main class="centro">
        <form class="tarjeta" id="form-login" action="<?= htmlspecialchars($base, ENT_QUOTES, 'UTF-8') ?>/login" method="POST" novalidate>

            <p class="eyebrow">RutaSegura</p>
            <h1>Iniciar sesión</h1>
            <p class="subtitulo">Sistema de gestión de ruta escolar</p>
            <div class="barras" aria-hidden="true"><i></i><i></i><i></i><i></i></div>

            <?php if ($error): ?>
                <div class="alerta" role="alert" id="alerta-servidor"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
            <div class="alerta" role="alert" id="alerta-cliente" hidden></div>

            <fieldset class="rol">
                <legend class="oculto">Tipo de usuario</legend>

                <input type="radio" name="rol" id="rol-admin" value="administrador" <?= $rolAnterior !== 'auxiliar' ? 'checked' : '' ?>>
                <label for="rol-admin"><span class="rol-largo">Administrador</span><span class="rol-corto">Admin</span></label>

                <input type="radio" name="rol" id="rol-aux" value="auxiliar" <?= $rolAnterior === 'auxiliar' ? 'checked' : '' ?>>
                <label for="rol-aux">Auxiliar</label>
            </fieldset>

            <div class="campo">
                <label for="correo">Correo</label>
                <div class="entrada">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                    <input type="email" id="correo" name="correo" placeholder="correo"
                           value="<?= htmlspecialchars($correoAnterior, ENT_QUOTES, 'UTF-8') ?>" autocomplete="username" required
                           <?= $correoAnterior === '' ? 'autofocus' : '' ?>>
                </div>
            </div>

            <div class="campo">
                <label for="contrasena">Contraseña</label>
                <div class="entrada">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                    <input type="password" id="contrasena" name="contrasena" placeholder="••••••••••"
                           autocomplete="current-password" required
                           <?= $correoAnterior !== '' ? 'autofocus' : '' ?>>
                    <button type="button" class="mostrar" id="btn-mostrar" aria-controls="contrasena" aria-pressed="false">Mostrar</button>
                </div>
            </div>

            <label class="recordar">
                <input type="checkbox" name="recordarme" <?= $recordar ? 'checked' : '' ?>>
                Recordarme
            </label>

            <button type="submit" class="boton" id="btn-ingresar">Ingresar</button>

            <p class="nota">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 4 6v6c0 4.5 3.4 8.3 8 9 4.6-.7 8-4.5 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/></svg>
                <span><b>Software exclusivo</b> de la I.E. N° 4 San José Campestre</span>
            </p>
        </form>
    </main>

    <aside class="ubicacion" aria-label="Ubicación">
        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 40 60" width="40" height="60"><path d="M20 4 L32 44 L20 36 L8 44 Z" fill="none" stroke="#F4D21F" stroke-width="2" stroke-linejoin="round"/><path d="M20 4 L20 36 L8 44 Z" fill="#F4D21F"/><path d="M14 58 V50 L26 58 V50" fill="none" stroke="#FBFBF4" stroke-opacity="0.7" stroke-width="2"/></svg>
        <div>
            <strong>Maicao, La Guajira</strong>
            <span>11°23′ N · 72°14′ O</span>
        </div>
    </aside>

    <footer class="pie">© <?= date('Y') ?> I.E. N° 4 San José Campestre · v1.0</footer>

    <script>
        // La validación real la hace LoginController; aquí solo se mejora el uso del formulario.
        const formulario = document.getElementById('form-login');
        const correo = document.getElementById('correo');
        const contrasena = document.getElementById('contrasena');
        const btnMostrar = document.getElementById('btn-mostrar');
        const btnIngresar = document.getElementById('btn-ingresar');
        const alertaCliente = document.getElementById('alerta-cliente');
        const alertaServidor = document.getElementById('alerta-servidor');

        btnMostrar.addEventListener('click', function () {
            const visible = contrasena.type === 'text';
            contrasena.type = visible ? 'password' : 'text';
            btnMostrar.textContent = visible ? 'Mostrar' : 'Ocultar';
            btnMostrar.setAttribute('aria-pressed', String(!visible));
            contrasena.focus();
        });

        function mostrarError(texto, campo) {
            if (alertaServidor) alertaServidor.hidden = true;
            alertaCliente.textContent = texto;
            alertaCliente.hidden = false;
            campo.closest('.entrada').classList.add('invalida');
            campo.focus();
        }

        [correo, contrasena].forEach(function (campo) {
            campo.addEventListener('input', function () {
                campo.closest('.entrada').classList.remove('invalida');
                alertaCliente.hidden = true;
            });
        });

        formulario.addEventListener('submit', function (evento) {
            if (correo.value.trim() === '') {
                evento.preventDefault();
                return mostrarError('Escribe tu correo.', correo);
            }
            if (!correo.checkValidity()) {
                evento.preventDefault();
                return mostrarError('El correo no es válido.', correo);
            }
            if (contrasena.value === '') {
                evento.preventDefault();
                return mostrarError('Escribe tu contraseña.', contrasena);
            }

            btnIngresar.disabled = true;
            btnIngresar.textContent = 'Ingresando…';
        });

        // Al volver con el botón Atrás, el botón debe quedar activo otra vez
        window.addEventListener('pageshow', function () {
            btnIngresar.disabled = false;
            btnIngresar.textContent = 'Ingresar';
        });
    </script>
</body>
</html>
