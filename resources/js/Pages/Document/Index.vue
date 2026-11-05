<script setup>
import { ref, computed, watch } from "vue";
import { router } from "@inertiajs/vue3";

import {
    FileText,
    Download,
    Search,
    FolderOpen,
    Calendar,
    Eye,
} from "lucide-vue-next";

import BreadCrumb from "@/Components/BreadCrumb.vue";
import PublicLayout from "@/Layouts/PublicLayout.vue";


const props = defineProps({
    documents: {
        type: Object,
        default: () => ({
            data: [],
            current_page: 1,
            last_page: 1,
        }),
    },

    categories: {
        type: Array,
        default: () => [],
    },

    filters: {
        type: Object,
        default: () => ({}),
    },
});


/*
|--------------------------------------------------------------------------
| FILTRES
|--------------------------------------------------------------------------
*/

const categorie = ref(props.filters?.categorie || "tous");

const recherche = ref(props.filters?.recherche || "");


/*
|--------------------------------------------------------------------------
| COULEUR UNIQUE POUR TOUTES LES CATEGORIES
|--------------------------------------------------------------------------
|
| Toutes les catégories auront exactement
| la même couleur de badge.
|
*/

const categorieStyle =
    "bg-green-50 text-green-700 border-green-200";


/*
|--------------------------------------------------------------------------
| STATISTIQUES DYNAMIQUES
|--------------------------------------------------------------------------
|
| Les statistiques sont calculées sur les documents
| actuellement reçus.
|
*/

const stats = computed(() => {
    return props.categories.map((categorie) => ({
        label: categorie.nom,

        value: props.documents.data.filter(
            (document) =>
                document.categorie_document?.id === categorie.id
        ).length,
    }));
});


/*
|--------------------------------------------------------------------------
| FORMAT DATE
|--------------------------------------------------------------------------
*/

function formatDate(dateStr) {
    if (!dateStr) return "";

    return new Date(dateStr).toLocaleDateString(
        "fr-BJ",
        {
            day: "numeric",
            month: "long",
            year: "numeric",
        }
    );
}


/*
|--------------------------------------------------------------------------
| APPLIQUER LES FILTRES
|--------------------------------------------------------------------------
*/

function filtrerDocuments(page = 1) {

    router.get(
        route("document.index"),

        {
            categorie: categorie.value,
            recherche: recherche.value || undefined,
            page,
        },

        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        }
    );
}


/*
|--------------------------------------------------------------------------
| FILTRE PAR CATEGORIE
|--------------------------------------------------------------------------
*/

watch(categorie, () => {
    filtrerDocuments(1);
});


/*
|--------------------------------------------------------------------------
| RECHERCHE AVEC DEBOUNCE
|--------------------------------------------------------------------------
*/

let searchTimeout = null;

watch(recherche, () => {

    clearTimeout(searchTimeout);

    searchTimeout = setTimeout(() => {

        filtrerDocuments(1);

    }, 500);

});


/*
|--------------------------------------------------------------------------
| PAGINATION
|--------------------------------------------------------------------------
*/

function goToPage(page) {

    if (
        page < 1 ||
        page > props.documents.last_page
    ) {
        return;
    }

    filtrerDocuments(page);
}


/*
|--------------------------------------------------------------------------
| BREADCRUMB
|--------------------------------------------------------------------------
*/

const breadcrumbItems = [
    {
        label: "Documentation",
    },
];
</script>


<template>

    <PublicLayout>

        <div
            class="
                max-w-7xl
                mx-auto
                px-4
                sm:px-6
                lg:px-8
                py-10
            "
        >

            <!-- ================================= -->
            <!-- BREADCRUMB -->
            <!-- ================================= -->

            <BreadCrumb
                :items="breadcrumbItems"
            />


            <!-- ================================= -->
            <!-- EN-TÊTE -->
            <!-- ================================= -->

            <div class="mb-10">

                <div
                    class="
                        flex
                        items-center
                        gap-3
                        mb-2
                    "
                >

                    <div
                        class="
                            w-10
                            h-10
                            bg-green-700
                            rounded-xl
                            flex
                            items-center
                            justify-center
                        "
                    >
                        <FolderOpen
                            :size="20"
                            class="text-white"
                        />
                    </div>


                    <h1
                        class="
                            text-3xl
                            font-bold
                            text-gray-900
                        "
                    >
                        Documentation officielle
                    </h1>

                </div>


                <p class="text-gray-500">
                    Documents officiels et publics de la mairie
                    de Banikoara, téléchargeables en PDF.
                </p>

            </div>

            <!-- ================================= -->
            <!-- RECHERCHE -->
            <!-- ================================= -->

            <div
                class="
                    relative
                    mb-6
                "
            >

                <Search
                    :size="16"
                    class="
                        absolute
                        left-4
                        top-1/2
                        -translate-y-1/2
                        text-gray-400
                    "
                />


                <input
                    v-model="recherche"
                    type="text"
                    placeholder="Rechercher un document..."
                    class="
                        w-full
                        pl-11
                        pr-4
                        py-3
                        bg-white
                        border
                        border-gray-200
                        rounded-xl
                        text-sm
                        focus:outline-none
                        focus:border-green-400
                        focus:ring-2
                        focus:ring-green-100
                        transition-all
                    "
                />

            </div>


            <!-- ================================= -->
            <!-- FILTRES CATEGORIES -->
            <!-- ================================= -->

            <div
                class="
                    flex
                    flex-wrap
                    gap-2
                    mb-10
                "
            >

                <!-- TOUS -->

                <button
                    @click="categorie = 'tous'"
                    :class="[
                        'px-4 py-2 rounded-lg text-sm font-medium transition-all',

                        categorie === 'tous'
                            ? 'bg-green-700 text-white'
                            : 'bg-gray-100 text-gray-600 hover:bg-gray-200',
                    ]"
                >
                    Tous les documents
                </button>


                <!-- CATEGORIES -->

                <button
                    v-for="cat in categories"
                    :key="cat.id"
                    @click="categorie = cat.slug"
                    :class="[
                        'px-4 py-2 rounded-lg text-sm font-medium transition-all',

                        categorie === cat.slug
                            ? 'bg-green-700 text-white'
                            : 'bg-gray-100 text-gray-600 hover:bg-gray-200',
                    ]"
                >
                    {{ cat.nom }}
                </button>

            </div>


            <!-- ================================= -->
            <!-- AUCUN DOCUMENT -->
            <!-- ================================= -->

            <div
                v-if="documents.data.length === 0"
                class="
                    text-center
                    py-20
                    text-gray-400
                "
            >

                <FolderOpen
                    :size="40"
                    class="
                        mx-auto
                        mb-3
                        opacity-30
                    "
                />

                <p>
                    Aucun document ne correspond à votre recherche.
                </p>

            </div>


            <!-- ================================= -->
            <!-- LISTE DES DOCUMENTS -->
            <!-- ================================= -->

            <div
                v-else
                class="space-y-4"
            >

                <div
                    v-for="doc in documents.data"
                    :key="doc.id"
                    class="
                        bg-white
                        border
                        border-gray-200
                        rounded-xl
                        p-5
                        flex
                        items-center
                        gap-5
                        hover:border-green-300
                        hover:shadow-md
                        transition-all
                    "
                >


                    <!-- ICONE PDF -->

                    <div
                        class="
                            w-12
                            h-12
                            bg-red-50
                            border
                            border-red-200
                            rounded-xl
                            flex
                            items-center
                            justify-center
                            shrink-0
                        "
                    >

                        <FileText
                            :size="20"
                            class="text-red-500"
                        />

                    </div>


                    <!-- CONTENU -->

                    <div
                        class="
                            flex-1
                            min-w-0
                        "
                    >

                        <div
                            class="
                                flex
                                items-center
                                gap-2
                                mb-1
                                flex-wrap
                            "
                        >

                            <!-- TITRE -->

                            <h3
                                class="
                                    font-semibold
                                    text-gray-900
                                    text-sm
                                    truncate
                                "
                            >
                                {{ doc.titre }}
                            </h3>


                            <!-- BADGE CATEGORIE -->
                            <!-- COULEUR UNIQUE -->

                            <span
                                v-if="doc.categorie_document"
                                :class="[
                                    'text-xs font-medium px-2 py-0.5 rounded-lg border shrink-0',
                                    categorieStyle,
                                ]"
                            >
                                {{ doc.categorie_document.nom }}
                            </span>

                        </div>


                        <!-- DESCRIPTION -->

                        <p
                            class="
                                text-xs
                                text-gray-500
                                mb-2
                                line-clamp-1
                            "
                        >
                            {{ doc.description }}
                        </p>


                        <!-- DATE -->

                        <div
                            class="
                                flex
                                items-center
                                gap-4
                                text-xs
                                text-gray-400
                            "
                        >

                            <span
                                class="
                                    flex
                                    items-center
                                    gap-1
                                "
                            >

                                <Calendar
                                    :size="11"
                                />

                                {{ formatDate(doc.created_at) }}

                            </span>

                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- ACTIONS -->
                    <!-- ================================= -->

                    <div
                        class="
                            flex
                            items-center
                            gap-2
                            shrink-0
                        "
                    >

                        <!-- APERCU -->

                        <a
                            :href="`/${doc.fichier}`"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="
                                hidden sm:flex items-center justify-center gap-1.5
                                px-3 py-2 rounded-lg
                                border border-green-700
                                text-green-700
                                text-xs font-medium
                                hover:bg-green-50
                                transition-colors"
                            title="Aperçu"
                        >

                            <Eye
                                :size="16"
                            />
                            Lire
                        </a>


                        <!-- TELECHARGEMENT -->

                        <a
                            :href="`/${doc.fichier}`"
                            download
                            class="
                                hidden sm:flex
                                items-center
                                gap-1.5
                                bg-green-700
                                text-white
                                text-xs
                                font-medium
                                px-3
                                py-2
                                rounded-lg
                                hover:bg-green-800
                                transition-colors
                            "
                        >

                            <Download
                                :size="13"
                            />

                            Télécharger

                        </a>

                    </div>

                </div>

            </div>

            <!-- ================================= -->
            <!-- STATISTIQUES -->
            <!-- ================================= -->

            <div
                v-if="stats.length"
                class="
                    grid
                    grid-cols-2
                    sm:grid-cols-3
                    lg:grid-cols-4
                    gap-4
                    mb-10
                    mt-10
                "
            >

                <div
                    v-for="stat in stats"
                    :key="stat.label"
                    class="
                        bg-white
                        border
                        border-gray-200
                        rounded-xl
                        p-4
                        text-center
                        hover:border-green-300
                        transition-colors
                    "
                >

                    <p
                        class="
                            text-2xl
                            font-bold
                            text-green-700
                        "
                    >
                        {{ stat.value }}
                    </p>


                    <p
                        class="
                            text-xs
                            text-gray-500
                            mt-1
                        "
                    >
                        {{ stat.label }}
                    </p>

                </div>

            </div>


            <!-- ================================= -->
            <!-- PAGINATION -->
            <!-- ================================= -->

            <div
                v-if="documents.last_page > 1"
                class="
                    flex
                    justify-center
                    items-center
                    gap-2
                    mt-8
                    flex-wrap
                "
            >

                <!-- PRECEDENT -->

                <button
                    @click="
                        goToPage(
                            documents.current_page - 1
                        )
                    "
                    :disabled="
                        documents.current_page === 1
                    "
                    class="
                        px-3
                        py-2
                        rounded-lg
                        bg-gray-200
                        hover:bg-gray-300
                        disabled:opacity-50
                        disabled:cursor-not-allowed
                        transition-colors
                    "
                >
                    Précédent
                </button>


                <!-- PAGES -->

                <button
                    v-for="i in documents.last_page"
                    :key="i"
                    @click="goToPage(i)"
                    :class="[
                        'px-3 py-2 rounded-lg transition-colors',

                        documents.current_page === i
                            ? 'bg-green-700 text-white'
                            : 'bg-gray-200 hover:bg-gray-300',
                    ]"
                >
                    {{ i }}
                </button>


                <!-- SUIVANT -->

                <button
                    @click="
                        goToPage(
                            documents.current_page + 1
                        )
                    "
                    :disabled="
                        documents.current_page === documents.last_page
                    "
                    class="
                        px-3
                        py-2
                        rounded-lg
                        bg-gray-200
                        hover:bg-gray-300
                        disabled:opacity-50
                        disabled:cursor-not-allowed
                        transition-colors
                    "
                >
                    Suivant
                </button>

            </div>

        </div>

    </PublicLayout>

</template>
