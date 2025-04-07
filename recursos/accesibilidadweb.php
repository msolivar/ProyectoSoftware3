<!DOCTYPE html>
<html lang="es">

<head>

    <style>
        a {
            color: blue;
        }

        .accesibilidad-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
        }

        .panel-accesibilidad {
            position: fixed;
            top: 70px;
            right: 20px;
            background-color: white;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            display: none;
            z-index: 999;
        }

        .panel-accesibilidad button {
            display: block;
            width: 100%;
            margin: 5px 0;
            padding: 8px;
            font-size: 14px;
        }

        /* MODO CONTRASTE BLANCO Y NEGRO*/
        .alto-contraste {
            background-color: #000 !important;
            color: gray !important;
        }

        .alto-contraste a {
            color: gray !important;
            text-decoration: underline;
        }

        .alto-contraste img {
            filter: grayscale(100%);
        }

        .alto-contraste button,
        .alto-contraste .accesibilidad-btn {
            background-color: #fff !important;
            color: gray !important;
            border: 1px solid black !important;
        }
    </style>
</head>

<body>

    <button class="accesibilidad-btn" onclick="togglePanel()">♿</button>

    <div class="panel-accesibilidad" id="panelAcc">
        <button onclick="aumentarTexto()">Aumentar texto</button>
        <button onclick="modoContraste()">Contraste blanco-negro</button>
        <button onclick="resetear()">Restaurar</button>
    </div>

    <script>
        let panelVisible = false;
        let size = 16;
        let contrasteActivo = false;

        function togglePanel() {
            panelVisible = !panelVisible;
            document.getElementById("panelAcc").style.display = panelVisible ? "block" : "none";
        }

        function aumentarTexto() {
            size += 2;

            if (size < 24) {
                document.body.style.fontSize = size + "px";

                const parrafos = document.querySelectorAll("p");
                const negritas = document.querySelectorAll("b");

                parrafos.forEach(p => {
                    p.style.fontSize = size + "px";
                });

                negritas.forEach(b => {
                    b.style.fontSize = size + "px";
                });
            }

        }

        function modoContraste() {
            contrasteActivo = !contrasteActivo;
            if (contrasteActivo) {
                document.body.classList.add("alto-contraste");
            } else {
                document.body.classList.remove("alto-contraste");
            }
        }

        function resetear() {
            size = 20;

            const parrafos = document.querySelectorAll("p");
            const negritas = document.querySelectorAll("b");

            parrafos.forEach(p => {
                p.style.fontSize = size + "px";
            });

            negritas.forEach(b => {
                b.style.fontSize = size + "px";
            });

            contrasteActivo = false;
            document.body.style.fontSize = size + "px";
            document.body.classList.remove("alto-contraste");
        }
    </script>

</body>

</html>