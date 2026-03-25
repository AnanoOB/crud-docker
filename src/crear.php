<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("mysql-db", "admin", "secreto", "miapp");
    $nombre   = $conn->real_escape_string($_POST['nombre']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $email    = $conn->real_escape_string($_POST['email']);
    $conn->query("INSERT INTO contactos (nombre, telefono, email) VALUES ('$nombre','$telefono','$email')");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo Contacto</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg:        #0d0f14;
      --surface:   #13161e;
      --border:    #1f2433;
      --accent:    #4f8ef7;
      --accent2:   #a78bfa;
      --text:      #e2e8f0;
      --muted:     #64748b;
      --danger:    #f87171;
      --success:   #34d399;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background-color: var(--bg);
      font-family: 'DM Sans', sans-serif;
      color: var(--text);
      min-height: 100vh;
      background-image:
        radial-gradient(ellipse 80% 50% at 50% -20%, rgba(79,142,247,0.12), transparent),
        radial-gradient(ellipse 60% 40% at 90% 80%, rgba(167,139,250,0.07), transparent);
    }

    /* ── Header ── */
    .header {
      background: linear-gradient(135deg, var(--surface) 0%, #161b27 100%);
      border-bottom: 1px solid var(--border);
      padding: 2rem 2.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 10;
      backdrop-filter: blur(12px);
    }

    .header-title {
      font-family: 'Space Mono', monospace;
      font-size: 1.25rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      background: linear-gradient(90deg, var(--accent), var(--accent2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .header-sub {
      font-size: 0.75rem;
      color: var(--muted);
      margin-top: 2px;
      font-family: 'Space Mono', monospace;
    }

    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(255,255,255,0.04);
      color: var(--muted);
      font-family: 'DM Sans', sans-serif;
      font-weight: 600;
      font-size: 0.875rem;
      padding: 0.6rem 1.25rem;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.2s ease;
      border: 1px solid var(--border);
    }
    .btn-back:hover {
      background: rgba(255,255,255,0.08);
      color: var(--text);
    }

    /* ── Main ── */
    .main {
      max-width: 600px;
      margin: 3rem auto;
      padding: 0 1.5rem;
    }

    /* ── Card ── */
    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 40px rgba(0,0,0,0.4);
      animation: slideUp 0.35s ease both;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .card-header {
      padding: 1.5rem 2rem;
      border-bottom: 1px solid var(--border);
      background: rgba(79,142,247,0.04);
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .card-icon {
      width: 42px; height: 42px;
      border-radius: 10px;
      background: linear-gradient(135deg, var(--accent), #3b6fd4);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 20px rgba(79,142,247,0.3);
      flex-shrink: 0;
    }

    .card-title {
      font-family: 'Space Mono', monospace;
      font-size: 1rem;
      font-weight: 700;
      color: var(--text);
    }

    .card-subtitle {
      font-size: 0.78rem;
      color: var(--muted);
      margin-top: 2px;
    }

    .card-body {
      padding: 2rem;
    }

    /* ── Campos ── */
    .field {
      margin-bottom: 1.5rem;
    }

    .field:last-of-type {
      margin-bottom: 2rem;
    }

    label {
      display: block;
      font-size: 0.72rem;
      font-family: 'Space Mono', monospace;
      font-weight: 700;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      margin-bottom: 0.5rem;
    }

    .input-wrap {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      pointer-events: none;
    }

    input[type="text"],
    input[type="email"] {
      width: 100%;
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 0.75rem 1rem 0.75rem 2.75rem;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      outline: none;
      transition: all 0.2s ease;
    }

    input[type="text"]:focus,
    input[type="email"]:focus {
      border-color: var(--accent);
      background: rgba(79,142,247,0.05);
      box-shadow: 0 0 0 3px rgba(79,142,247,0.12);
    }

    input::placeholder {
      color: #2d3748;
    }

    /* ── Divisor ── */
    .divider {
      height: 1px;
      background: var(--border);
      margin-bottom: 1.5rem;
    }

    /* ── Botones del form ── */
    .form-actions {
      display: flex;
      gap: 0.75rem;
    }

    .btn-submit {
      flex: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      background: linear-gradient(135deg, var(--accent), #3b6fd4);
      color: #fff;
      font-family: 'DM Sans', sans-serif;
      font-weight: 600;
      font-size: 0.9rem;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      transition: all 0.2s ease;
      box-shadow: 0 0 20px rgba(79,142,247,0.25);
    }
    .btn-submit:hover {
      transform: translateY(-1px);
      box-shadow: 0 0 30px rgba(79,142,247,0.45);
    }
    .btn-submit:active { transform: translateY(0); }

    .btn-cancel {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      background: rgba(255,255,255,0.04);
      color: var(--muted);
      font-family: 'DM Sans', sans-serif;
      font-weight: 600;
      font-size: 0.9rem;
      padding: 0.75rem 1.25rem;
      border-radius: 8px;
      border: 1px solid var(--border);
      text-decoration: none;
      transition: all 0.2s ease;
    }
    .btn-cancel:hover {
      background: rgba(255,255,255,0.08);
      color: var(--text);
    }

    /* ── Footer ── */
    .footer {
      text-align: center;
      padding: 2rem;
      font-size: 0.7rem;
      font-family: 'Space Mono', monospace;
      color: var(--muted);
      opacity: 0.5;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div>
      <div class="header-title">// NUEVO CONTACTO</div>
      <div class="header-sub">crud-docker · insertar registro</div>
    </div>
    <a href="index.php" class="btn-back">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path d="M19 12H5M5 12l7-7M5 12l7 7"/>
      </svg>
      Volver
    </a>
  </header>

  <main class="main">
    <div class="card">

      <div class="card-header">
        <div class="card-icon">
          <svg width="20" height="20" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M19 8v6M22 11h-6"/>
          </svg>
        </div>
        <div>
          <div class="card-title">Crear contacto</div>
          <div class="card-subtitle">Completa los campos para agregar un nuevo registro</div>
        </div>
      </div>

      <div class="card-body">
        <form method="POST">

          <div class="field">
            <label for="nombre">Nombre</label>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
              </span>
              <input type="text" id="nombre" name="nombre" placeholder="Ej. Ana García" required>
            </div>
          </div>

          <div class="field">
            <label for="telefono">Teléfono</label>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.23h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.06 6.06l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
              </span>
              <input type="text" id="telefono" name="telefono" placeholder="Ej. 3312345678" required>
            </div>
          </div>

          <div class="field">
            <label for="email">Email</label>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                  <polyline points="22,6 12,13 2,6"/>
                </svg>
              </span>
              <input type="email" id="email" name="email" placeholder="Ej. ana@correo.com" required>
            </div>
          </div>

          <div class="divider"></div>

          <div class="form-actions">
            <a href="index.php" class="btn-cancel">Cancelar</a>
            <button type="submit" class="btn-submit">
              <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                <polyline points="17,21 17,13 7,13 7,21"/>
                <polyline points="7,3 7,8 15,8"/>
              </svg>
              Guardar contacto
            </button>
          </div>

        </form>
      </div>
    </div>
  </main>

  <div class="footer">crud-docker · php:8.2-apache · mysql:8.0 · <?= date('Y') ?></div>

</body>
</html>