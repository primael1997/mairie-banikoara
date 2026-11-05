<script setup>
    import { ref, computed } from "vue";
    import { motion } from "motion-v";
    import { Briefcase, ChevronRight, Mail } from "lucide-vue-next";
    import BreadCrumb from '@/Components/BreadCrumb.vue'
    import PublicLayout from '@/Layouts/PublicLayout.vue'

    const props = defineProps({
        secretariats: { type: Array, default: () => [] },
    });

    const executif = computed(() => props.secretariats[0] ?? null);
    const directions = computed(() => props.secretariats.slice(1));

    const breadcrumbItems = [
        {
            label: 'Mairie',
        },
        {
            label: 'Secrétariat Exécutif',
        },
    ]

    // Attributions du secrétaire exécutif
    const attributions = [
        "Coordination et supervision de l'ensemble des services administratifs",
        "Gestion des ressources humaines de la commune",
        "Délivrance des permis, autorisations et certificats administratifs",
        "Gestion et suivi des marchés publics communaux",
        "Préparation et exécution du budget communal",
        "Mise en œuvre des délibérations du conseil communal",
        "Représentation de la commune dans les actes de la vie civile",
    ];


</script>

<template>
    <PublicLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <BreadCrumb
                :items="breadcrumbItems"
            />

             <motion.div
                :variants="slideLeft"
                initial="hidden"
                animate="visible"
                class="mb-10"
            >
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-green-700 rounded-xl flex items-center justify-center">
                        <Briefcase :size="20" class="text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Secrétariat exécutif</h1>
                </div>
                <p class="text-gray-500">
                    Organe administratif central de la mairie de Banikoara.
                </p>
            </motion.div>

            <!-- Présentation du SE -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-14">
                <!-- Photo SE -->
                <motion.div
                    :variants="fadeUp"
                    initial="hidden"
                    animate="visible"
                    :custom="0.2"
                    class="lg:col-span-1"
                >
                    <div class="relative">
                        <div class="absolute -top-3 -left-3 w-full h-full bg-green-700 rounded-2xl" />
                        <img
                            :src="`/${executif?.photo}`"
                            alt="Secrétaire Exécutif"
                            class="relative w-full aspect-square object-cover rounded-2xl border-4 border-white shadow-xl"
                        />
                        <div class="absolute bottom-4 left-4 right-4 bg-green-800/90 rounded-xl p-3 text-white">
                            <p class="font-bold text-sm">{{ executif?.nom }}</p>
                            <p class="text-green-200 text-xs">{{ executif?.poste }}</p>
                        </div>
                    </div>
                </motion.div>

                <!-- Attributions -->
                <motion.div
                    :variants="fadeUp"
                    initial="hidden"
                    animate="visible"
                    :custom="0.3"
                    class="lg:col-span-2"
                >
                    <div class="w-10 h-1 bg-green-700 rounded-full mb-4" />
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Attributions</h2>
                    <ul class="space-y-3">
                        <motion.li
                            v-for="(attr, index) in attributions"
                            :key="index"
                            :variants="fadeUp"
                            initial="hidden"
                            whileInView="visible"
                            :viewport="{ once: true }"
                            :custom="index * 0.08"
                            class="flex items-start gap-3 text-sm text-gray-600"
                        >
                            <ChevronRight :size="16" class="text-green-600 mt-0.5 shrink-0" />
                            {{ attr }}
                        </motion.li>
                    </ul>

                    <!-- Contact -->
                    <div class="flex gap-4 mt-6 pt-6 border-t border-gray-100">
                        <a
                            :href="`mailto:${executif?.email}`"
                            class="flex items-center gap-2 text-sm text-green-700 hover:underline"
                        >
                            <Mail :size="14" />
                            {{ executif?.email }}
                        </a>
                    </div>
                </motion.div>
            </div>

            <!-- Directions rattachées -->
            <motion.div
                :variants="fadeUp"
                initial="hidden"
                whileInView="visible"
                :viewport="{ once: true }"
                class="mb-6"
            >

            <div class="w-10 h-1 bg-green-700 rounded-full mb-3" />
            <h2 class="text-2xl font-bold text-gray-900">Directions rattachées</h2>
        </motion.div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <motion.div
                v-for="(dir, index) in directions"
                :key="dir.nom"
                :variants="fadeUp"
                initial="hidden"
                whileInView="visible"
                :viewport="{ once: true }"
                :custom="index * 0.15"
                :whileHover="{ y: -4, transition: { duration: 0.2 } }"
                class="bg-white border border-gray-200 rounded-xl p-6 hover:border-green-400 hover:shadow-md transition-all"
            >

            <!-- Numéro décoratif -->
            <p class="text-5xl font-bold text-green-100 mb-3">
                0{{ index + 1 }}
            </p>
            <img
                :src="`/${dir.photo}`"
                alt="Secrétaire Exécutif"
                class="relative w-full aspect-square object-cover rounded-2xl border-4 border-white shadow-xl"
            />
            <h3 class="font-semibold text-gray-900 mb-2 mt-2">{{ dir.poste }}</h3>
            <p class="text-xs text-gray-500 mb-4">
                Responsable : {{ dir.nom }}
            </p>

            <a
                :href="`mailto:${dir.email}`"
                class="flex items-center gap-1.5 text-xs text-green-700 hover:underline"
                >
                <Mail :size="12" />
                {{ dir.email }}
            </a>
            </motion.div>
        </div>
        </div>
    </PublicLayout>
</template>
