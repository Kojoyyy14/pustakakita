<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PustakaKitaApp</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px; /* Lebar sidebar ditingkatkan */
            --sidebar-bg: #ffffff; /* Mengubah cyan menjadi putih bersih agar modern */
            --content-bg: #f8f9fc;
            --primary-blue: #4e73df;
        }

        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: var(--content-bg);
            margin: 0;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            min-width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            border-right: 1px solid #e3e6f0;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            transition: all 0.3s;
            z-index: 1000;
        }

        /* Main Content Styling */
        .content {
            flex-grow: 1;
            padding: 25px;
            overflow-y: auto;
        }

        /* Menambahkan efek halus pada transisi halaman */
        .content-wrapper {
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Scrollbar untuk sidebar agar tetap rapi */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: #f1f1f1;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <aside id="sidebar" class="sidebar shadow-sm">
        <div class="p-4 border-bottom mb-2 text-center">
            <h5 class="fw-bold text-primary mb-0">
                <i class="bi bi-display fs-5"></i>Application
            </h5>
        </div>
        
        <div class="sidebar-menu-container flex-grow-1">
            <?php include(APPPATH . 'Views/layouts/menu.php'); ?>
        </div>
    </aside>

    <main class="content">
        <div class="content-wrapper">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>