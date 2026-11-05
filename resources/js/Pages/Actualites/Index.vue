<script setup>
    import { ref, computed } from 'vue'
    import { Head, Link, router } from '@inertiajs/vue3'
    import PublicLayout from '@/Layouts/PublicLayout.vue'
    import BreadCrumb from '@/Components/BreadCrumb.vue'
    import {Calendar, Tag, ArrowRight, Newspaper, Filter, Search, Share2, Printer} from 'lucide-vue-next'
    import PostCard from '@/Components/PostCard.vue'

    const props = defineProps({
        posts: { type: Object, required: true },
        categories: { type: Array, default: () => [] },
        filters: { type: Object, default: () => ({}) },
    })

    const search = ref(props.filters.search ?? '')

    const visit = (params) => {
        router.get(route('actualites.index'), params, {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        })
    }

    const truncateHtml = (html, length = 100) => {
        if (!html) return ''

        const div = document.createElement('div')
        div.innerHTML = html

        const text = div.textContent || div.innerText || ''

        return text.length > length
            ? text.substring(0, length) + '...'
            : text
    }

    const submitSearch = () => visit({ search: search.value || undefined, category: props.filters.category })
    const filterByCategory = (category) => visit({ search: search.value || undefined, category })

    const breadcrumbItems = [
        {
            label: 'Actualités',
            href: '/actualites',
        },
    ]

    const badgeColors = [
        'bg-green-100 text-green-800',
        'bg-amber-100 text-amber-800',
        'bg-red-100 text-red-800',
        'bg-blue-100 text-blue-800',
        'bg-purple-100 text-purple-800',
        'bg-yellow-100 text-yellow-800',
        'bg-pink-100 text-pink-800',
        'bg-rose-100 text-rose-800',
        'bg-slate-100 text-slate-800',
        'bg-gray-100 text-gray-800',
        'bg-zinc-100 text-zinc-800',
        'bg-sky-100 text-sky-800',
        'bg-orange-100 text-orange-800',
    ]

    const badgeClass = (category) => {
        if (!category) {
            return 'bg-gray-100 text-gray-700'
        }

        const hash = [...category].reduce(
            (acc, char) => acc + char.charCodeAt(0),
            0
        )

        return badgeColors[hash % badgeColors.length]
    }

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
                        <Newspaper :size="20" class="text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Actualités</h1>
                </div>
                <p class="text-gray-500">
                    Toutes les dernières nouvelles de la commune de Banikoara.
                </p>
            </div>

            <div class="relative mb-6">
                <Search
                    :size="16"
                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"
                />
                <input
                    type="text"
                    placeholder="Rechercher une actualité..."
                    class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all"
                />
            </div>

            <div class="flex flex-wrap gap-2 mb-10">
                <div class="flex items-center gap-2 text-xs text-gray-400 mr-2">
                    <Filter :size="13" />
                        Filtrer :
                </div>
                <button
                    type="button"
                    @click="filterByCategory(undefined)"
                    :class="['px-4 py-2 rounded-lg text-sm font-medium capitalize transition-all', !filters.category ? 'bg-green-700 text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:border-green-400 hover:text-green-700']"
                >
                    Toutes
                </button>
                <button
                    v-for="cat in categories"
                    :key="cat"
                    type="button"
                    @click="filterByCategory(cat)"
                    :class="['px-4 py-2 rounded-lg text-sm font-medium capitalize transition-all', filters.category === cat ? 'bg-green-700 text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:border-green-400 hover:text-green-700']"
                >
                    {{ cat }}
                </button>
            </div>

            <div  v-if="!posts.data.length" class="py-20 text-center">
                <p class="text-gray-500">
                    Aucune actualité disponible.
                </p>
            </div>

            <div v-else>

                <div class="mb-8">
                    <Link
                        :href="`/actualites/${posts.data[0].slug}`"
                        class="group grid grid-cols-1 md:grid-cols-2 bg-white border border-gray-200 rounded-2xl overflow-hidden hover:border-green-400 hover:shadow-xl transition-all"
                    >

                        <div class="relative overflow-hidden">
                            <img
                                :src="`/${posts.data[0].image}`"
                                :alt="posts.data[0].titre"
                                class="w-full h-64 md:h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                            <span
                                v-if="posts.data[0].category"
                                class="absolute top-5 left-5 inline-block text-xs font-semibold px-3 py-1.5 rounded-full"
                                :class="badgeClass(posts.data[0].category)"
                            >
                                {{ posts.data[0].category }}
                            </span>
                        </div>

                        <div class="p-8 flex flex-col justify-center">
                            <div class="flex items-center gap-2 text-xs text-gray-400 mb-3">
                                <Calendar :size="12" />
                                {{ posts.data[0].date }}
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-700 transition-colors leading-snug">
                                {{ posts.data[0].titre }}
                            </h2>
                            <p class="text-gray-500 text-sm leading-relaxed mb-6">
                                {{ truncateHtml(posts.data[0].contenu, 500) }}
                            </p>
                            <span class="inline-flex items-center gap-2 text-sm text-green-700 font-medium">
                                Lire l'article <ArrowRight :size="14" />
                            </span>
                        </div>
                    </Link>
                </div>



                <div v-if="posts.data.length > 1" class="mb-8" >
                    <h2 class="text-2xl font-bold text-gray-900">
                        Dernières actualités
                    </h2>

                    <div class="mt-2 h-1 w-12 bg-green-600 rounded-full"></div>
                </div>

                <div v-if="posts.data.length > 1" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <PostCard
                        v-for="post in posts.data.slice(1, 10)"
                        :key="post.id"
                        :post="post"
                    />
                </div>

            </div>

            <div
                v-if="posts.links.length > 3"
                class="flex justify-center items-center gap-2 mt-8 flex-wrap"
            >
                <template
                    v-for="(link, i) in posts.links"
                    :key="i"
                >
                    <!-- Lien actif -->
                    <Link
                        v-if="link.url"
                        :href="link.url"
                        preserve-scroll
                        :class="[
                            'px-3 py-1 rounded transition',
                            link.active
                                ? 'bg-green-700 text-white'
                                : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
                        ]"
                        v-html="link.label"
                    />

                    <!-- Lien désactivé -->
                    <span
                        v-else
                        class="px-3 py-1 rounded bg-gray-100 text-gray-400"
                        v-html="link.label"
                    />
                </template>
            </div>
        </div>

    </PublicLayout>

</template>
