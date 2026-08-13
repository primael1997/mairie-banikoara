<script setup>
    import { ref, computed } from 'vue'
    import { Link, usePage } from '@inertiajs/vue3'
    import PublicLayout from '@/Layouts/PublicLayout.vue'
</script>

<template>

    <PublicLayout>

        <section class="relative overflow-hidden text-white min-h-[600px]" id="home">

            <!-- Image -->
            <img
                src="/front/images/mairie/hero.png"
                alt="Mairie de Banikoara"
                class="absolute inset-0 h-full w-full object-cover"
            >

            <!-- Overlay -->
            <div class="absolute inset-0 bg-green-950/75"></div>

            <!-- Cercles décoratifs -->

            <div class="absolute left-10 top-10 h-32 w-32 rounded-full border border-green-700 opacity-20 animate-float"></div>

            <div class="absolute bottom-10 right-10 h-48 w-48 rounded-full border border-green-600 opacity-10 animate-float-slow"></div>

            <div class="absolute right-20 top-1/2 h-8 w-8 rounded-lg bg-green-600 opacity-20 animate-float"></div>

            <div class="absolute top-20 right-1/3 h-10 w-10 rotate-45 bg-green-500 opacity-10 animate-spin-slow"></div>

            <div class="absolute bottom-20 left-1/4 h-4 w-4 rounded-full bg-green-400 opacity-20 animate-float"></div>

            <div class="absolute inset-0 m-auto h-96 w-96 rounded-full border-2 border-red-900 opacity-10 animate-pulse-slow"></div>

            <!-- Contenu -->

            <div class="relative mx-auto flex min-h-[600px] max-w-7xl items-center px-6">

                <div class="max-w-3xl">

                    <!-- Badge -->

                    <span
                        class="mb-6 inline-flex items-center gap-2 rounded-full bg-green-700 px-4 py-2 text-sm font-medium text-green-100"
                    >
                        Département de l'Alibori — Bénin
                    </span>

                    <!-- Titre -->

                    <h1
                        class="mt-6 text-5xl font-extrabold leading-tight lg:text-6xl"
                    >
                        Bienvenue à la

                        <span class="block text-green-300">
                            Mairie de Banikoara
                        </span>
                    </h1>

                    <!-- Description -->

                    <p
                        class="mt-8 max-w-2xl text-lg leading-8 text-green-100"
                    >
                        Portail officiel de la Commune de Banikoara.
                        Retrouvez les actualités, les services administratifs,
                        les démarches en ligne et toutes les informations utiles
                        concernant votre commune.
                    </p>

                    <!-- Boutons -->

                    <div class="mt-10 flex flex-wrap gap-4">

                        <Link
                            href="/services"
                            class="rounded-lg bg-green-700 px-6 py-3 font-semibold transition hover:bg-green-600"
                        >
                            Nos services →
                        </Link>

                        <Link
                            href="/citoyen/soumettre"
                            class="rounded-lg border border-green-400 px-6 py-3 font-semibold transition hover:bg-white/10"
                        >
                            Soumettre une requête
                        </Link>

                    </div>

                </div>

            </div>

        </section>
    
    </PublicLayout>

</template>

<style scoped>
        @keyframes float {
            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-slow {
            animation: float 9s ease-in-out infinite;
        }

        @keyframes pulseSlow {
            0%,
            100% {
                transform: scale(1);
                opacity: .08;
            }

            50% {
                transform: scale(1.05);
                opacity: .15;
            }
        }

        .animate-pulse-slow {
            animation: pulseSlow 8s ease-in-out infinite;
        }

        @keyframes spinSlow {
            from {
                transform: rotate(45deg);
            }

            to {
                transform: rotate(405deg);
            }
        }

        .animate-spin-slow {
            animation: spinSlow 18s linear infinite;
        }
    </style>
