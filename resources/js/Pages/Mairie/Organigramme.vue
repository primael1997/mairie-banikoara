<!--
  Organigramme.vue
  Organigramme officiel de la mairie de Banikoara.
  Reproduit fidèlement la structure institutionnelle réelle.
  Route Inertia : /mairie/organigramme

  Composants "boîte" extraits dans ./organigramme/ (BoxVert, BoxVertClair,
  BoxRouge, BoxRougeListe, BoxGrise, LigneV). "Col" est trop trivial pour
  mériter son propre fichier : c'est juste un <div class="flex flex-col
  items-center gap-0">, inliné directement ci-dessous.
-->
<script setup>
    import { motion } from "motion-v";
    import { Network } from "lucide-vue-next";
    import BreadCrumb from '@/Components/BreadCrumb.vue'
    import BoxVert from "./organigramme/BoxVert.vue";
    import BoxVertClair from "./organigramme/BoxVertClair.vue";
    import BoxRouge from "./organigramme/BoxRouge.vue";
    import BoxRougeListe from "./organigramme/BoxRougeListe.vue";
    import BoxGrise from "./organigramme/BoxGrise.vue";
    import LigneV from "./organigramme/LigneV.vue";
    import PublicLayout from '@/Layouts/PublicLayout.vue'

    const breadcrumbItems = [
        {
            label: 'Organigramme',
        },
    ]

    const fadeUp = {
        hidden: { opacity: 0, y: 20 },
        visible: (delay = 0) => ({
            opacity: 1,
            y: 0,
            transition: { duration: 0.5, delay, ease: [0.25, 0.1, 0.25, 1] },
        }),
    };

    const legende = [
        { couleur: "bg-green-800 border-green-600", label: "Organes délibérants et direction" },
        { couleur: "bg-green-100 border-green-400", label: "Directions et services rattachés" },
        { couleur: "bg-red-200  border-red-400", label: "Services opérationnels" },
        { couleur: "bg-gray-200 border-gray-400", label: "Sous-services" },
    ];
</script>

<template>
    <PublicLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <BreadCrumb
                :items="breadcrumbItems"
            />

            <!-- En-tête -->
            <motion.div :variants="fadeUp" initial="hidden" animate="visible" class="mb-10">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-green-700 rounded-xl flex items-center justify-center">
                <Network :size="20" class="text-white" />
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Organigramme</h1>
            </div>
            <p class="text-gray-500">
                Structure institutionnelle officielle de la mairie de Banikoara.
            </p>
            </motion.div>

            <!-- Organigramme — scrollable horizontalement sur mobile -->
            <motion.div
            :variants="fadeUp"
            initial="hidden"
            animate="visible"
            :custom="0.2"
            class="bg-white border border-gray-200 rounded-2xl p-6 overflow-x-auto"
            >
            <div class="min-w-[900px]">
                <!-- NIVEAU 1 : CONSEIL COMMUNAL -->
                <div class="flex justify-center mb-0">
                <BoxVert label="CONSEIL COMMUNAL" />
                </div>
                <LigneV />

                <!-- NIVEAU 2 : CONSEIL DE SUPERVISION + COMMISSIONS -->
                <div class="flex justify-center items-start gap-16 mb-0">
                <div class="flex flex-col items-center gap-0">
                    <BoxVert label="CONSEIL DE SUPERVISION" />
                </div>
                <div class="flex flex-col items-center gap-0">
                    <div class="border-2 border-gray-400 rounded-full px-4 py-2">
                    <p class="text-xs font-semibold text-gray-600">COMMISSIONS</p>
                    <p class="text-xs font-semibold text-gray-600">PERMANENTES</p>
                    </div>
                </div>
                </div>

                <!-- Ligne vers MAIRE -->
                <div class="flex justify-center">
                <LigneV h="h-4" />
                </div>

                <!-- NIVEAU 3 : CLPSPD + MAIRE + ADJOINTS + CHEFS ARR. -->
                <div class="flex justify-center items-start gap-6 mb-0">
                <!-- CLPSPD à gauche -->
                <div class="flex flex-col items-center gap-0 mt-8">
                    <BoxVertClair label="CLPSPD" />
                </div>

                <!-- Centre — MAIRE -->
                <div class="flex flex-col items-center gap-0">
                    <BoxVert label="MAIRE" />
                    <LigneV />
                </div>

                <!-- ADJOINTS AU MAIRE -->
                <div class="flex flex-col items-center gap-0 mt-8">
                    <BoxVert label="ADJOINTS AU MAIRE" />
                </div>

                <!-- CHEFS D'ARRONDISSEMENTS -->
                <div class="flex flex-col items-center gap-0 mt-8">
                    <BoxVert label="CHEFS" sub="D'ARRONDISSEMENTS" />
                </div>
                </div>

                <!-- NIVEAU 4 : CHEF CABINET + SP/Maire + SE + Auditeurs -->
                <div class="flex justify-between items-start gap-4 mb-0 px-4">
                <!-- Bloc gauche — CHEF CABINET et SPTP -->
                <div class="flex flex-col gap-2">
                    <BoxVertClair label="CHEF CABINET" />
                    <div class="flex gap-2 ml-2">
                    <BoxRouge label="CPRPC" />
                    <BoxRouge label="CM" />
                    </div>
                    <BoxVertClair label="SPTP" />
                    <div class="flex gap-2 ml-2">
                    <BoxRouge label="DGS" />
                    <BoxRouge label="DSP" />
                    <BoxRouge label="DA" />
                    </div>
                </div>

                <!-- Bloc centre-gauche — SP/Maire + Services SE -->
                <div class="flex flex-col items-center gap-2">
                    <BoxRouge label="SP/Maire" />
                    <LigneV />
                    <BoxRougeListe :items="['SP SE', 'C Com', 'SRT', 'ULPE']" />
                </div>

                <!-- Bloc centre — SECRETAIRE EXECUTIF -->
                <div class="flex flex-col items-center gap-0">
                    <BoxVert label="SECRETAIRE" sub="EXECUTIF" />
                    <LigneV />
                </div>

                <!-- Bloc droite — Auditeur et services -->
                <div class="flex flex-col gap-1">
                    <BoxRougeListe
                    :items="['AUDITEUR INTERNE', 'CCMP', 'PRMP', 'CELLULE JURIDIQUE']"
                    />
                </div>
                </div>

                <!-- NIVEAU 5 : SA -->
                <div class="flex justify-center mb-0">
                <LigneV />
                <div class="absolute">
                    <BoxRouge label="SA" />
                </div>
                </div>

                <!-- Ligne horizontale reliant les 5 directions -->
                <div class="relative flex justify-center mt-8 mb-0">
                <div class="absolute top-0 left-[10%] right-[10%] h-px bg-gray-400" />
                </div>

                <!-- NIVEAU 6 : 5 DIRECTIONS -->
                <div class="flex justify-between items-start gap-2 mt-4 px-4">
                <!-- DDLP -->
                <div class="flex flex-col items-center gap-0">
                    <LigneV />
                    <BoxVertClair label="DDLP" />
                    <div class="flex gap-2 mt-1">
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SDPSES" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DGS" />
                        <BoxGrise label="DGAC" />
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SCAS" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DDL" />
                        <BoxGrise label="DSES" />
                        <BoxGrise label="DPE" />
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="DCA" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DAS" />
                        </div>
                    </div>
                    </div>
                </div>

                <!-- DST -->
                <div class="flex flex-col items-center gap-0">
                    <LigneV />
                    <BoxVertClair label="DST" />
                    <div class="flex gap-2 mt-1">
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SEST" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DCVOH" />
                        <BoxGrise label="DCI" />
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SVEMI" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DHAEI" />
                        <BoxGrise label="DMEEP" />
                        </div>
                    </div>
                    </div>
                </div>

                <!-- DSI -->
                <div class="flex flex-col items-center gap-0">
                    <LigneV />
                    <BoxVertClair label="DSI" />
                    <div class="flex gap-2 mt-1">
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SIS" />
                    </div>
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SAe-S" />
                    </div>
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SAGS" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DAr" />
                        <BoxGrise label="DGS" />
                        </div>
                    </div>
                    </div>
                </div>

                <!-- DADE -->
                <div class="flex flex-col items-center gap-0">
                    <LigneV />
                    <BoxVertClair label="DADE" />
                    <div class="flex gap-2 mt-1">
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SADU" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DAD" />
                        <BoxGrise label="DUr" />
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SPE" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DE" />
                        <BoxGrise label="DA" />
                        </div>
                    </div>
                    </div>
                </div>

                <!-- DAAF -->
                <div class="flex flex-col items-center gap-0">
                    <LigneV />
                    <BoxVertClair label="DAAF" />
                    <div class="flex gap-2 mt-1">
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SRHAG" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DRH" />
                        <BoxGrise label="DA" />
                        <BoxGrise label="RA" />
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SBFC" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DiB" />
                        <BoxGrise label="DCM" />
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SeRR" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DMA" />
                        <BoxGrise label="RdR" />
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-0">
                        <LigneV />
                        <BoxRouge label="SAA" />
                        <div class="flex flex-col gap-1 mt-1">
                        <BoxGrise label="DiST" />
                        <BoxGrise label="DGAT" />
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </motion.div>

            <!-- Légende -->
            <motion.div
            :variants="fadeUp"
            initial="hidden"
            whileInView="visible"
            :viewport="{ once: true }"
            :custom="0.3"
            class="mt-8 flex flex-wrap gap-5 justify-center"
            >
            <div
                v-for="item in legende"
                :key="item.label"
                class="flex items-center gap-2 text-sm text-gray-600"
            >
                <div :class="['w-4 h-4 rounded border', item.couleur]" />
                {{ item.label }}
            </div>
            </motion.div>

            <!-- Note scrollable -->
            <p class="text-center text-xs text-gray-400 mt-4">
            Faites défiler horizontalement pour voir l'organigramme complet sur mobile.
            </p>
        </div>
    </PublicLayout>
</template>
