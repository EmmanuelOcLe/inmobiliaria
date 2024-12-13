<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal de Eliminación</title>
    <style>
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 24px;
            border-radius: 6px;
            box-shadow: 0 8px 24px rgba(149, 157, 165, 0.2);
            z-index: 1000;
            width: 90%;
            max-width: 450px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 999;
        }
        
        .popup h2 {
            color: #cb2431;
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 16px;
        }

        .popup p {
            color: #24292e;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .popup select, .popup textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #e1e4e8;
            border-radius: 6px;
            font-size: 14px;
        }

        .popup textarea {
            height: 80px;
            resize: vertical;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .popup button {
            padding: 5px 16px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-danger {
            background-color: #cb2431;
            color: #ffffff;
            border: 1px solid rgba(27, 31, 35, 0.15);
        }

        .btn-danger:hover {
            background-color: #b11d28;
        }

        .btn-cancel {
            background-color: #fafbfc;
            color: #24292e;
            border: 1px solid rgba(27, 31, 35, 0.15);
        }

        .btn-cancel:hover {
            background-color: #f3f4f6;
        }
    </style>
</head>
<body>
    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2>Inhabilitar esta propiedad</h2>
        <p>Esta propiedad se inhhabilitará de la base de datos.</p>
        <select id="reasonSelect">
            <option value="">Selecciona una razón para eliminar</option>
            <option value="duplicada">Propiedad duplicada</option>
            <option value="error">Error en la información</option>
            <option value="vendida">Propiedad vendida</option>
            <option value="otra">Otra razón</option>
        </select>
        <textarea id="otherReason" placeholder="Por favor, especifica la razón para inhabilitar esta propiedad" style="display: none;"></textarea>
        <div class="button-group">
            <button class="btn-cancel" id="cancelDelete">Cancelar</button>
            <button class="btn-danger" id="confirmDelete">Entiendo, inhabilitar esta propiedad</button>
        </div>
    </div>

    <script>
        const reasonSelect = document.getElementById('reasonSelect');
        const otherReason = document.getElementById('otherReason');

        // Mostrar/ocultar campo de texto para "Otra razón"
        reasonSelect.addEventListener('change', () => {
            otherReason.style.display = reasonSelect.value === 'otra' ? 'block' : 'none';
        });
    </script>
</body>
</html>