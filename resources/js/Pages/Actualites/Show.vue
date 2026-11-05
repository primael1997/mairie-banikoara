<script setup>
    import { ref, computed } from 'vue'
    import { Link, usePage } from '@inertiajs/vue3'
    import PublicLayout from '@/Layouts/PublicLayout.vue'
    import BreadCrumb from '@/Components/BreadCrumb.vue'
    import {Calendar, Tag, Share2, Printer} from 'lucide-vue-next'
    import PostCard from '@/Components/PostCard.vue'

    const props = defineProps({
        post: { type: Object, required: true },
        related: { type: Array, default: () => [] },
        title: { type: String, required: true },
        text: { type: String, default: '' },
        url: { type: String, default: '' },
    })

    const shareUrl = computed(() => props.url || window.location.href)

    const excerpt = computed(() =>
        props.text.length > 120 ? props.text.slice(0, 117) + '…' : props.text
    )

    const whatsappHref = computed(
        () =>
        'https://wa.me/?text=' +
        encodeURIComponent(`*${props.title}*\n${excerpt.value}\n${shareUrl.value}`)
    )

    const facebookHref = computed(
        () =>
        'https://www.facebook.com/sharer/sharer.php?u=' +
        encodeURIComponent(shareUrl.value)
    )

    const open = (href) =>
        window.open(href, '_blank', 'noopener,noreferrer,width=600,height=500')

    const nativeShare = async () => {
        try {
            await navigator.share({
            title: props.title,
            text: excerpt.value,
            url: shareUrl.value,
            })
        } catch (e) {}
    }

    const canNativeShare = typeof navigator !== 'undefined' && !!navigator.share

    const breadcrumbItems = [
        {
            label: 'Actualités',
            href: '/actualites',
        },
        {
            label: props.post.titre,
        },
    ]
</script>

<template>

    <PublicLayout>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <article class="py-10 sm:py-14">
                <BreadCrumb
                    :items="breadcrumbItems"
                />

                <div data-aos="fade-up" data-aos-duration="600" class="relative mb-4 overflow-hidden rounded-2xl">
                    <img
                        :src="`/${post.image}`"
                        :alt="post.title"
                        class="h-[280px] w-full object-cover object-center sm:h-[400px] lg:h-[500px]"
                    />

                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                    <span
                        v-if="post.categorie"
                        class="absolute left-5 top-5 rounded-full px-3 py-1.5 text-xs font-semibold capitalize"
                        :class="badgeClass(post.category)"
                    >

                        {{ post.categorie }}
                    </span>
                </div>


                <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="600" class="mb-4">

                    <div class="mb-3 flex flex-wrap items-center gap-4 text-xs text-gray-400">

                        <span class="flex items-center gap-1.5">
                            <Calendar :size="13" />

                            {{ post.date }}
                        </span>

                        <span v-if="post.categorie" class="flex items-center gap-1.5 font-semibold">

                            <Tag :size="13" />

                            {{ post.category }}
                        </span>
                    </div>


                    <h1 class="mb-2 text-3xl font-bold leading-tight text-gray-900 lg:text-4xl">
                        {{ post.titre }}
                    </h1>

                </div>


                <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="600" class="mb-10 flex items-center gap-3 border-b border-gray-100 pb-8">

                    <button
                        type="button"
                        @click="open(whatsappHref)"
                        class="flex items-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 text-sm text-gray-500 transition-all hover:border-green-300 hover:bg-green-50 hover:text-green-700"
                    >
                        <Share2 :size="14" /> Partager

                    </button>

                    <button
                        type="button"
                        @click="open(facebookHref)"
                        class="flex items-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 text-sm text-gray-500 transition-all hover:border-green-300 hover:bg-green-50 hover:text-green-700"
                    >
                        <Share2 :size="14" /> Partager

                    </button>


                    <button
                        type="button"
                        @click="window.print()"
                        class="flex items-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 text-sm text-gray-500 transition-all hover:border-green-300 hover:bg-green-50 hover:text-green-700"
                    >
                        <Printer :size="14" />
                        Imprimer
                    </button>

                </div>


                <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="600"
                    class="prose prose-sm prose-green mb-10 max-w-none text-justify sm:prose-base
                            prose-headings:font-bold prose-headings:text-gray-900
                            prose-p:leading-relaxed prose-p:text-gray-600
                            prose-h3:mb-3 prose-h3:mt-8 prose-h3:text-lg"
                    v-html="post.content"
                >

                </div>

            </article>

            <section v-if="related.length" class="py-10 sm:py-16">
                <div class="mb-10 flex items-center gap-4">
                    <span class="h-0.5 w-12 bg-brand-600"></span>
                    <h2 class="text-2xl font-bold text-ink sm:text-3xl">Posts similaires</h2>
                </div>
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <PostCard v-for="post in props.related" :key="post.id" :post="post" />
                </div>
            </section>
        </div>

    </PublicLayout>

</template>
