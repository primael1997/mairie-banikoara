<script setup>
    import { ref, computed } from "vue";
    import { motion } from "motion-v";
    import { FolderOpen, CheckCircle, Clock, Circle } from "lucide-vue-next";
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

    // Statuts des projets avec couleurs et icônes
    const statutConfig = {
        termine: { label: "Terminé", bg: "bg-green-100", text: "text-green-800", border: "border-green-300", icon: CheckCircle },
        en_cours: { label: "En cours", bg: "bg-amber-100", text: "text-amber-800", border: "border-amber-300", icon: Clock },
        planifie: { label: "Planifié", bg: "bg-gray-100", text: "text-gray-700", border: "border-gray-300", icon: Circle },
    };

    // Secteurs des projets
    const secteurs = ["infrastructure", "sante", "education", "agriculture", "eau", "culture"];

    // Données mock des projets
    const projets = [
        {
            id: 1,
            titre: "Bitumage de la route Banikoara-Kérou",
            secteur: "infrastructure",
            statut: "en_cours",
            budget: "2,5 milliards FCFA",
            debut: "2024",
            fin: "2026",
            description: "Réhabilitation et bitumage de l'axe routier principal reliant Banikoara à Kérou pour améliorer la mobilité des populations et le transport des marchandises.",
            image: "/front/images/commune/projets/route-kerou.png",
            partenaire: "État béninois / PAG",
        },
        {
            id: 2,
            titre: "Construction du stade omnisports",
            secteur: "culture",
            statut: "en_cours",
            budget: "800 millions FCFA",
            debut: "2024",
            fin: "2025",
            description: "Construction d'un stade omnisports moderne pour accueillir les compétitions sportives et culturelles de la commune et du département.",
            image: "/front/images/commune/projets/stade.jpg",
            partenaire: "État béninois",
        },
        {
            id: 3,
            titre: "Adduction d'eau potable — Soroko & Sompérékou",
            secteur: "eau",
            statut: "termine",
            budget: "350 millions FCFA",
            debut: "2022",
            fin: "2023",
            description: "Réalisation des adductions d'eau potable dans les arrondissements de Soroko et Sompérékou pour améliorer l'accès à l'eau des populations rurales.",
            image: "/front/images/commune/projets/eau-potable.jpg",
            partenaire: "AFD / UNICEF",
        },
        {
            id: 4,
            titre: "Programme d'alimentation scolaire intégré",
            secteur: "education",
            statut: "en_cours",
            budget: "120 millions FCFA",
            debut: "2023",
            fin: "2026",
            description: "Mise en place d'un programme de cantines scolaires dans 30 écoles de la commune pour améliorer la scolarisation et la nutrition des enfants.",
            image: "/front/images/commune/projets/ecole.jpg",
            partenaire: "PNUD / PAM",
        },
        {
            id: 5,
            titre: "Dotation en équipements médicaux",
            secteur: "sante",
            statut: "termine",
            budget: "180 millions FCFA",
            debut: "2023",
            fin: "2024",
            description: "Dotation de l'hôpital de zone et des 33 centres de santé de la commune en équipements médicaux modernes.",
            image: "/front/images/commune/projets/sante.jpg",
            partenaire: "OMS / Mairie",
        },
        {
            id: 6,
            titre: "Programme emploi des jeunes",
            secteur: "agriculture",
            statut: "en_cours",
            budget: "200 millions FCFA",
            debut: "2024",
            fin: "2026",
            description: "Insertion professionnelle des jeunes de Banikoara dans les filières agricoles et artisanales à travers des formations et des dotations en matériel.",
            image: "/front/images/commune/projets/jeunes.jpg",
            partenaire: "État béninois",
        },
    ];

    // Filtres disponibles
    const filtresStatut = ["tous", "en_cours", "termine", "planifie"];

    const filtre = ref("tous");
    const secteur = ref("tous");

    // Application des filtres
    const projetsFiltres = computed(() =>
        projets.filter((p) => {
            const matchStatut = filtre.value === "tous" || p.statut === filtre.value;
            const matchSecteur = secteur.value === "tous" || p.secteur === secteur.value;
            return matchStatut && matchSecteur;
        })
    );

    // Statistiques rapides
    const stats = [
        { label: "En cours", value: projets.filter((p) => p.statut === "en_cours").length, couleur: "bg-amber-50 border-amber-200 text-amber-700" },
        { label: "Terminés", value: projets.filter((p) => p.statut === "termine").length, couleur: "bg-green-50 border-green-200 text-green-700" },
        { label: "Planifiés", value: projets.filter((p) => p.statut === "planifie").length, couleur: "bg-gray-50 border-gray-200 text-gray-600" },
    ];

    const breadcrumbItems = [
        {
            label: 'Commune',
        },
        {
            label: 'Projets',
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
                        <FolderOpen :size="20" class="text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Projets de la commune</h1>
                </div>
                <p class="text-gray-500">
                    Les projets de développement en cours, terminés et planifiés à Banikoara.
                </p>
            </motion.div>

            <!-- Statistiques rapides -->
            <motion.div :variants="fadeUp" initial="hidden" animate="visible" :custom="0.2"
                class="grid grid-cols-3 gap-4 mb-10">
                <div v-for="stat in stats" :key="stat.label" :class="['border rounded-xl p-4 text-center', stat.couleur]">
                    <p class="text-3xl font-bold">{{ stat.value }}</p>
                    <p class="text-xs font-medium mt-1">{{ stat.label }}</p>
                </div>
            </motion.div>

            <!-- Filtres statut -->
            <motion.div :variants="fadeUp" initial="hidden" animate="visible" :custom="0.3"
                class="flex flex-wrap gap-2 mb-4">
                <button v-for="f in filtresStatut" :key="f" @click="filtre = f" :class="[
                    'px-4 py-2 rounded-lg text-sm font-medium capitalize transition-all',
                    filtre === f
                        ? 'bg-green-700 text-white shadow-sm'
                        : 'bg-white border border-gray-200 text-gray-600 hover:border-green-400 hover:text-green-700',
                ]">
                    {{ f === "tous" ? "Tous les projets" : statutConfig[f]?.label }}
                </button>
            </motion.div>

            <!-- Filtres secteur -->
            <motion.div :variants="fadeUp" initial="hidden" animate="visible" :custom="0.35"
                class="flex flex-wrap gap-2 mb-10">
                <button v-for="s in ['tous', ...secteurs]" :key="s" @click="secteur = s" :class="[
                    'px-3 py-1.5 rounded-lg text-xs font-medium capitalize transition-all',
                    secteur === s
                        ? 'bg-green-100 text-green-800 border border-green-400'
                        : 'bg-white border border-gray-200 text-gray-500 hover:border-green-300',
                ]">
                    {{ s === "tous" ? "Tous les secteurs" : s }}
                </button>
            </motion.div>

            <!-- Grille des projets -->
            <motion.div v-if="projetsFiltres.length === 0" :variants="fadeUp" initial="hidden" animate="visible"
                class="text-center py-20 text-gray-400">
                <FolderOpen :size="40" class="mx-auto mb-3 opacity-30" />
                <p>Aucun projet ne correspond à ces filtres.</p>
            </motion.div>

            <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <motion.div v-for="(projet, index) in projetsFiltres" :key="projet.id" :variants="fadeUp" initial="hidden"
                    whileInView="visible" :viewport="{ once: true }" :custom="index * 0.1"
                    :whileHover="{ y: -5, transition: { duration: 0.2 } }"
                    class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-green-300 hover:shadow-lg transition-all">
                    <!-- Image -->
                    <div class="relative overflow-hidden">
                        <img :src="projet.image" :alt="projet.titre"
                            class="w-full h-44 object-cover hover:scale-105 transition-transform duration-500" />
                        <!-- Badge statut -->
                        <span :class="[
                            'absolute top-3 left-3 inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1 rounded-full border',
                            statutConfig[projet.statut].bg,
                            statutConfig[projet.statut].text,
                            statutConfig[projet.statut].border,
                        ]">
                            <component :is="statutConfig[projet.statut].icon" :size="11" />
                            {{ statutConfig[projet.statut].label }}
                        </span>
                        <!-- Badge secteur -->
                        <span
                            class="absolute top-3 right-3 text-xs font-medium bg-white/90 text-gray-700 px-2 py-1 rounded-lg capitalize">
                            {{ projet.secteur }}
                        </span>
                    </div>

                    <!-- Contenu -->
                    <div class="p-5">
                        <h3 class="font-semibold text-gray-900 mb-2 leading-snug">
                            {{ projet.titre }}
                        </h3>
                        <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">
                            {{ projet.description }}
                        </p>

                        <!-- Métadonnées -->
                        <div class="grid grid-cols-2 gap-2 text-xs text-gray-500 border-t border-gray-100 pt-4">
                            <div>
                                <p class="text-gray-400 mb-0.5">Budget</p>
                                <p class="font-medium text-gray-700">{{ projet.budget }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 mb-0.5">Période</p>
                                <p class="font-medium text-gray-700">{{ projet.debut }} – {{ projet.fin }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-400 mb-0.5">Partenaire</p>
                                <p class="font-medium text-gray-700">{{ projet.partenaire }}</p>
                            </div>
                        </div>
                    </div>
                </motion.div>
            </div>
        </div>
    </PublicLayout>
</template>
