<script setup>
    import { ref, computed } from "vue";
    import { motion } from "motion-v";
    import BreadCrumb from '@/Components/BreadCrumb.vue'
    import { Clock, ArrowRight } from 'lucide-vue-next'
    import PublicLayout from '@/Layouts/PublicLayout.vue'

    const breadcrumbItems = [
        {
            label: 'Mandature',
        },
    ]

    const props = defineProps({
        anciens_maires: { type: Array, default: () => [] },
    })
</script>

<template>
    <PublicLayout>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <BreadCrumb
                :items="breadcrumbItems"
            />

            <div class="mb-12" data-aos="fade-right">
                <div class="flex items-center gap-3 mb-2">

                    <div
                        class="w-10 h-10 bg-green-700 rounded-xl flex items-center justify-center"
                    >
                        <Clock :size="20" class="text-white" />
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900">
                        Anciens maires
                    </h1>

                </div>

                <p class="text-gray-500">
                    Les édiles qui ont façonné l'histoire de la commune de Banikoara.
                </p>
            </div>


            <!-- Liste des maires -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-14">

                <div
                    v-for="(maire, index) in props.anciens_maires"
                    :key="maire.id"
                    data-aos="fade-up"
                    :data-aos-delay="index * 150"
                    class="bg-white border-2 border-green-400 rounded-2xl overflow-hidden hover:shadow-lg transition-all"
                >

                    <div class="grid grid-cols-1 md:grid-cols-4">

                        <!-- Photo -->
                        <div class="relative">

                            <img
                                :src="`/${maire?.photo}`"
                                :alt="maire.nom"
                                class="w-full h-64 md:h-full object-cover object-top"
                            />

                            <!-- Badge mandat -->
                            <span
                                class="absolute top-3 left-3 bg-green-700 text-white text-xs font-semibold px-3 py-1 rounded-full"
                            >
                                {{ maire.mandat }}
                            </span>

                        </div>

                        <!-- Informations -->
                        <div class="md:col-span-3 p-6 flex flex-col justify-center">

                            <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                {{ maire.nom }}
                            </h2>

                            <!-- Ajoute ici d'autres informations -->
                            <p
                                v-if="maire.description"
                                class="text-gray-500 leading-relaxed"
                            >
                                {{ maire.description }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Appel à contribution -->
            <div data-aos="fade-up" class="bg-green-50 border border-green-200 rounded-2xl p-8 text-center">

                <p class="font-semibold text-gray-900 mb-2">
                    Vous avez des informations sur l'histoire de la commune ?
                </p>

                <p class="text-gray-500 text-sm mb-5">
                    Contribuez à enrichir cette page en nous transmettant des documents historiques.
                </p>

                <Link
                    href="/contact"
                    class="inline-flex items-center gap-2 bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-green-800 transition-colors"
                >
                    Nous contacter

                    <ArrowRight :size="14" />
                </Link>

            </div>

        </div>

    </PublicLayout>
</template>
