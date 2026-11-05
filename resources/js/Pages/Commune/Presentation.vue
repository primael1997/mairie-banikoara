<!--
  Presentation.vue
  Page de présentation générale de la commune de Banikoara.
  Animations au scroll sur chaque section.
  Toutes les couleurs en vert institutionnel.
  Route Inertia : /commune/presentation
-->
<script setup>
    import { Link } from "@inertiajs/vue3";
    import { motion } from "motion-v";
    import { MapPin, Users, Wheat, TreePine, ArrowRight } from "lucide-vue-next";
    import BreadCrumb from '@/Components/BreadCrumb.vue';
    import PublicLayout from '@/Layouts/PublicLayout.vue'

    // Variants d'animation réutilisables
    const fadeUp = {
        hidden: { opacity: 0, y: 30 },
        visible: (delay = 0) => ({
            opacity: 1,
            y: 0,
            transition: { duration: 0.5, delay, ease: [0.25, 0.1, 0.25, 1] },
        }),
    };

    const fadeIn = {
        hidden: { opacity: 0 },
        visible: (delay = 0) => ({
            opacity: 1,
            transition: { duration: 0.6, delay, ease: [0.25, 0.1, 0.25, 1] },
        }),
    };

    const slideLeft = {
        hidden: { opacity: 0, x: -40 },
        visible: (delay = 0) => ({
            opacity: 1,
            x: 0,
            transition: { duration: 0.5, delay, ease: [0.25, 0.1, 0.25, 1] },
        }),
    };

    const stats = [
        {
            icon: Users,
            label: "Population",
            value: "246 575 hab.",
            color: "text-green-700",
            bg: "bg-green-50",
        },
        {
            icon: MapPin,
            label: "Superficie",
            value: "4 383 km²",
            color: "text-green-800",
            bg: "bg-green-100",
        },
        {
            icon: Wheat,
            label: "Culture principale",
            value: "Coton",
            color: "text-emerald-700",
            bg: "bg-emerald-50",
        },
        {
            icon: TreePine,
            label: "Arrondissements",
            value: "10",
            color: "text-green-600",
            bg: "bg-green-50",
        },
    ];

    const sections = [
        {
            titre: "Géographie",
            contenu:
                "Banikoara est une commune située au nord du Bénin dans le département de l'Alibori. Elle est bordée au nord par le Burkina Faso, à l'est par la commune de Kandi et à l'ouest par celle de Kérou.",
        },
        {
            titre: "Économie",
            contenu:
                "Surnommée « capitale du coton », Banikoara est le premier producteur de coton du Bénin. L'agriculture constitue la principale activité économique, avec également l'élevage et le commerce transfrontalier.",
        },
        {
            titre: "Culture",
            contenu:
                "La commune est peuplée majoritairement de Baatombu (Bariba) et de Peuls. Elle possède un riche patrimoine culturel avec des fêtes traditionnelles, des danses et une gastronomie locale unique.",
        },
        {
            titre: "Administration",
            contenu:
                "La commune est découpée en 10 arrondissements couvrant plus de 100 villages et quartiers de ville. Elle est administrée par un conseil communal élu et un maire à sa tête depuis 2020.",
        },
    ];

    const liens = [
        { label: "Histoire", to: "/commune/histoire" },
        { label: "Arrondissements", to: "/commune/arrondissements" },
        { label: "Partenaires", to: "/commune/partenaires" },
    ];

    const breadcrumbItems = [
        {
            label: 'Commune',
        },
        {
            label: 'Présentation',
        },
    ]
</script>

<template>
    <PublicLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <!-- Fil d'Ariane -->
            <BreadCrumb
                :items="breadcrumbItems"
            />

            <!-- En-tête animé -->
            <motion.div :variants="slideLeft" initial="hidden" animate="visible" class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    Présentation de la commune
                </h1>
                <p class="text-gray-500">
                    Banikoara, pôle agricole du nord Bénin, département de l'Alibori.
                </p>
            </motion.div>

            <!-- Image animée -->
            <motion.div :variants="fadeIn" initial="hidden" animate="visible" :custom="0.2"
                class="relative overflow-hidden rounded-2xl mb-10">
                <img src="/front/images/mairie/presentation.jpg" alt="Vue de Banikoara" class="w-full h-52 object-cover" />
                <!-- Overlay vert en bas de l'image -->
                <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-green-950/60 to-transparent" />
                <motion.span :variants="fadeUp" initial="hidden" animate="visible" :custom="0.4"
                    class="absolute bottom-4 left-6 text-white font-semibold text-lg">
                    Banikoara — Alibori, Bénin
                </motion.span>
            </motion.div>

            <!-- Statistiques animées avec délai décalé -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-14">
                <motion.div v-for="(stat, index) in stats" :key="stat.label" :variants="fadeUp" initial="hidden"
                    whileInView="visible" :viewport="{ once: true }" :custom="index * 0.1"
                    :whileHover="{ y: -4, transition: { duration: 0.2 } }"
                    class="bg-white border border-gray-200 rounded-xl p-5 flex items-center gap-4 hover:border-green-300 hover:shadow-md transition-all">
                    <div :class="[stat.bg, stat.color, 'p-3 rounded-lg']">
                        <component :is="stat.icon" :size="22" />
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">{{ stat.value }}</p>
                        <p class="text-xs text-gray-500">{{ stat.label }}</p>
                    </div>
                </motion.div>
            </div>

            <!-- Sections textuelles animées -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-14">
                <motion.div v-for="(section, index) in sections" :key="section.titre" :variants="fadeUp" initial="hidden"
                    whileInView="visible" :viewport="{ once: true }" :custom="index * 0.15"
                    class="bg-white border border-gray-200 rounded-xl p-6 hover:border-green-300 hover:shadow-md transition-all">
                    <!-- Barre verte décorative -->
                    <div class="w-10 h-1 bg-green-700 rounded-full mb-3" />
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">
                        {{ section.titre }}
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        {{ section.contenu }}
                    </p>
                </motion.div>
            </div>

            <!-- Liens vers les autres pages de la rubrique -->
            <motion.div :variants="fadeUp" initial="hidden" whileInView="visible" :viewport="{ once: true }"
                class="bg-green-700 rounded-2xl p-8 text-white">
                <h3 class="text-lg font-semibold mb-4">Explorer la commune</h3>
                <div class="flex flex-wrap gap-3">
                    <Link v-for="lien in liens" :key="lien.to" :href="lien.to"
                        class="inline-flex items-center gap-2 bg-green-600 text-white border border-green-400 px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-500 transition-colors">
                        {{ lien.label }}
                        <ArrowRight :size="14" />
                    </Link>
                </div>
            </motion.div>
        </div>
    </PublicLayout>
</template>
