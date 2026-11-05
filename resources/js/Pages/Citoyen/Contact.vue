<script setup>
    import { Link } from "@inertiajs/vue3";
    import { motion } from "motion-v";
    import { MapPin, Phone, Mail, Clock, Globe, ArrowRight, MessageCircle } from "lucide-vue-next";
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

    // Informations de contact
    const infos = [
        {
            icone: MapPin,
            titre: "Adresse",
            contenu: "Banikoara, département de l'Alibori, République du Bénin",
            lien: null,
            couleur: "bg-green-50 text-green-700",
        },
        {
            icone: Phone,
            titre: "Téléphone",
            contenu: "+229 0100 0000",
            lien: "tel:+22901000000",
            couleur: "bg-green-50 text-green-700",
        },
        {
            icone: Mail,
            titre: "Email",
            contenu: "contact@mairiebanikoara.bj",
            lien: "mailto:contact@mairiebanikoara.bj",
            couleur: "bg-green-50 text-green-700",
        },
        {
            icone: Clock,
            titre: "Horaires d'ouverture",
            contenu: "Lundi – Vendredi : 8h00 – 17h00",
            lien: null,
            couleur: "bg-green-50 text-green-700",
        },
    ];

    const breadcrumbItems = [
        {
            label: 'Contact',
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
            <motion.div :variants="slideLeft" initial="hidden" animate="visible" class="mb-12">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-green-700 rounded-xl flex items-center justify-center">
                        <Mail :size="20" class="text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Nous contacter</h1>
                </div>
                <p class="text-gray-500">
                    La mairie de Banikoara est à votre écoute du lundi au vendredi.
                </p>
            </motion.div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Colonne gauche — informations -->
                <div class="space-y-5">
                    <!-- Cartes d'information -->
                    <motion.div v-for="(info, index) in infos" :key="info.titre" :variants="fadeUp" initial="hidden"
                        animate="visible" :custom="index * 0.1" :whileHover="{ x: 4, transition: { duration: 0.2 } }"
                        class="flex items-center gap-4 bg-white border border-gray-200 rounded-xl p-5 hover:border-green-300 hover:shadow-md transition-all">
                        <div :class="['w-11 h-11 rounded-xl flex items-center justify-center shrink-0', info.couleur]">
                            <component :is="info.icone" :size="20" />
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">{{ info.titre }}</p>
                            <a v-if="info.lien" :href="info.lien"
                                class="text-sm font-medium text-gray-900 hover:text-green-700 transition-colors">
                                {{ info.contenu }}
                            </a>
                            <p v-else class="text-sm font-medium text-gray-900">
                                {{ info.contenu }}
                            </p>
                        </div>
                    </motion.div>

                    <!-- Réseaux sociaux -->
                    <motion.div :variants="fadeUp" initial="hidden" animate="visible" :custom="0.4"
                        class="bg-white border border-gray-200 rounded-xl p-5">
                        <p class="text-xs text-gray-400 mb-3">Suivez-nous</p>
                        <div class="flex gap-3">
                            <a href="https://www.facebook.com/MairieBanioara" target="_blank" rel="noopener noreferrer"
                                class="flex items-center gap-2 bg-blue-50 text-blue-700 border border-blue-200 px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors">
                                <MessageCircle :size="15" />
                                Facebook
                            </a>

                            <a href="https://mairiebanikoara.bj" target="_blank" rel="noopener noreferrer"
                                class="flex items-center gap-2 bg-green-50 text-green-700 border border-green-200 px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-100 transition-colors">
                                <Globe :size="15" />
                                Site officiel
                            </a>
                        </div>
                    </motion.div>
                </div>

                <!-- Colonne droite — carte et requête -->
                <div class="space-y-6">
                    <!-- Carte Google Maps -->
                    <motion.div :variants="fadeUp" initial="hidden" animate="visible" :custom="0.2"
                        class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                        <iframe title="Localisation Mairie de Banikoara"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31496.123456!2d2.4399!3d11.3018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTHCsDE4JzA2LjUiTiAywrAyNicyMy42IkU!5e0!3m2!1sfr!2sbj!4v1234567890"
                            width="100%" height="280" style="border: 0" allowfullscreen loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" />
                    </motion.div>

                    <!-- Bandeau requête -->
                    <motion.div :variants="fadeUp" initial="hidden" animate="visible" :custom="0.3"
                        class="relative overflow-hidden bg-green-950 rounded-xl p-7 text-white">
                        <!-- Décorations flottantes -->
                        <motion.div :animate="{ y: [0, -10, 0] }"
                            :transition="{ duration: 5, repeat: Infinity, ease: 'easeInOut' }"
                            class="absolute top-4 right-8 w-16 h-16 rounded-full border border-green-700 opacity-30" />
                        <motion.div :animate="{ y: [0, 8, 0] }"
                            :transition="{ duration: 6, repeat: Infinity, ease: 'easeInOut', delay: 1 }"
                            class="absolute bottom-3 right-4 w-10 h-10 rounded-full bg-green-700 opacity-20" />

                        <div class="relative">
                            <p class="font-bold text-lg mb-2">
                                Une plainte ou une suggestion ?
                            </p>
                            <p class="text-green-300 text-sm mb-5">
                                Utilisez notre formulaire dédié pour un meilleur suivi de votre requête.
                            </p>
                            <Link href="/citoyen/soumettre"
                                class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-400 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors">
                                Soumettre une requête
                                <ArrowRight :size="15" />
                            </Link>
                        </div>
                    </motion.div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
