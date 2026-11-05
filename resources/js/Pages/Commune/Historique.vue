<script setup>
    import { Link } from "@inertiajs/vue3";
    import { motion } from "motion-v";
    import { BookOpen, ArrowRight } from "lucide-vue-next";
    import BreadCrumb from '@/Components/BreadCrumb.vue';
    import PublicLayout from '@/Layouts/PublicLayout.vue'

    const fadeUp = {
        hidden: {
            opacity: 0,
            y: 30,
        },
        visible: {
            opacity: 1,
            y: 0,
            transition: {
                duration: 0.5,
            },
        },
    };

    const slideLeft = {
        hidden: {
            opacity: 0,
            x: -50,
        },
        visible: {
            opacity: 1,
            x: 0,
            transition: {
                duration: 0.5,
            },
        },
    };

    const slideRight = {
        hidden: {
            opacity: 0,
            x: 50,
        },
        visible: {
            opacity: 1,
            x: 0,
            transition: {
                duration: 0.5,
            },
        },
    };


    const evenements = [
        {
            annee: "XVIIIe s.",
            titre: "Fondation de Banikoara",
            description:
                "Banikoara est fondée par des groupes Baatombu venus du royaume de Nikki. Le nom signifie « grand village des Baatombu » en langue locale.",
        },
        {
            annee: "1898",
            titre: "Arrivée de la colonisation française",
            description:
                "La région est intégrée au Dahomey français. Des postes administratifs sont établis et marquent le début d'une nouvelle organisation territoriale.",
        },
        {
            annee: "1960",
            titre: "Indépendance du Bénin",
            description:
                "Avec l'indépendance du Dahomey (futur Bénin), Banikoara devient une subdivision administrative à part entière dans le nouveau pays.",
        },
        {
            annee: "2003",
            titre: "Naissance de la commune",
            description:
                "Dans le cadre de la décentralisation au Bénin, Banikoara est érigée en commune à part entière avec son premier conseil communal élu démocratiquement.",
        },
        {
            annee: "2020",
            titre: "Quatrième mandature",
            description:
                "Bio Sarako TAMOU est réélu maire pour la quatrième mandature, poursuivant les projets de développement et de modernisation de la commune.",
        },
    ];

    // index % 2 === 0 -> côté gauche, sinon droite (alternance desktop)
    function isLeft(index) {
        return index % 2 === 0;
    }

    const breadcrumbItems = [
        {
            label: 'Commune',
        },
        {
            label: 'Présentation',
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
            <motion.div :variants="slideLeft" initial="hidden" animate="visible" class="mb-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-green-700 rounded-xl flex items-center justify-center">
                        <BookOpen :size="20" class="text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Histoire de Banikoara</h1>
                </div>
                <p class="text-gray-500 ml-13">
                    Des origines à aujourd'hui — parcours d'une commune au cœur du nord Bénin.
                </p>
            </motion.div>

            <!-- Image avec overlay -->
            <motion.div :initial="{ opacity: 0, scale: 0.98 }" :animate="{ opacity: 1, scale: 1 }"
                :transition="{ duration: 0.6, ease: [0.25, 0.1, 0.25, 1] }"
                class="relative overflow-hidden rounded-2xl mb-16">
                <img src="/front/images/mairie/histoire.jpg" alt="Banikoara historique"
                    class="w-full h-52 object-cover" />
                <div class="absolute inset-0 bg-green-950/50" />
                <div class="absolute inset-0 flex items-center justify-center">
                    <motion.p :initial="{ opacity: 0, y: 20 }" :animate="{ opacity: 1, y: 0 }"
                        :transition="{ delay: 0.4, duration: 0.5 }"
                        class="text-white text-2xl font-bold text-center px-4">
                        Une commune aux racines profondes
                    </motion.p>
                </div>
            </motion.div>

            <!-- Frise chronologique animée -->
            <div class="relative">


                <!-- LIGNE CENTRALE -->

                <motion.div
                    :initial="{
                        scaleY: 0,
                    }"
                    :while-in-view="{
                        scaleY: 1,
                    }"
                    :viewport="{
                        once: true,
                    }"
                    :transition="{
                        duration: 1,
                    }"
                    class="absolute left-1/2 -translate-x-px top-0 bottom-0 w-0.5 bg-green-200 hidden md:block"
                />


                <div class="space-y-12">


                    <div
                        v-for="(ev, index) in evenements"
                        :key="index"
                        class="
                            relative
                            grid
                            grid-cols-1
                            md:grid-cols-[1fr_120px_1fr]
                            items-center
                            gap-6
                        "
                    >


                        <!-- ========================== -->
                        <!-- GAUCHE                     -->
                        <!-- ========================== -->

                        <div
                            class="hidden md:block"
                        >

                            <motion.div
                                v-if="index % 2 === 0"
                                :variants="slideLeft"
                                initial="hidden"
                                while-in-view="visible"
                                :viewport="{
                                    once: true,
                                }"
                                :custom="index * 0.1"
                                :while-hover="{
                                    scale: 1.02,
                                }"
                                class="
                                    bg-white
                                    border
                                    border-gray-200
                                    rounded-xl
                                    p-6
                                    hover:border-green-300
                                    hover:shadow-lg
                                    transition-all
                                "
                            >

                                <div
                                    class="
                                        w-8
                                        h-1
                                        bg-green-700
                                        rounded-full
                                        mb-3
                                    "
                                ></div>

                                <h3
                                    class="
                                        font-semibold
                                        text-gray-900
                                        mb-2
                                        text-lg
                                    "
                                >
                                    {{ ev.titre }}
                                </h3>

                                <p
                                    class="
                                        text-sm
                                        text-gray-500
                                        leading-relaxed
                                    "
                                >
                                    {{ ev.description }}
                                </p>

                            </motion.div>

                        </div>


                        <!-- ========================== -->
                        <!-- CENTRE                     -->
                        <!-- ========================== -->

                        <div
                            class="
                                relative
                                flex
                                flex-col
                                items-center
                                justify-center
                                z-10
                            "
                        >

                            <!-- Cercle -->

                            <motion.div
                                :initial="{
                                    scale: 0,
                                }"
                                :while-in-view="{
                                    scale: 1,
                                }"
                                :viewport="{
                                    once: true,
                                }"
                                :transition="{
                                    delay: index * 0.1,
                                    type: 'spring',
                                    stiffness: 200,
                                }"
                                class="
                                    w-14
                                    h-14
                                    rounded-full
                                    bg-green-700
                                    border-4
                                    border-white
                                    shadow-lg
                                    flex
                                    items-center
                                    justify-center
                                "
                            >

                                <div
                                    class="
                                        w-3
                                        h-3
                                        rounded-full
                                        bg-white
                                    "
                                ></div>

                            </motion.div>


                            <!-- Année -->

                            <div
                                class="
                                    mt-2
                                    text-xs
                                    font-bold
                                    text-green-700
                                    bg-green-50
                                    px-3
                                    py-1
                                    rounded-lg
                                    whitespace-nowrap
                                "
                            >
                                {{ ev.annee }}
                            </div>

                        </div>


                        <!-- ========================== -->
                        <!-- DROITE                     -->
                        <!-- ========================== -->

                        <div
                            class="hidden md:block"
                        >

                            <motion.div
                                v-if="index % 2 !== 0"
                                :variants="slideRight"
                                initial="hidden"
                                while-in-view="visible"
                                :viewport="{
                                    once: true,
                                }"
                                :custom="index * 0.1"
                                :while-hover="{
                                    scale: 1.02,
                                }"
                                class="
                                    bg-white
                                    border
                                    border-gray-200
                                    rounded-xl
                                    p-6
                                    hover:border-green-300
                                    hover:shadow-lg
                                    transition-all
                                "
                            >

                                <div
                                    class="
                                        w-8
                                        h-1
                                        bg-green-700
                                        rounded-full
                                        mb-3
                                    "
                                ></div>

                                <h3
                                    class="
                                        font-semibold
                                        text-gray-900
                                        mb-2
                                        text-lg
                                    "
                                >
                                    {{ ev.titre }}
                                </h3>

                                <p
                                    class="
                                        text-sm
                                        text-gray-500
                                        leading-relaxed
                                    "
                                >
                                    {{ ev.description }}
                                </p>

                            </motion.div>

                        </div>


                        <!-- ========================== -->
                        <!-- MOBILE                     -->
                        <!-- ========================== -->

                        <motion.div
                            :variants="
                                index % 2 === 0
                                    ? slideLeft
                                    : slideRight
                            "
                            initial="hidden"
                            while-in-view="visible"
                            :viewport="{
                                once: true,
                            }"
                            class="
                                md:hidden
                                bg-white
                                border
                                border-gray-200
                                rounded-xl
                                p-6
                            "
                        >

                            <div
                                class="
                                    w-8
                                    h-1
                                    bg-green-700
                                    rounded-full
                                    mb-3
                                "
                            ></div>

                            <h3
                                class="
                                    font-semibold
                                    text-gray-900
                                    mb-2
                                    text-lg
                                "
                            >
                                {{ ev.titre }}
                            </h3>

                            <p
                                class="
                                    text-sm
                                    text-gray-500
                                    leading-relaxed
                                "
                            >
                                {{ ev.description }}
                            </p>

                        </motion.div>


                    </div>

                </div>

            </div>



            <!-- Lien vers présentation -->
            <motion.div :variants="fadeUp" initial="hidden" whileInView="visible" :viewport="{ once: true }"
                class="mt-16 text-center">
                <Link href="/commune/presentation"
                    class="inline-flex items-center gap-2 bg-green-700 text-white px-6 py-3 rounded-xl font-medium hover:bg-green-800 transition-colors">
                    Découvrir la commune aujourd'hui
                    <ArrowRight :size="16" />
                </Link>
            </motion.div>
        </div>
    </PublicLayout>
</template>
