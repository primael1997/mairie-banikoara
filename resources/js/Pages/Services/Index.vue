<script setup>
    import { ref, computed } from 'vue'
    import { Head, Link, router } from '@inertiajs/vue3'
    import PublicLayout from '@/Layouts/PublicLayout.vue'
    import BreadCrumb from '@/Components/BreadCrumb.vue'
    import {Building2, Tag, ArrowRight, Newspaper, Filter, Search, Share2, Printer} from 'lucide-vue-next'
    import Icone from '@/Components/Icone.vue'

    const props = defineProps({
        categories: { type: Array, default: () => [] },
    })

    const breadcrumbItems = [
        {
            label: 'Services',
            href: '/services',
        }
    ]
</script>

<template>
    <PublicLayout>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <BreadCrumb
                :items="breadcrumbItems"
            />


            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-green-700 rounded-xl flex items-center justify-center">
                        <Building2 :size="20" class="text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Services communaux
                    </h1>
                </div>
                <p class="text-gray-500">
                    Tous les services de la mairie de Banikoara à votre disposition.
                </p>
            </div>


            <div class="relative mb-6">
                <Search
                    size="16"
                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"
                />

                <input
                    type="text"
                    placeholder="Rechercher un service..."
                    class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all"
                />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <Link v-for="cat in categories"
                    :key="cat"
                    :href="`/services/tarifs/${cat.id}`"
                >
                    <div class="bg-white border border-gray-200 rounded-xl p-6 hover:border-green-400 hover:shadow-lg transition-all">
                        <div class="w-12 h-12 bg-green-700 rounded-xl flex items-center justify-center mb-4">
                            <Icone
                                :icon="cat.icone"
                                :size="22"
                                class="text-white"
                            />
                        </div>

                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-semibold text-gray-900">{{ cat.libelle }}</h3>
                        </div>

                        <p class="text-sm text-gray-500 leading-relaxed mb-4">
                            {{ cat.desc }}
                        </p>

                        <div class="border-t border-gray-100 pt-4 space-y-2 text-xs text-gray-500">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Délai</span>
                                <span class="font-medium text-gray-700">
                                    {{ cat.delai }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-400">Direction</span>
                                <span class="font-medium text-gray-700 text-right ml-4">
                                    {{ cat.direction }}
                                </span>
                            </div>
                        </div>

                        <ArrowRight :size="12" />
                        {{ cat.contact }}
                    </div>
              </Link>
            </div>

            <div
                data-aos="fade-up"
                data-aos-duration="700"
                class="mt-14 relative overflow-hidden bg-green-950 rounded-2xl p-10 text-white"
            >

                <div
                    data-aos="fade-down"
                    data-aos-duration="1200"
                    class="absolute top-6 right-24 w-20 h-20 rounded-full border border-green-700 opacity-30"
                ></div>

                <div
                    data-aos="fade-up"
                    data-aos-duration="1400"
                    class="absolute bottom-4 right-10 w-32 h-32 rounded-full border border-green-600 opacity-20"
                ></div>

                <div
                    data-aos="zoom-in"
                    data-aos-duration="1000"
                    class="absolute top-4 left-1/2 w-8 h-8 rounded-lg bg-green-700 opacity-20 rotate-12"
                ></div>

                <div
                    data-aos="zoom-in"
                    data-aos-duration="1500"
                    class="absolute -bottom-10 -left-10 w-52 h-52 rounded-full border-2 border-green-500 opacity-10"
                ></div>

                <div
                    data-aos="fade-up"
                    data-aos-duration="1000"
                    class="absolute top-1/2 left-1/3 w-3 h-3 rounded-full bg-green-400 opacity-25"
                ></div>

                <div
                    data-aos="fade-up"
                    data-aos-duration="1200"
                    class="absolute bottom-6 left-1/4 w-6 h-6 bg-green-600 opacity-20 rotate-45"
                ></div>

                <div class="absolute left-0 top-0 bottom-0 w-1 bg-green-500 rounded-l-2xl"></div>

                <div class="relative flex flex-col sm:flex-row items-center justify-between gap-6">

                <div>
                <span
                    data-aos="fade-right"
                    data-aos-duration="600"
                    class="inline-flex items-center gap-2 bg-green-800 border border-green-700 text-green-300 text-xs font-semibold px-3 py-1 rounded-full mb-3"
                >
                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                    Espace citoyen
                </span>

                <!-- Titre -->
                <p
                    data-aos="fade-up"
                    data-aos-delay="100"
                    class="font-bold text-xl mb-2"
                >
                    Vous ne trouvez pas ce que vous cherchez ?
                </p>

                <!-- Description -->
                <p
                    data-aos="fade-up"
                    data-aos-delay="200"
                    class="text-green-300 text-sm"
                >
                    Soumettez une demande directement à la mairie. Notre équipe vous
                    répond sous 48h.
                </p>
            </div>

            <!-- Bouton -->
            <div
                data-aos="zoom-in"
                data-aos-delay="300"
                class="shrink-0"
            >
                <Link
                    href="/citoyen/soumettre"
                    class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-400 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-all hover:scale-105"
                >
                Soumettre une requête
                <ArrowRight :size="16" />
                </Link>
            </div>

        </div>
    </div>

        </div>


    </PublicLayout>
</template>
