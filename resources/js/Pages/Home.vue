<script setup>
    import { ref, computed } from 'vue'
    import { Link, usePage } from '@inertiajs/vue3'
    import PublicLayout from '@/Layouts/PublicLayout.vue'
    import { MapPin, Users, Building2, Phone, Eye, Download, Wheat, Calendars, Dumbbell, File, Newspaper, Settings, Wrench, TreePine, ArrowRight, Calendar, DollarSign, HomeIcon } from 'lucide-vue-next'
    import SectionTitle from '@/Components/SectionTitle.vue'
    import PostCard from '@/Components/PostCard.vue'
    import Icone from '@/Components/Icone.vue'
    import FlashNews from '@/Components/FlashNews.vue'

    const page = usePage();

    const stats = [
        {
            icon: Users,
            label: "Habitants",
            value: "246 575",
            color: "text-green-700",
            bg: "bg-green-50",
        },
        {
            icon: MapPin,
            label: "Arrondissements",
            value: "10",
            color: "text-green-800",
            bg: "bg-green-100",
        },
        {
            icon: Building2,
            label: "Villages & quartiers",
            value: "112",
            color: "text-green-600",
            bg: "bg-green-50",
        },
        {
            icon: Wheat,
            label: "Superficie (km²)",
            value: "4 383",
            color: "text-emerald-700",
            bg: "bg-emerald-50",
        },
    ];

    const props = defineProps({
        posts: { type: Array, default: () => [] },
        services: { type: Array, default: () => [] },
        projets: { type: Array, default: () => [] },
        documents: { type: Array, default: () => [] },
        events: { type: Array, default: () => [] },
    })

    const dates = [
        {
            annee: 'XVIIIe s.',
            label: 'Fondation',
        },
        {
            annee: '1960',
            label: 'Indépendance',
        },
        {
            annee: '2003',
            label: 'Décentralisation',
        },
        {
            annee: '2026',
            label: "Aujourd'hui",
        },
    ]

    const partenaires = [
        {
            nom: "PNUD",
            logo: "/front/images/partenaires/pnud.png",
            site: "https://www.undp.org"
        },
        {
            nom: "AFD",
            logo: "/front/images/partenaires/afd.png",
            site: "https://www.afd.fr"
        },
        {
            nom: "UNICEF",
            logo: "/front/images/partenaires/unicef.png",
            site: "https://www.unicef.org"
        },
        {
            nom: "OMS",
            logo: "/front/images/partenaires/oms.png",
            site: "https://www.who.int"
        },
    ];

</script>

<template>

    <FlashNews :flashs="page.props.flashs" />

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
                        <MapPin class="w-5 h-5" /> Département de l'Alibori — Bénin
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

        <section id="stats" class="border-b border-gray-100 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

                <div class="grid grid-cols-2 gap-6 lg:grid-cols-4">

                    <div
                        v-for="stat in stats"
                        :key="stat.label"
                        class="flex items-center gap-3"
                    >

                        <!-- Icône -->
                        <div
                            :class="[stat.color, stat.bg]"
                            class="rounded-lg p-2.5"
                        >
                            <component
                                :is="stat.icon"
                                class="h-10 w-10"
                            />
                        </div>

                        <!-- Informations -->
                        <div>
                            <p class="text-xl font-bold text-gray-900">
                                {{ stat.value }}
                            </p>

                            <p class="text-base text-gray-500">
                                {{ stat.label }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <section class="py-16 bg-gray-50" id="actualite">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <SectionTitle
                        title="Dernières Actualités"
                        :icon="Newspaper"
                        link-text="Toutes les actualités"
                        link-href="/actualites"
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <PostCard v-for="(post, i) in props.posts" :key="i" :post="post" />

                </div>
            </div>
        </section>

        <section class="py-14 bg-green-950 border-t border-gray-100 text-white" id="event">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- En-tête -->
                <div class="text-center mb-10">
                    <p class="text-5xl font-bold text-white-900 uppercase tracking-widest mb-2">
                        Evenements à venir
                    </p>
                    
                </div>

                <!-- Liste des documents -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div
                        v-for="(event, index) in props.events"
                        :key="event.id ?? index"
                        class="group bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-green-200 transition-all duration-300 flex flex-col"
                    >

                        <!-- Image PDF -->
                        <div class="relative bg-gray-100 h-48 overflow-hidden">
                            <img
                                :src="`/${event.image}`"
                                :alt="event.titre"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            />

                            <!-- Overlay léger -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>

                        <!-- Catégorie séparée de l'image -->
                        <div class="px-5 pt-4">
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full
                                    bg-green-50 text-green-700 border border-green-100
                                    text-xs font-semibold"
                            >
                                {{ event.status }}
                            </span>
                        </div>

                        <!-- Contenu -->
                        <div class="px-5 pt-3 pb-5 flex flex-col flex-1">

                            <!-- Date -->
                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                                <Calendar
                                    :size="17"
                                    class="text-green-700 flex-shrink-0"
                                />

                                <span class="font-medium">
                                    {{ event.date }}
                                </span>
                            </div>

                            <!-- Titre -->
                            <h3
                                class="font-bold text-gray-900 text-base leading-snug
                                    line-clamp-2 min-h-[3rem] mb-5"
                            >
                                {{ event.titre }}
                            </h3>

                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section class="py-16 bg-white" id="service">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <SectionTitle
                        title="Nos Services"
                        :icon="Settings"
                        link-text="Voir nos services"
                        link-href="/services"
                    />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    <div v-for="(service, i) in props.services" :key="i" :service="service">
                        <Link class="flex flex-col items-center text-center bg-gray-50 border border-gray-200 rounded-xl p-6 hover:border-green-300 hover:bg-green-50 transition-all group">
                            <div class="w-12 h-12 bg-green-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-800 transition-colors">
                                <Icone
                                    :icon="service.icone"
                                    :size="22"
                                    class="text-white"
                                />
                            </div>
                            <h3 class="text-base font-semibold text-gray-900 mb-1 group-hover:text-green-800">
                                {{ service.libelle }}
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed">
                                {{ service.desc }}
                            </p>
                        </Link>
                    </div>
                </div>

            </div>
        </section>

        <section class="relative overflow-hidden bg-green-950 py-20 text-white" id="historique">

            <div
                data-aos="fade-down"
                class="absolute left-10 top-10 h-32 w-32 rounded-full border border-green-700 opacity-20"
            ></div>

            <div
                data-aos="fade-up"
                class="absolute bottom-10 right-10 h-48 w-48 rounded-full border border-green-600 opacity-10"
            ></div>

            <div
                data-aos="fade-left"
                class="absolute right-20 top-1/2 h-8 w-8 rounded-lg bg-green-600 opacity-20"
            ></div>

            <div
                data-aos="zoom-in"
                class="absolute right-1/3 top-20 h-10 w-10 rotate-45 bg-green-500 opacity-10"
            ></div>

            <div
                data-aos="fade-up"
                class="absolute bottom-20 left-1/4 h-4 w-4 rounded-full bg-green-400 opacity-20"
            ></div>

            <div
                data-aos="zoom-in"
                class="absolute inset-0 m-auto h-96 w-96 rounded-full border-2 border-green-400 opacity-10"
            ></div>


            <!-- Contenu principal -->

            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="grid grid-cols-1 items-center gap-16 lg:grid-cols-2">

                    <!-- Colonne gauche -->

                    <div>

                        <!-- Badge -->

                        <div
                            data-aos="fade-right"
                            data-aos-duration="600"
                            class="mb-6 flex items-center gap-3"
                        >
                            <div class="h-px w-10 bg-green-400"></div>

                            <span
                                class="text-xs font-semibold uppercase tracking-widest text-green-400"
                            >
                                Depuis le XVIIIe siècle
                            </span>
                        </div>


                        <!-- Titre -->

                        <h2
                            data-aos="fade-up"
                            data-aos-delay="100"
                            data-aos-duration="600"
                            class="mb-6 text-4xl font-bold leading-tight lg:text-5xl"
                        >
                            Une commune aux
                            <span class="text-green-400">
                                racines
                            </span>
                            profondes
                        </h2>


                        <!-- Premier paragraphe -->

                        <p
                            data-aos="fade-up"
                            data-aos-delay="200"
                            data-aos-duration="600"
                            class="mb-4 text-sm leading-relaxed text-green-100 lg:text-base"
                        >
                            Fondée au XVIIIe siècle par des groupes Baatombu venus
                            du royaume de Nikki, Banikoara — « grand village des
                            Baatombu » — s'est imposée comme un carrefour stratégique
                            des anciennes routes commerciales ouest-africaines.
                        </p>


                        <!-- Deuxième paragraphe -->

                        <p
                            data-aos="fade-up"
                            data-aos-delay="300"
                            data-aos-duration="600"
                            class="mb-8 text-sm leading-relaxed text-green-200 lg:text-base"
                        >
                            De l'ère précoloniale à la décentralisation de 2003,
                            la commune a traversé l'histoire du Bénin en conservant
                            son identité culturelle unique, portée par les tambours
                            sacrés, les cavaliers enturbannés et les griots Ganku
                            et Barobu.
                        </p>


                        <!-- Dates clés -->

                        <div
                            data-aos="fade-up"
                            data-aos-delay="400"
                            data-aos-duration="600"
                            class="mb-10 flex flex-wrap gap-3"
                        >

                            <div
                                v-for="item in dates"
                                :key="item.annee"
                                class="rounded-xl border border-green-700 bg-green-800 px-4 py-2 text-center"
                            >
                                <p class="text-sm font-bold text-green-300">
                                    {{ item.annee }}
                                </p>

                                <p class="text-xs text-green-500">
                                    {{ item.label }}
                                </p>
                            </div>

                        </div>


                        <!-- Bouton -->

                        <div
                            data-aos="fade-up"
                            data-aos-delay="500"
                            data-aos-duration="600"
                        >
                            <Link
                                href="/commune/histoire"
                                class="inline-flex items-center gap-2 rounded-xl bg-green-500 px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-green-400"
                            >
                                Histoire complète

                                <ArrowRight :size="16" />
                            </Link>
                        </div>

                    </div>


                    <!-- Colonne droite -->

                    <div
                        data-aos="fade-left"
                        data-aos-duration="700"
                        class="relative hidden lg:block"
                    >

                        <!-- Cadre décoratif -->

                        <div
                            class="absolute -right-6 -top-6 h-full w-full rounded-2xl border-2 border-green-600 opacity-30"
                        ></div>


                        <!-- Image -->

                        <div class="relative overflow-hidden rounded-2xl">

                            <img
                                src="/front/images/mairie/histoire.png"
                                alt="Histoire de Banikoara"
                                class="h-96 w-full object-cover"
                            />

                            <!-- Overlay -->

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-green-950/80 via-transparent to-transparent"
                            ></div>


                            <!-- Citation -->

                            <div
                                data-aos="fade-up"
                                data-aos-delay="500"
                                class="absolute bottom-6 left-6 right-6 rounded-xl border border-green-700 bg-green-900/80 p-4 backdrop-blur-sm"
                            >
                                <p
                                    class="mb-1 text-xs font-medium uppercase tracking-wider text-green-300"
                                >
                                    Patrimoine culturel
                                </p>

                                <p class="text-sm leading-relaxed text-white">
                                    "Banikoara, cœur de l'aire culturelle Baatonou —
                                    terre de tradition et de courage."
                                </p>
                            </div>

                        </div>


                        <!-- Badge haut gauche -->

                        <div
                            data-aos="fade-down"
                            data-aos-delay="300"
                            class="absolute -left-4 -top-4 rounded-xl border border-green-600 bg-green-700 px-4 py-2 text-white shadow-lg"
                        >
                            <p class="text-xs font-bold">
                                + de 300 ans
                            </p>

                            <p class="text-xs text-green-300">
                                d'histoire
                            </p>
                        </div>


                        <!-- Badge bas droite -->

                        <div
                            data-aos="fade-up"
                            data-aos-delay="500"
                            class="absolute -bottom-4 -right-4 rounded-xl border border-green-700 bg-green-800 px-4 py-2 text-white shadow-lg"
                        >
                            <p class="text-xs font-bold">
                                246 575
                            </p>

                            <p class="text-xs text-green-300">
                                habitants
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="py-16 bg-white" id="projets">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <SectionTitle
                        title="Projets & Réalisations"
                        :icon="Wrench"
                        link-text="Tout les projets"
                        link-href="/services"
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div v-for="(projet, index) in props.projets" :key="index" class="bg-green-100 border border-gray-200 rounded-xl overflow-hidden hover:border-green-300 hover:shadow-lg transition-all">

                        <div class="relative overflow-hidden">
                            <img :src="projet.image" :alt="projet.titre"
                                class="w-full h-44 object-cover hover:scale-105 transition-transform duration-500"
                            />
                        </div>


                        <div class="p-5">
                            <span class="text-xs text-green-700 font-medium bg-green-50 px-2 py-1 rounded-lg">
                                {{ projet.category }}
                            </span>
                            <h3 class="font-semibold text-gray-900 mt-2 mb-2 leading-snug">{{ projet.titre }}</h3>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-14 bg-green-950 border-t border-gray-100 text-white" id="partenaires">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="text-center mb-10">
                    <p class="text-5xl font-bold text-white-900 uppercase tracking-widest mb-2">
                        Nos partenaires
                    </p>
                    <h2 class="text-xs font-semibold uppercase tracking-widest text-green-400">
                        Ils accompagnent le développement de Banikoara
                    </h2>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                    <a v-for="(item,index) in partenaires" :key="item.name" class="bg-white border border-gray-200 rounded-xl p-6 flex items-center justify-center hover:border-green-300 hover:shadow-md transition-all">
                        <img :src=item.logo :alt=item.nom
                            class="h-12 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300"
                        />
                    </a>
                </div>
            </div>
        </section>

        <section class="py-16 bg-gray-50" id="documents">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- En-tête -->
                <div class="flex items-center justify-between mb-10">
                    <SectionTitle
                        title="Avis & Communiqués"
                        :icon="File"
                        link-text="Tous les documents"
                        link-href="/documents"
                    />
                </div>

                <!-- Liste des documents -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div
                        v-for="(document, index) in props.documents"
                        :key="document.id ?? index"
                        class="group bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-green-200 transition-all duration-300 flex flex-col"
                    >

                        <!-- Image PDF -->
                        <div class="relative bg-gray-100 h-48 overflow-hidden">
                            <img
                                src="/front/images/image_pdf.png"
                                :alt="document.titre"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            />

                            <!-- Overlay léger -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>

                        <!-- Catégorie séparée de l'image -->
                        <div class="px-5 pt-4">
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full
                                    bg-green-50 text-green-700 border border-green-100
                                    text-xs font-semibold"
                            >
                                {{ document.category }}
                            </span>
                        </div>

                        <!-- Contenu -->
                        <div class="px-5 pt-3 pb-5 flex flex-col flex-1">

                            <!-- Date -->
                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                                <Calendar
                                    :size="17"
                                    class="text-green-700 flex-shrink-0"
                                />

                                <span class="font-medium">
                                    {{ document.date }}
                                </span>
                            </div>

                            <!-- Titre -->
                            <h3
                                class="font-bold text-gray-900 text-base leading-snug
                                    line-clamp-2 min-h-[3rem] mb-5"
                            >
                                {{ document.titre }}
                            </h3>

                            <!-- Boutons -->
                            <div class="grid grid-cols-2 gap-3 mt-auto">

                                <!-- Lire -->
                                <a
                                    :href="`/${document.fichier}`"
                                    target="_blank"
                                    class="flex items-center justify-center gap-2
                                        px-3 py-2.5 rounded-lg
                                        border border-green-600
                                        text-green-700
                                        text-sm font-semibold
                                        hover:bg-green-50
                                        transition-colors"
                                >
                                    <Eye :size="17" />
                                    <span>Lire</span>
                                </a>

                                <!-- Télécharger -->
                                <a
                                    :href="`/${document.fichier}`"
                                    download
                                    class="flex items-center justify-center gap-2
                                        px-3 py-2.5 rounded-lg
                                        bg-green-700
                                        text-white
                                        text-sm font-semibold
                                        hover:bg-green-800
                                        transition-colors"
                                >
                                    <Download :size="17" />
                                    <span>Télécharger</span>
                                </a>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section class="bg-green-800 text-white py-14">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <motion.div
                    :variants="fadeUp"
                    initial="hidden"
                    whileInView="visible"
                    :viewport="{ once: true }"
                    class="flex flex-col sm:flex-row items-center justify-between gap-6"
                >

                    <!-- Informations -->
                    <div class="flex items-center gap-4">

                        <motion.div
                            :animate="{ scale: [1, 1.1, 1] }"
                            :transition="{
                                repeat: Infinity,
                                duration: 2,
                                ease: 'easeInOut'
                            }"
                            class="w-12 h-12 bg-green-700 rounded-full flex items-center justify-center"
                        >
                            <Phone :size="20" />
                        </motion.div>

                        <div>
                            <p class="font-semibold text-lg">
                                Besoin d'aide ?
                            </p>

                            <p class="text-green-200 text-sm">
                                Disponible du lundi au vendredi, 8h – 17h
                            </p>
                        </div>

                    </div>

                    <!-- Boutons -->
                    <div class="flex flex-wrap gap-3">

                        <!-- Téléphone -->
                        <a
                            href="tel:+22901438620"
                            class="border border-white text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-green-700 transition-colors"
                        >
                            +229 0143 8620
                        </a>

                        <!-- Requête -->
                        <Link
                            href="/citoyen/soumettre"
                            class="border border-green-400 text-white px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-green-700 transition-colors"
                        >
                            Envoyer une requête
                        </Link>

                    </div>

                </motion.div>

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
