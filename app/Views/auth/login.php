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
    <link rel="stylesheet" href="<?= htmlspecialchars($base, ENT_QUOTES, 'UTF-8') ?>/css/login.css">
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

    <script src="<?= htmlspecialchars($base, ENT_QUOTES, 'UTF-8') ?>/js/login.js"></script>
</body>
</html>
