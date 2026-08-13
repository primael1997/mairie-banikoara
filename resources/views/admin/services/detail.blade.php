<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service->titre }} | Mairie de Banikoara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #008000; /* Vert Bénin */
            --secondary: #3cee60; /* Or Bénin */
            --accent: #fc305f; /* Rouge Bénin */
            --light: #f8f9fa;
            --dark: #212529;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        /* Header */
        .service-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .service-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .service-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }

        .service-badge {
            background-color: var(--accent);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Breadcrumb */
        .service-breadcrumb {
            background-color: rgba(255,255,255,0.9);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .breadcrumb {
            margin-bottom: 0;
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s;
        }

        .breadcrumb-item a:hover {
            color: var(--accent);
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: var(--dark);
            font-weight: 500;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: var(--secondary);
            font-weight: bold;
        }

        /* Service Image */
        .service-image-wrapper {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 5px solid white;
        }

        .service-image-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .service-main-image {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Service Sections */
        .service-section {
            background-color: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-left: 4px solid var(--secondary);
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px dashed var(--primary);
        }

        .section-icon {
            color: var(--primary);
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
            margin: 0;
        }

        .section-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .pieces-required {
            padding-left: 1.5rem;
        }

        .pieces-required ul {
            padding-left: 1.5rem;
        }

        /* Sidebar */
        .service-sidebar {
            position: sticky;
            top: 20px;
        }

        .sidebar-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            padding: 1rem 1.5rem;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-header i {
            margin-right: 0.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-list li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }

        .info-list li:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: var(--primary);
        }

        .info-value {
            font-weight: 500;
            color: var(--dark);
        }

        .btn-back {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            border: none;
            width: 100%;
            text-align: center;
        }

        .btn-back:hover {
            background-color: var(--accent);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Similar Services */
        .similar-services {
            background-color: #f8f9fa;
            padding: 3rem 0;
            margin-top: 2rem;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .similar-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }

        .similar-title::after {
            content: "";
            display: block;
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
            margin: 0.5rem auto 0;
            border-radius: 2px;
        }

        .similar-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
            margin-bottom: 1.5rem;
        }

        .similar-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .similar-card-img {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }

        .similar-card-body {
            padding: 1.5rem;
        }

        .similar-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .similar-card-text {
            color: #666;
            margin-bottom: 1rem;
        }

        .similar-card-link {
            display: inline-block;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .similar-card-link:hover {
            color: var(--accent);
            text-decoration: underline;
        }

        /* Footer */
        .service-footer {
            background-color: var(--dark);
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        .footer-logo {
            max-width: 150px;
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 1rem 0;
        }

        .footer-links li {
            display: inline-block;
            margin: 0 1rem;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer-links a:hover {
            color: var(--secondary);
        }

        .footer-social {
            margin-top: 1.5rem;
        }

        .footer-social a {
            color: white;
            font-size: 1.5rem;
            margin: 0 0.5rem;
            transition: all 0.3s;
        }

        .footer-social a:hover {
            color: var(--secondary);
            transform: translateY(-3px);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .service-sidebar {
                margin-top: 3rem;
            }
        }

        @media (max-width: 768px) {
            .service-title {
                font-size: 2rem;
            }

            .section-title {
                font-size: 1.25rem;
            }

            .section-content {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="service-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="service-title">{{ $service->titre }}</h1>
                    <div class="d-flex align-items-center">
                        <span class="service-badge">{{ $service->categorie->libelle }}</span>
                        <span class="ms-3 text-white">
                            <i class="fas fa-money-bill-wave me-1"></i>
                            {{ $service->cout > 0 ? number_format($service->cout, 0, ',', ' ').' FCFA' : 'Gratuit' }}
                        </span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">

                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Mairie de Banikoara">
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="service-breadcrumb">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><i class="fas fa-home me-1"></i> Accueil</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('mespages.nosservices') }}"><i class="fas fa-list-alt me-1"></i> Services</a></li>
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-folder me-1"></i> {{ $service->categorie->libelle }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-file-alt me-1"></i> {{ $service->titre }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Service Content -->
            <div class="col-lg-8">
                <!-- Service Image -->
                @if($service->image)
                <div class="service-image-wrapper mb-4">
                    <img src="{{ asset('uploads/services/'.$service->image) }}"
                         alt="{{ $service->titre }}"
                         class="service-main-image">
                </div>
                @endif

                <!-- Description -->
                <div class="service-section mb-4">
                    <div class="section-header">
                        <i class="fas fa-info-circle section-icon"></i>
                        <h2 class="section-title">Description du service</h2>
                    </div>
                    <div class="section-content">
                        {!! nl2br(e($service->description)) !!}
                    </div>
                </div>

                <!-- Pièces à fournir -->
                <div class="service-section mb-4">
                    <div class="section-header">
                        <i class="fas fa-file-alt section-icon"></i>
                        <h2 class="section-title">Pièces à fournir</h2>
                    </div>
                    <div class="section-content pieces-required">
                        {!! nl2br(e($service->pieces_fournir)) !!}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="service-sidebar">
                    <!-- Informations pratiques -->
                    <div class="sidebar-card">
                        <div class="card-header">
                            <i class="fas fa-info-circle"></i>
                            <h3>Informations pratiques</h3>
                        </div>
                        <div class="card-body">
                            <ul class="info-list">
                                <li>
                                    <span class="info-label"><i class="fas fa-folder me-2"></i> Catégorie :</span>
                                    <span class="info-value">{{ $service->categorie->libelle }}</span>
                                </li>
                                <li>
                                    <span class="info-label"><i class="fas fa-money-bill-wave me-2"></i> Coût :</span>
                                    <span class="info-value">{{ $service->cout > 0 ? number_format($service->cout, 0, ',', ' ').' FCFA' : 'Gratuit' }}</span>
                                </li>

                                <li>
                                    <span class="info-label"><i class="fas fa-map-marker-alt me-2"></i> Lieu :</span>
                                    <span class="info-value">Mairie de Banikoara</span>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <!-- Bouton retour -->
                    <a href="{{ route('mespages.nosservices') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left me-2"></i> Retour aux services
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Services similaires -->
    @if($servicesSimilaires->count() > 0)
    <section class="similar-services">
        <div class="container">
            <h2 class="similar-title">Services similaires</h2>
            <div class="row">
                @foreach($servicesSimilaires as $serviceSimilaire)
                <div class="col-md-4">
                    <div class="similar-card">
                        @if($serviceSimilaire->image)
                        <img src="{{ asset('uploads/services/'.$serviceSimilaire->image) }}"
                             class="similar-card-img"
                             alt="{{ $serviceSimilaire->titre }}">
                        @else
                        <div class="similar-card-img bg-light d-flex align-items-center justify-content-center">
                            <i class="fas fa-building fa-3x text-muted"></i>
                        </div>
                        @endif
                        <div class="similar-card-body">
                            <h3 class="similar-card-title">{{ $serviceSimilaire->titre }}</h3>
                            <p class="similar-card-text">{{ Str::limit($serviceSimilaire->description, 100) }}</p>
                            <a href="{{ route('services.detail', $serviceSimilaire->id) }}" class="similar-card-link">
                                Voir détails <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <div style="display: flex; width: 100%;">
        <div style="height: 5px; background-color: #008000; flex: 1;"></div>
        <div style="height: 5px; background-color: #ffd700; flex: 1;"></div>
        <div style="height: 5px; background-color: #ff0000; flex: 1;"></div>
    </div>
    <footer style="background-color: #0d1b2a; color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
        <!-- Contenu du footer -->
        <div style="width: 90%; max-width: 1200px; margin: 0 auto; padding: 20px 0;">
            <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">

                <!-- Logo et mention mairie -->
                <div style="width: 23%; min-width: 180px; margin-bottom: 15px; text-align: left;">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Mairie de Banikoara" style="width: 80px; height: auto; margin-bottom: 10px;">
                    <p>Mairie de Banikoara<br>République du Bénin</p>
                </div>

                <!-- Liens utiles -->
                <div style="width: 23%; min-width: 180px; margin-bottom: 15px; text-align: left;">
                    <h4 style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Lien utiles</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li><a href="https://decentralisation.gouv.bj/" style="color: #ffffff; text-decoration: none;">-  MDGL</a></li>
                        <li><a href="https://www.ancb.bj/" style="color: #ffffff; text-decoration: none;">-  ANCB</a></li>
                        <li><a href="https://www.apida-benin.org/" style="color: #ffffff; text-decoration: none;">-  APIDA</a></li>
                    </ul>
                </div>

                <!-- Adresse et contact -->
                <div style="width: 23%; min-width: 180px; margin-bottom: 15px; text-align: left;">
                    <h4 style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Adresse & Contact</h4>
                    <p>Rep. Bénin, Banikoara<br>Téléphone : <strong>+229 0143862020</strong></p>
                </div>

                <!-- Suivez-nous -->
                <div style="width: 23%; min-width: 180px; margin-bottom: 15px; text-align: left;">
                    <h4 style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Suivez-nous</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li>
                            <a href="https://facebook.com/mairiedebanikoara" style="color: #ffffff; text-decoration: none; display: flex; align-items: center;">
                                <i class="fab fa-facebook" style="margin-right: 5px;"></i> Facebook
                            </a>
                        </li>
                        <li>
                            <a href="#" style="color: #ffffff; text-decoration: none; display: flex; align-items: center;">
                                <i class="fab fa-whatsapp" style="margin-right: 5px;"></i> Whatsapp
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Mention copyright -->
            <div style="text-align: center; margin-top: 15px; padding-top: 10px; border-top: 1px solid #ffffff33;">
                <p>© 2025 Mairie de la Ville de Banikoara. Tous droits réservés. Réalisé par
                    <a href="https://gajentreprise.com" target="_blank" style="color: #1abc9c; text-decoration: none; font-weight: bold;">ROYAS</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation au survol des cartes similaires
        document.querySelectorAll('.similar-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>
