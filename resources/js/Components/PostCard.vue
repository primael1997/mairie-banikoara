<script setup>
    import { Link } from '@inertiajs/vue3'
    import { ArrowRight, Calendar } from 'lucide-vue-next'

    const props = defineProps({
        post: { type: Object, required: true },
    })

    const target = props.post.slug ? route('actualites.show', props.post.slug) : null


    const badgeColors = [
        'bg-green-100 text-green-700',
        'bg-blue-100 text-blue-700',
        'bg-orange-100 text-orange-700',
        'bg-red-100 text-red-700',
        'bg-purple-100 text-purple-700',
        'bg-pink-100 text-pink-700',
        'bg-cyan-100 text-cyan-700',
        'bg-amber-100 text-amber-700',
    ]

    const badgeClass = (category) => {
        if (!category) {
            return 'bg-gray-100 text-gray-700'
        }

        // Génère un nombre à partir du nom de la catégorie
        const hash = [...category].reduce((acc, char) => acc + char.charCodeAt(0), 0)

        return badgeColors[hash % badgeColors.length]
    }

</script>

<template>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow cursor-pointer">
        <Link :href="target">
            <img :src="`/${post.image}`" :alt="post.title"
                class="w-full h-60 object-cover"
            />
        </Link>

        <div class="p-5">

            <span
                v-if="post.category"
                class="inline-block text-xs font-medium px-2.5 py-1 rounded-full mb-3"
                :class="badgeClass(post.category)"
            >
                {{ post.category }}
            </span>

            <h3 class="text-lg font-semibold text-gray-900 mb-2 leading-snug">
                {{ post.titre }}
            </h3>

            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-700">
                    {{ post.date }}
                </span>

                <Link :href="target"
                    class="text-xs text-green-700 font-medium hover:underline flex items-center gap-1"
                >
                    Lire
                    <ArrowRight :size="12" />
                </Link>

            </div>

        </div>
    </div>
</template>
