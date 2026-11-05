<script setup>
    import { ref, computed } from "vue";
    import { motion } from "motion-v"; 
    import { Users, Phone, Mail } from "lucide-vue-next";
    import BreadCrumb from '@/Components/BreadCrumb.vue'
    import PublicLayout from '@/Layouts/PublicLayout.vue'

    const breadcrumbItems = [
        {
            label: 'Mairie',
        },
        {
            label: 'Élus municipaux',
        },
    ]

    const props = defineProps({
        communals: { type: Array, default: () => [] },
        supervisions: { type: Array, default: () => [] },
        cabinets: { type: Array, default: () => [] },
        chefArr: { type: Array, default: () => [] },
    });

    // Onglets : filtrage CÔTÉ CLIENT sur la relation `entites` (chargée par
    // le contrôleur via with('entites')), sauf "arrondissement" qui filtre
    // sur le champ `poste`, comme le faisait chefArrondissement() côté API.
    const tabs = [
        { key: "communals", label: "Conseil communal" },
        { key: "supervisions", label: "Conseil de supervision" },
        { key: "chefArr", label: "Chefs d'arrondissement" },
        { key: "cabinets", label: "Cabinet du Maire" },
    ];

    const activeTab = ref(tabs[0].key);

    const filteredMembres = computed(() => props[activeTab.value] ?? []);

    const groupedData = computed(() => {
        return filteredMembres.value.reduce((acc, item) => {
            const niveau = item.niveau;
            if (!acc[niveau]) acc[niveau] = [];
            acc[niveau].push(item);
            return acc;
        }, {});
    });

    const niveaux = computed(() =>
        Object.keys(groupedData.value)
            .map(Number)
            .sort((a, b) => a - b)
    );

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
</script>

<template>
    <PublicLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <BreadCrumb
                :items="breadcrumbItems"
            />

                <!-- En-tête -->
                <motion.div
                    :variants="slideLeft"
                    initial="hidden"
                    animate="visible"
                    class="mb-10"
                >
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-green-700 rounded-xl flex items-center justify-center">
                            <Users :size="20" class="text-white" />
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900">Élus municipaux</h1>
                    </div>

                    <p class="text-gray-500">
                        Le conseil communal de Banikoara au service des citoyens.
                    </p>
                </motion.div>

                <!-- Filtres -->
                <motion.div
                    :variants="fadeUp"
                    initial="hidden"
                    animate="visible"
                    :custom="0.2"
                    class="flex flex-wrap gap-2 mb-8"
                >
                    <div class="flex gap-2 mb-6 flex-wrap">
                        <button
                            v-for="tab in tabs"
                            :key="tab.key"
                            @click="activeTab = tab.key"
                            :class="[
                                'px-4 py-2 rounded-lg',
                                activeTab === tab.key ? 'bg-green-700 text-white' : 'bg-gray-200',
                            ]"
                        >
                            {{ tab.label }}
                        </button>
                    </div>
                </motion.div>

                <!-- Grille des élus -->
                <div class="space-y-10">
                    <div
                        v-for="(niveau, index) in niveaux"
                        :key="niveau"
                        class="flex flex-col items-center"
                    >
                    <!-- Ligne des cartes -->
                    <div class="flex flex-wrap justify-center gap-6">
                        <motion.div
                            v-for="(elu, i) in groupedData[niveau]"
                            :key="elu.id"
                            :variants="fadeUp"
                            initial="hidden"
                            whileInView="visible"
                            :viewport="{ once: true }"
                            :custom="i * 0.1"
                            :whileHover="{ y: -5, transition: { duration: 0.2 } }"
                            class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-green-300 hover:shadow-lg transition-all w-64"
                        >
                            <!-- Photo -->
                            <div class="relative">
                                <img
                                    :src="`/${elu.photo}`"
                                    :alt="elu.nom"
                                    class="w-full h-56 object-cover object-top"
                                />
                            </div>

                            <!-- Infos -->
                            <div class="p-5">
                            <h3 class="font-bold text-gray-900 text-lg">
                                {{ elu.nom }}
                            </h3>

                            <p class="text-sm text-gray-500 mb-4">
                                {{ elu.poste }}
                            </p>

                            <!-- Contacts -->
                            <div
                                v-if="elu.telephone || elu.email"
                                class="space-y-2 border-t border-gray-100 pt-4"
                            >
                                <a
                                v-if="elu.telephone"
                                :href="`tel:${elu.telephone}`"
                                class="flex items-center gap-2 text-sm text-gray-600 hover:text-green-700"
                                >
                                <Phone :size="13" />
                                {{ elu.telephone }}
                                </a>
                                <a
                                v-if="elu.email"
                                :href="`mailto:${elu.email}`"
                                class="flex items-center gap-2 text-sm text-gray-600 hover:text-green-700"
                                >
                                <Mail :size="13" />
                                {{ elu.email }}
                                </a>
                            </div>
                            </div>
                        </motion.div>
                    </div>

                    <!-- Trait vertical entre niveaux -->
                    <div
                        v-if="index !== niveaux.length - 1"
                        class="w-px h-10 bg-gray-300 my-4"
                    ></div>
                </div>
            </div>
        </div>
  </PublicLayout>
</template>
