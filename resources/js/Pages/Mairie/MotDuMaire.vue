<!--
  MotDuMaire.vue
  Page du mot du maire avec photo, message officiel et vision.
  Route Inertia : /mairie/mot-du-maire
-->
<script setup>
    import { Link } from "@inertiajs/vue3";
    import { motion } from "motion-v";
    import { Quote, ArrowRight } from "lucide-vue-next";
    import BreadCrumb from '@/Components/BreadCrumb.vue'
    import PublicLayout from '@/Layouts/PublicLayout.vue'

    const props = defineProps({
        mot: {
            type: Object,
            default: () => null,
        },
    });

    const breadcrumbItems = [
        {
            label: 'Mot du Maire',
        },
    ]

    // Axes prioritaires du mandat du maire
    const priorites = [
        { numero: "01", titre: "Agriculture & développement rural", desc: "Soutien aux producteurs de coton et diversification agricole." },
        { numero: "02", titre: "Infrastructure & mobilité", desc: "Réhabilitation des routes et désenclavement des villages." },
        { numero: "03", titre: "Éducation & jeunesse", desc: "Construction d'écoles et appui à la formation professionnelle." },
        { numero: "04", titre: "Santé publique", desc: "Renforcement des centres de santé et accès aux soins." },
        { numero: "05", titre: "Gouvernance & transparence", desc: "Reddition de comptes et participation citoyenne active." },
    ];

    const fadeUp = {
        hidden: { opacity: 0, y: 30 },
        visible: (delay = 0) => ({
            opacity: 1,
            y: 0,
            transition: { duration: 0.5, delay, ease: [0.25, 0.1, 0.25, 1] },
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

    const slideRight = {
        hidden: { opacity: 0, x: 40 },
        visible: (delay = 0) => ({
            opacity: 1,
            x: 0,
            transition: { duration: 0.5, delay, ease: [0.25, 0.1, 0.25, 1] },
        }),
    };
</script>

<template>
    <PublicLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <BreadCrumb
                    :items="breadcrumbItems"
                />

            <!-- En-tête -->
            <motion.div :variants="slideLeft" initial="hidden" animate="visible" class="mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Mot du maire</h1>
            <p class="text-gray-500">Message officiel de Son Excellence le Maire de Banikoara.</p>
            </motion.div>

            <!-- Section principale — photo + message -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-16">
            <!-- Photo du maire -->
            <motion.div
                :variants="slideLeft"
                initial="hidden"
                animate="visible"
                :custom="0.2"
                class="lg:col-span-1"
            >
                <div class="relative">
                <!-- Cadre décoratif vert derrière la photo -->
                <div class="absolute -top-3 -left-3 w-full h-full bg-green-700 rounded-2xl" />
                <img
                    :src="`/${mot?.photo}`"
                    alt="Bio Sarako TAMOU — Maire de Banikoara"
                    class="relative w-full aspect-[3/4] object-cover rounded-2xl border-4 border-white shadow-xl"
                />
                <!-- Badge nom -->
                <div class="absolute bottom-4 left-4 right-4 bg-green-800/90 backdrop-blur-sm rounded-xl p-3 text-white">
                    <p class="font-bold text-sm">{{ mot?.nom }}</p>
                    <p class="text-green-200 text-xs">{{ mot?.titre }}</p>
                    <p class="text-green-300 text-xs">En fonction en février 2026</p>
                </div>
                </div>
            </motion.div>

            <!-- Message du maire -->
            <motion.div
                :variants="slideRight"
                initial="hidden"
                animate="visible"
                :custom="0.3"
                class="lg:col-span-2 flex flex-col justify-center"
            >
                <!-- Icône quote -->
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                <Quote :size="24" class="text-green-700" />
                </div>

                <div class="space-y-4 text-gray-600 leading-relaxed mb-8">
                <div v-html="mot?.message_1" />

                <p class="font-semibold text-gray-900 mt-4">
                    Le {{ mot?.titre }},<br />
                    <span class="text-green-700 text-lg">{{ mot?.nom }}</span>
                </p>
                </div>
            </motion.div>
            </div>

            <!-- Axes prioritaires -->
            <motion.div
            :variants="fadeUp"
            initial="hidden"
            whileInView="visible"
            :viewport="{ once: true }"
            class="mb-6"
            >
            <div class="w-10 h-1 bg-green-700 rounded-full mb-3" />
            <h2 class="text-2xl font-bold text-gray-900">Axes prioritaires du mandat</h2>
            </motion.div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-14">
            <motion.div
                v-for="(p, index) in priorites"
                :key="p.numero"
                :variants="fadeUp"
                initial="hidden"
                whileInView="visible"
                :viewport="{ once: true }"
                :custom="index * 0.1"
                :whileHover="{ y: -4, transition: { duration: 0.2 } }"
                class="bg-white border border-gray-200 rounded-xl p-5 hover:border-green-400 hover:shadow-md transition-all"
            >
                <p class="text-3xl font-bold text-green-100 mb-2">{{ p.numero }}</p>
                <h3 class="font-semibold text-gray-900 mb-2">{{ p.titre }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed">{{ p.desc }}</p>
            </motion.div>
            </div>

            <!-- Lien vers les élus -->
            <motion.div
            :variants="fadeUp"
            initial="hidden"
            whileInView="visible"
            :viewport="{ once: true }"
            class="bg-green-700 rounded-2xl p-8 text-white flex flex-col sm:flex-row items-center justify-between gap-4"
            >
            <div>
                <p class="font-semibold text-lg mb-1">Découvrez toute l'équipe municipale</p>
                <p class="text-green-200 text-sm">Élus, adjoints et conseillers au service de Banikoara.</p>
            </div>
            <Link
                href="/mairie/elus"
                class="inline-flex items-center gap-2 bg-green-800 text-white-800 px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-green-600 transition-colors shrink-0"
            >
                Voir les élus <ArrowRight :size="16" />
            </Link>
            </motion.div>
        </div>
    </PublicLayout>
</template>
