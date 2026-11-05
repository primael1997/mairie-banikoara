<script setup>
import { watch } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { motion } from "motion-v";
import { MessageSquare, AlertCircle, Lightbulb, HelpCircle, Send, CheckCircle, User, Mail, FileText } from "lucide-vue-next";
import BreadCrumb from '@/Components/BreadCrumb.vue';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import Swal from 'sweetalert2';

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

// Configuration des types de requête
const typeConfig = {
    renseignement: {
        label: "Renseignement",
        icone: HelpCircle,
        description: "Posez une question à la mairie",
        actif: "bg-green-700 text-white border-green-700",
    },
    plainte: {
        label: "Plainte",
        icone: AlertCircle,
        description: "Signalez un problème ou dysfonctionnement",
        actif: "bg-red-600 text-white border-red-600",
    },
    suggestion: {
        label: "Suggestion",
        icone: Lightbulb,
        description: "Proposez une amélioration pour la commune",
        actif: "bg-amber-600 text-white border-amber-600",
    },
};

// useForm : état des champs + erreurs de validation Laravel (form.errors.xxx)
// remplies automatiquement par Inertia en cas de réponse 422.
const form = useForm({
    type: "renseignement",
    nom: "",
    email: "",
    telephone: "",
    sujet: "",
    message: "",
});

function handleTypeChange(type) {
    form.type = type;
}

// Confirmation d'envoi : lue depuis les données flash renvoyées par le
// contrôleur (return back()->with(['success' => true, 'numero_suivi' => ...])).
const page = usePage();

function onSubmit() {
    form.post("/citoyen/requete", {
        preserveScroll: true,
        onSuccess: (page) => {
            // Récupération du flash envoyé par Laravel
            const success = page.props.flash?.success;
            const numero = page.props.flash?.numero_suivi;

            // Réinitialisation des champs
            form.reset();

            // Suppression des anciennes erreurs
            form.clearErrors();

            // Affichage du popup
            Swal.fire({
                icon: "success",
                title: "Requête envoyée !",
                html: `
                    <div style="text-align:center">
                        <p>${success ?? "Votre requête a été envoyée avec succès."}</p>

                        <p style="margin-top:20px;">
                            Votre numéro de suivi :
                        </p>

                        <div style="
                            display:inline-block;
                            margin-top:5px;
                            padding:10px 20px;
                            background:#f0fdf4;
                            border-radius:8px;
                            font-size:24px;
                            font-weight:bold;
                            color:#15803d;
                            letter-spacing:1px;
                        ">
                            ${numero ?? "N/A"}
                        </div>

                        <p style="
                            margin-top:20px;
                            font-size:13px;
                            color:#6b7280;
                        ">
                            Conservez précieusement ce numéro pour suivre
                            l'évolution de votre requête.
                        </p>
                    </div>
                `,

                confirmButtonText: "OK",
                confirmButtonColor: "#15803d",
                allowOutsideClick: false,
            });
        },

        onError: (errors) => {
            console.log("Erreurs :", errors);
        },
    
    });
}

function nouvelleRequete() {
    envoye.value = false;
}

const breadcrumbItems = [
    {
        label: 'Soumettre une requête',
    },
]
</script>

<template>
    <PublicLayout>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <BreadCrumb :items="breadcrumbItems" />

            <!-- En-tête -->
            <motion.div :variants="slideLeft" initial="hidden" animate="visible" class="mb-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-green-700 rounded-xl flex items-center justify-center">
                        <MessageSquare :size="20" class="text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Soumettre une requête</h1>
                </div>
                <p class="text-gray-500">
                    Renseignement, plainte ou suggestion — la mairie vous répond sous 48h.
                </p>
            </motion.div>



            <!-- Formulaire -->
            <motion.form :variants="fadeUp" initial="hidden" animate="visible" :custom="0.2"
                @submit.prevent="onSubmit" class="space-y-8">
                <!-- Sélection du type -->
                <div>
                    <p class="text-sm font-semibold text-gray-700 mb-4">Type de requête</p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <motion.button v-for="(config, type) in typeConfig" :key="type" type="button"
                            @click="handleTypeChange(type)" :whileHover="{ scale: 1.02 }" :whileTap="{ scale: 0.98 }"
                            :class="[
                                'flex flex-col items-center text-center p-5 rounded-xl border-2 transition-all',
                                form.type === type ? config.actif : 'bg-white border-gray-200 text-gray-600 hover:border-gray-300',
                            ]">
                            <component :is="config.icone" :size="24" class="mb-2" />
                            <p class="font-semibold text-sm">{{ config.label }}</p>
                            <p :class="['text-xs mt-1', form.type === type ? 'opacity-80' : 'text-gray-400']">
                                {{ config.description }}
                            </p>
                        </motion.button>
                    </div>
                </div>

                <!-- Informations personnelles -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <p class="text-sm font-semibold text-gray-700 mb-5 flex items-center gap-2">
                        <User :size="16" class="text-green-700" />
                        Vos informations
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nom -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                Nom complet <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.nom" placeholder="Ex : Moussa BIOKOU" :class="[
                                'w-full px-4 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-100 transition-all',
                                form.errors.nom ? 'border-red-400 focus:border-red-400' : 'border-gray-200 focus:border-green-400',
                            ]" />
                            <p v-if="form.errors.nom" class="text-xs text-red-500 mt-1">{{ form.errors.nom }}</p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.email" type="email" placeholder="exemple@email.com" :class="[
                                'w-full px-4 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-100 transition-all',
                                form.errors.email ? 'border-red-400 focus:border-red-400' : 'border-gray-200 focus:border-green-400',
                            ]" />
                            <p v-if="form.errors.email" class="text-xs text-red-500 mt-1">{{ form.errors.email }}</p>
                        </div>

                        <!-- Téléphone -->
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                Téléphone <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.telephone" placeholder="+229 XX XX XX XX XX" :class="[
                                'w-full px-4 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-100 transition-all',
                                form.errors.telephone ? 'border-red-400 focus:border-red-400' : 'border-gray-200 focus:border-green-400',
                            ]" />
                            <p v-if="form.errors.telephone" class="text-xs text-red-500 mt-1">{{ form.errors.telephone
                                }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contenu de la requête -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <p class="text-sm font-semibold text-gray-700 mb-5 flex items-center gap-2">
                        <FileText :size="16" class="text-green-700" />
                        Votre requête
                    </p>

                    <!-- Sujet -->
                    <div class="mb-5">
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">
                            Sujet <span class="text-red-500">*</span>
                        </label>
                        <input v-model="form.sujet" placeholder="Résumez votre requête en quelques mots" :class="[
                            'w-full px-4 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-100 transition-all',
                            form.errors.sujet ? 'border-red-400 focus:border-red-400' : 'border-gray-200 focus:border-green-400',
                        ]" />
                        <p v-if="form.errors.sujet" class="text-xs text-red-500 mt-1">{{ form.errors.sujet }}</p>
                    </div>

                    <!-- Message -->
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">
                            Message <span class="text-red-500">*</span>
                        </label>
                        <textarea v-model="form.message" rows="6" placeholder="Décrivez votre requête en détail..."
                            :class="[
                                'w-full px-4 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-100 transition-all resize-none',
                                form.errors.message ? 'border-red-400 focus:border-red-400' : 'border-gray-200 focus:border-green-400',
                            ]" />
                        <p v-if="form.errors.message" class="text-xs text-red-500 mt-1">{{ form.errors.message }}</p>
                    </div>
                </div>

                <!-- Bouton d'envoi -->
                <motion.button type="submit" :disabled="form.processing" :whileHover="{ scale: 1.02 }"
                    :whileTap="{ scale: 0.98 }"
                    class="w-full flex items-center justify-center gap-2 bg-green-700 hover:bg-green-800 disabled:bg-green-400 text-white py-4 rounded-xl font-semibold text-sm transition-colors">
                    <template v-if="form.processing">
                        <motion.div :animate="{ rotate: 360 }"
                            :transition="{ duration: 1, repeat: Infinity, ease: 'linear' }"
                            class="w-4 h-4 border-2 border-white border-t-transparent rounded-full" />
                        Envoi en cours...
                    </template>
                    <template v-else>
                        <Send :size="16" />
                        Envoyer ma requête
                    </template>
                </motion.button>
            </motion.form>
        </div>
    </PublicLayout>
</template>
