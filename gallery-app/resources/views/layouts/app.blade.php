<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotogalerie</title>

    <!-- Bootstrap CSS (pokud používáš Bootstrap pro styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Hlavička nebo Navigace -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                    
                    </li>
                    <li class="nav-item">
                    
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Hlavní obsah stránky -->
        @yield('content')
    </div>

    <!-- Bootstrap JS (volitelný pro interaktivní prvky, jako je dropdown, modální okna atd.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
