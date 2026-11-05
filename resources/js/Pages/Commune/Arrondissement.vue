
<script setup>
    import { Link } from "@inertiajs/vue3";
    import { motion } from "motion-v";
    import { MapPin, Users, Trees, ArrowRight } from "lucide-vue-next";
    import BreadCrumb from '@/Components/BreadCrumb.vue';
    import PublicLayout from '@/Layouts/PublicLayout.vue'

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

    const arrondissements = [
        { id: "banikoara", nom: "Banikoara", chefLieu: "Banikoara", population: 45000, villages: 52 },
        { id: "founougo", nom: "Founougo", chefLieu: "Founougo", population: 28000, villages: 38 },
        { id: "gomparou", nom: "Gomparou", chefLieu: "Gomparou", population: 22000, villages: 30 },
        { id: "goumori", nom: "Goumori", chefLieu: "Goumori", population: 19000, villages: 28 },
        { id: "kokiborou", nom: "Kokiborou", chefLieu: "Kokiborou", population: 24000, villages: 35 },
        { id: "ounet", nom: "Ounet", chefLieu: "Ounet", population: 18000, villages: 25 },
        { id: "somperekou", nom: "Sompérékou", chefLieu: "Sompérékou", population: 27000, villages: 40 },
        { id: "soroko", nom: "Soroko", chefLieu: "Soroko", population: 21000, villages: 32 },
        { id: "toura", nom: "Toura", chefLieu: "Toura", population: 23000, villages: 36 },
        { id: "tokey", nom: "Tokey", chefLieu: "Tokey", population: 20000, villages: 29 },
    ];

    const breadcrumbItems = [
        {
            label: 'Commune',
        },
        {
            label: 'Arrondissements',
        },
    ]
</script>

<template>
    <PublicLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <BreadCrumb
                :items="breadcrumbItems"
            />

            <!-- En-tête -->
            <motion.div :variants="slideLeft" initial="hidden" animate="visible" class="mb-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-green-700 rounded-xl flex items-center justify-center">
                        <MapPin :size="20" class="text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Les arrondissements</h1>
                </div>
                <p class="text-gray-500">
                    La commune de Banikoara est divisée en 10 arrondissements.
                </p>
            </motion.div>

            <!-- Bannière statistiques stylisée -->
            <motion.div :variants="fadeUp" initial="hidden" animate="visible" :custom="0.2"
                class="relative overflow-hidden bg-green-800 rounded-2xl p-8 mb-10 text-white">
                <!-- Cercles décoratifs en arrière-plan -->
                <div class="absolute -top-10 -right-10 w-48 h-48 bg-green-700 rounded-full opacity-40" />
                <div class="absolute -bottom-10 -left-10 w-36 h-36 bg-green-600 rounded-full opacity-30" />
                <div class="absolute top-4 right-32 w-16 h-16 bg-green-500 rounded-full opacity-20" />

                <div class="relative grid grid-cols-1 sm:grid-cols-3 gap-8">
                    <!-- Stat 1 -->
                    <motion.div :initial="{ opacity: 0, y: 20 }" :animate="{ opacity: 1, y: 0 }"
                        :transition="{ delay: 0.3, duration: 0.5 }" class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 bg-green-600 rounded-2xl flex items-center justify-center mb-3">
                            <MapPin :size="24" class="text-white" />
                        </div>
                        <p class="text-5xl font-bold mb-1">10</p>
                        <p class="text-green-200 text-sm font-medium uppercase tracking-wider">
                            Arrondissements
                        </p>
                    </motion.div>

                    <!-- Séparateur vertical -->
                    <motion.div :initial="{ opacity: 0, y: 20 }" :animate="{ opacity: 1, y: 0 }"
                        :transition="{ delay: 0.4, duration: 0.5 }"
                        class="flex flex-col items-center text-center sm:border-x sm:border-green-600">

                        <div class="w-20 h-20 bg-green-600 rounded-2xl flex items-center justify-center mb-3">
                            <Trees :size="24" class="text-white" />
                        </div>
                        <p class="text-5xl font-bold mb-1">112</p>
                        <p class="text-green-200 text-sm font-medium uppercase tracking-wider">
                            Villages & quartiers
                        </p>
                    </motion.div>

                    <!-- Stat 3 -->
                    <motion.div :initial="{ opacity: 0, y: 20 }" :animate="{ opacity: 1, y: 0 }"
                        :transition="{ delay: 0.5, duration: 0.5 }" class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 bg-green-600 rounded-2xl flex items-center justify-center mb-3">
                            <Users :size="24" class="text-white" />
                        </div>
                        <p class="text-5xl font-bold mb-1">246 575</p>
                        <p class="text-green-200 text-sm font-medium uppercase tracking-wider">
                            Habitants
                        </p>
                    </motion.div>
                </div>
            </motion.div>

            <!-- Grille animée -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <motion.div v-for="(arr, index) in arrondissements" :key="arr.id" :variants="fadeUp" initial="hidden"
                    whileInView="visible" :viewport="{ once: true }" :custom="index * 0.08"
                    :whileHover="{ y: -6, transition: { duration: 0.2 } }">
                    <Link :href="`/commune/arrondissements/${arr.id}`"
                        class="block bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-green-400 hover:shadow-lg transition-all group">
                        <!-- Image -->
                        <div class="relative overflow-hidden">
                            <img :src="`/front/images/commune/arrondissements/${arr.id}.jpg`" :alt="arr.nom"
                                class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-500" />
                            <!-- Badge nom sur l'image -->
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-green-950/80 to-transparent p-4">
                                <p class="text-white font-semibold">{{ arr.nom }}</p>
                            </div>
                        </div>

                        <!-- Contenu -->
                        <div class="p-4">
                            <p class="text-xs text-gray-400 mb-3">
                                Chef-lieu : {{ arr.chefLieu }}
                            </p>
                            <div class="flex gap-4 text-sm text-gray-600">
                                <span class="flex items-center gap-1.5">
                                    <Users :size="13" class="text-green-600" />
                                    {{ arr.population.toLocaleString("fr-FR") }} hab.
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <Trees :size="13" class="text-green-600" />
                                    {{ arr.villages }} villages
                                </span>
                            </div>
                            <div class="mt-3 flex items-center gap-1 text-xs text-green-700 font-medium">
                                Voir la fiche
                                <ArrowRight :size="12" />
                            </div>
                        </div>
                    </Link>
                </motion.div>
            </div>
        </div>
    </PublicLayout>
</template>
