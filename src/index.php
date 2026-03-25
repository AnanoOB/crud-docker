<?php
$conn = new mysqli("mysql-db", "admin", "secreto", "miapp");
if ($conn->connect_error) die("Error: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM contactos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contactos</title>
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

    .mono { font-family: 'Space Mono', monospace; }

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

    /* ── Botón nuevo ── */
    .btn-new {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: linear-gradient(135deg, var(--accent), #3b6fd4);
      color: #fff;
      font-family: 'DM Sans', sans-serif;
      font-weight: 600;
      font-size: 0.875rem;
      padding: 0.6rem 1.25rem;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.2s ease;
      box-shadow: 0 0 20px rgba(79,142,247,0.25);
      border: 1px solid rgba(79,142,247,0.3);
    }
    .btn-new:hover {
      transform: translateY(-1px);
      box-shadow: 0 0 30px rgba(79,142,247,0.45);
    }
    .btn-new:active { transform: translateY(0); }

    /* ── Contenedor principal ── */
    .main {
      max-width: 1100px;
      margin: 2.5rem auto;
      padding: 0 1.5rem;
    }

    /* ── Stats bar ── */
    .stats-bar {
      display: flex;
      gap: 1rem;
      margin-bottom: 1.75rem;
    }

    .stat-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 1rem 1.5rem;
      flex: 1;
    }
    .stat-label {
      font-size: 0.7rem;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      font-family: 'Space Mono', monospace;
    }
    .stat-value {
      font-size: 1.75rem;
      font-weight: 700;
      font-family: 'Space Mono', monospace;
      background: linear-gradient(90deg, var(--accent), var(--accent2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-top: 2px;
    }

    /* ── Tabla ── */
    .table-wrap {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 8px 40px rgba(0,0,0,0.4);
    }

    .table-header-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1.1rem 1.5rem;
      border-bottom: 1px solid var(--border);
      background: rgba(255,255,255,0.02);
    }

    .table-title {
      font-size: 0.8rem;
      font-family: 'Space Mono', monospace;
      color: var(--muted);
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }

    .dot {
      width: 8px; height: 8px;
      border-radius: 50%;
      display: inline-block;
      margin-right: 4px;
    }
    .dot-red   { background: #f87171; }
    .dot-yellow{ background: #fbbf24; }
    .dot-green { background: #34d399; }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead th {
      background: rgba(79,142,247,0.06);
      padding: 0.85rem 1.5rem;
      text-align: left;
      font-size: 0.7rem;
      font-family: 'Space Mono', monospace;
      font-weight: 700;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.1em;
      border-bottom: 1px solid var(--border);
    }

    thead th:first-child { width: 60px; }
    thead th:last-child  { text-align: center; width: 160px; }

    tbody tr {
      border-bottom: 1px solid var(--border);
      transition: background 0.15s ease;
    }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: rgba(79,142,247,0.04); }

    tbody td {
      padding: 1rem 1.5rem;
      font-size: 0.9rem;
      vertical-align: middle;
    }

    .td-id {
      font-family: 'Space Mono', monospace;
      font-size: 0.75rem;
      color: var(--muted);
    }

    .td-name {
      font-weight: 600;
      color: var(--text);
    }

    .td-phone {
      font-family: 'Space Mono', monospace;
      font-size: 0.82rem;
      color: #94a3b8;
    }

    .td-email {
      color: var(--accent);
      font-size: 0.85rem;
    }

    /* Avatar inicial */
    .avatar {
      width: 32px; height: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 0.75rem;
      color: #fff;
      margin-right: 0.6rem;
      flex-shrink: 0;
      font-family: 'Space Mono', monospace;
    }

    .name-cell { display: flex; align-items: center; }

    /* Acciones */
    .actions { display: flex; gap: 0.5rem; justify-content: center; }

    .btn-edit, .btn-del {
      padding: 0.35rem 0.85rem;
      border-radius: 6px;
      font-size: 0.78rem;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.18s ease;
      border: 1px solid transparent;
      font-family: 'DM Sans', sans-serif;
    }

    .btn-edit {
      background: rgba(79,142,247,0.12);
      color: var(--accent);
      border-color: rgba(79,142,247,0.25);
    }
    .btn-edit:hover {
      background: rgba(79,142,247,0.22);
      box-shadow: 0 0 12px rgba(79,142,247,0.2);
    }

    .btn-del {
      background: rgba(248,113,113,0.1);
      color: var(--danger);
      border-color: rgba(248,113,113,0.2);
    }
    .btn-del:hover {
      background: rgba(248,113,113,0.2);
      box-shadow: 0 0 12px rgba(248,113,113,0.15);
    }

    /* Empty state */
    .empty {
      text-align: center;
      padding: 4rem 2rem;
    }
    .empty-icon {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      opacity: 0.4;
    }
    .empty-text {
      color: var(--muted);
      font-size: 0.9rem;
    }

    /* Footer */
    .footer {
      text-align: center;
      padding: 2rem;
      font-size: 0.7rem;
      font-family: 'Space Mono', monospace;
      color: var(--muted);
      opacity: 0.5;
    }

    /* Animación de entrada para filas */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(6px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    tbody tr {
      animation: fadeIn 0.3s ease both;
    }
    tbody tr:nth-child(1)  { animation-delay: 0.05s; }
    tbody tr:nth-child(2)  { animation-delay: 0.10s; }
    tbody tr:nth-child(3)  { animation-delay: 0.15s; }
    tbody tr:nth-child(4)  { animation-delay: 0.20s; }
    tbody tr:nth-child(5)  { animation-delay: 0.25s; }
    tbody tr:nth-child(n+6){ animation-delay: 0.30s; }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div>
      <div class="header-title">// CONTACTOS</div>
      <div class="header-sub">crud-docker · mysql-db · miapp</div>
    </div>
    <a href="crear.php" class="btn-new">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path d="M12 5v14M5 12h14"/>
      </svg>
      Nuevo contacto
    </a>
  </header>

  <!-- Main -->
  <main class="main">

    <!-- Stats -->
    <?php
      $total = $conn->query("SELECT COUNT(*) AS c FROM contactos")->fetch_assoc()['c'];
    ?>
    <div class="stats-bar">
      <div class="stat-card">
        <div class="stat-label">Total registros</div>
        <div class="stat-value"><?= $total ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Base de datos</div>
        <div class="stat-value" style="font-size:1rem; margin-top:6px; -webkit-text-fill-color: #34d399;">miapp</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Estado</div>
        <div style="display:flex; align-items:center; gap:6px; margin-top:6px;">
          <span style="width:8px;height:8px;border-radius:50%;background:#34d399;display:inline-block;box-shadow:0 0 6px #34d399;"></span>
          <span style="font-family:'Space Mono',monospace; font-size:0.85rem; color:#34d399;">Conectado</span>
        </div>
      </div>
    </div>

    <!-- Tabla -->
    <div class="table-wrap">
      <div class="table-header-bar">
        <span class="table-title">registros · contactos</span>
        <div>
          <span class="dot dot-red"></span>
          <span class="dot dot-yellow"></span>
          <span class="dot dot-green"></span>
        </div>
      </div>

      <?php if ($total == 0): ?>
        <div class="empty">
          <div class="empty-icon">📭</div>
          <div class="empty-text">No hay contactos aún. <a href="crear.php" style="color:var(--accent);">Crea el primero.</a></div>
        </div>
      <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td class="td-id"><?= str_pad($row['id'], 3, '0', STR_PAD_LEFT) ?></td>
            <td>
              <div class="name-cell">
                <span class="avatar"><?= strtoupper(substr($row['nombre'], 0, 1)) ?></span>
                <span class="td-name"><?= htmlspecialchars($row['nombre']) ?></span>
              </div>
            </td>
            <td class="td-phone"><?= htmlspecialchars($row['telefono']) ?></td>
            <td class="td-email"><?= htmlspecialchars($row['email']) ?></td>
            <td>
              <div class="actions">
                <a href="editar.php?id=<?= $row['id'] ?>" class="btn-edit">Editar</a>
                <a href="eliminar.php?id=<?= $row['id'] ?>"
                   onclick="return confirm('¿Eliminar a <?= htmlspecialchars($row['nombre']) ?>?')"
                   class="btn-del">Eliminar</a>
              </div>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>

  </main>

  <div class="footer">crud-docker · php:8.2-apache · mysql:8.0 · <?= date('Y') ?></div>

</body>
</html>