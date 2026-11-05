<script setup>
    import { ref, computed } from 'vue'
    import { Head, Link, router } from '@inertiajs/vue3'
    import PublicLayout from '@/Layouts/PublicLayout.vue'
    import BreadCrumb from '@/Components/BreadCrumb.vue'
    import {Building2, FileText, Coins, Tag, ArrowRight, Newspaper, Filter, Search, Share2, Printer} from 'lucide-vue-next'

    const props = defineProps({
        services: { type: Array, default: () => [] },
    })

    const breadcrumbItems = [
        {
            label: 'Services',
            href: '/services',
        },
        {
           label: props.services[0]?.category

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
                        <Coins :size="20" class="text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Tarifs des services
                    </h1>
                </div>
                <p class="text-gray-500">
                    Liste complète des services communaux avec leurs tarifs officiels.
                </p>
            </div>

            <div class="relative mb-6">
                <Search
                    :size="16"
                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"
                />
                <input
                    type="text"
                    placeholder="Rechercher un service..."
                    class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all"
                />
            </div>

            <div class="text-center py-2 text-gray-400" v-for="service in services" :key="service.id">
                <div class="space-y-3">
                    <div class="bg-white border border-gray-200 rounded-xl p-5 hover:border-green-300 hover:shadow-md transition-all">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-green-700 rounded-xl flex items-center justify-center shrink-0">
                                <FileText :size="18" class="text-white" />
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4 flex-wrap">
                                    <div>
                                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                                            <h3 class="font-semibold text-gray-900 text-sm">
                                                {{ service.titre }}
                                            </h3>

                                        </div>
                                        <p class="text-xs text-gray-500 leading-relaxed max-w-xl">
                                            {{ service.description }}
                                        </p>
                                    </div>

                                    <div class="flex flex-col items-end gap-1.5 shrink-0">

                                        <span
                                            class="font-bold text-sm px-3 py-1.5 rounded-xl border bg-green-50 text-green-700 border-green-300"
                                        >
                                            {{ Number(service.cout).toLocaleString('fr-FR') }} F CFA
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </PublicLayout>

</template>
