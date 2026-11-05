<script setup>
    import { Building2, MapPin, DollarSign, TreePine, HandCoins, Dumbbell } from 'lucide-vue-next'

    const icons = {
        Building2,
        MapPin,
        DollarSign,
        TreePine,
        HandCoins,
        Dumbbell,
    }

    defineProps({
        icon: {
            type: String,
            required: true,
        },
        size: {
            type: Number,
            default: 22,
        },
    })

</script>

<template>
    <component
        :is="icons[icon]"
        :size="size"
    />
</template>
