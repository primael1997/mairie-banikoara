<script setup>
    import { ref } from 'vue'
    import { Link, usePage } from '@inertiajs/vue3'

    const mobileOpen = ref(false)
    const openDropdown = ref(null)

    const navigation = [
        {
            name: 'La Commune',
            children: [
                { name: 'Présentation', href: '/commune/presentation'},
                { name: 'Historique', href: '/commune/historique'},
                { name: 'Arrondissement', href: '/commune/arrondissement'},
                { name: 'Projets', href: '/commune/projets'},
            ]
        },
        {
            name: 'La mairie',
            children: [
                { name: 'Mot du maire', href: '/maire/mot-du-maire' },
                { name: 'Elus municipaux', href: '/maire/elus-municipaux' },
                { name: 'Secretariat Exécutif', href: '/mairie/secretariat-executif' },
                { name: 'Organigramme', href: '/mairie/organigramme' },
                { name: 'Ancien maires', href: '/mairie/ancien-maires' },
            ],
        },
        {
            name: 'Actualités',
            href: '/actualites',
            page: true,
        },
        {
            name: 'Services',
            href: '/services',
            page: true,
        },
        {
            name: 'Documentation',
            href: '/documentation',
            page: true,
        },
        {
            name: 'Espace citoyen',
            children: [
                { name: 'Soumettre une requête', href: '/citoyen/requete' },
                { name: 'Contact', href: '/citoyen/contact' },
            ],
        },

    ]

    const page = usePage()

    const isActive = (href) => page.url === href

    const closeMenus = () => {
        mobileOpen.value = false
        openDropdown.value = null
    }

    const toggleDropdown = (index) => {
        openDropdown.value = openDropdown.value === index ? null : index
    }

    const footerColumns = [
        {
            title: "La Mairie",
            links: [
                { name: "Mot du maire", href: "/maire/mot-du-maire" },
                { name: "Élus municipaux", href: "/maire/elus-municipaux" },
                { name: "Organigramme", href: "/mairie/organigramme" },
                { name: "Anciens maires", href: "/mairie/ancien-maires" },
            ],
        },

        {
            title: "Liens utiles",
            links: [
                { name: "Actualités", href: "/actualites" },
                { name: "Historique", href: "/commune/historique" },
                { name: "Documentation", href: "/documentation" },
                { name: "Arrondissemnts", href: "/commune/arrondissement" },
                { name: "Contact", href: "/citoyen/contact" },
            ],
        },
    ]

    const socials = [
        {
            name: "Facebook",
            href: "https://www.facebook.com/mairiedebanikoara/",
            icon: "fab fa-facebook-f",
        },
        {
            name: "YouTube",
            href: "#",
            icon: "fab fa-youtube",
        },
        {
            name: "Twitter",
            href: "#",
            icon: "fab fa-twitter",
        },
    ]

    const year = new Date().getFullYear();
</script>

<template>
    
    <header class="sticky top-0 z-50 border-b border-gray-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between">

                <!-- Logo -->
                <Link href="/" class="flex items-center gap-3" @click="closeMenus">
                    <img
                        src="/front/images/logo.png"
                        alt="Logo"
                        class="h-12 w-12 object-contain"
                    />

                    <div class="leading-tight">
                        <p class="text-base font-semibold text-gray-900">
                            Mairie de
                        </p>
                        <p class="text-sm font-medium text-green-900">
                            Banikoara
                        </p>
                    </div>
                </Link>

                <!-- Desktop -->
                <nav class="absolute left-1/2 hidden -translate-x-1/2 items-center gap-4 lg:flex">

                    <div
                        v-for="(item,index) in navigation"
                        :key="item.name"
                        class="relative"
                    >

                        <!-- Lien simple -->
                        <Link
                            v-if="item.page"
                            :href="item.href"
                            class="whitespace-nowrap rounded-md px-3 py-2 text-base font-medium transition"
                            :class="isActive(item.href)
                                ? 'bg-green-50 text-green-700'
                                : 'text-gray-600 hover:bg-gray-50 hover:text-green-700'"
                        >
                            {{ item.name }}
                        </Link>

                        <!-- Dropdown -->
                        <div v-else>

                            <button
                                class="flex items-center gap-1 rounded-md px-3 py-2 text-base font-medium text-gray-600 transition hover:bg-gray-50 hover:text-green-700 whitespace-nowrap"
                                @click="toggleDropdown(index)"
                            >
                                {{ item.name }}

                                <svg
                                    class="h-4 w-4 transition-transform"
                                    :class="{ 'rotate-180': openDropdown === index }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7"
                                    />
                                </svg>

                            </button>

                            <div
                                v-if="openDropdown === index"
                                class="absolute left-0 top-full mt-1 w-56 rounded-xl border border-gray-200 bg-white py-1 shadow-lg"
                            >

                                <Link
                                    v-for="child in item.children"
                                    :key="child.href"
                                    :href="child.href"
                                    @click="closeMenus"
                                    class="block px-4 py-2 text-sm transition"
                                    :class="isActive(child.href)
                                        ? 'bg-green-50 font-medium text-green-700'
                                        : 'text-gray-600 hover:bg-gray-50 hover:text-green-700'"
                                >
                                    {{ child.name }}
                                </Link>

                            </div>

                        </div>

                    </div>

                </nav>

                <!-- Réseaux sociaux -->
                <div class="hidden items-center gap-3 lg:flex">

                    <a
                        href="https://www.facebook.com/mairiedebanikoara/"
                        target="_blank"
                        class="rounded-full bg-gray-100 p-2 hover:bg-green-100"
                    >
                        <i class="fas fa-facebook-f"></i>
                    </a>

                    <a
                        href="#"
                        class="rounded-full bg-gray-100 p-2 hover:bg-green-100"
                    >
                        <i class="fas fa-twitter"></i>
                    </a>

                    <a
                        href="#"
                        class="rounded-full bg-gray-100 p-2 hover:bg-green-100"
                    >
                        <i class="fas fa-youtube"></i>
                    </a>

                </div>

                <!-- Hamburger -->
                <button
                    class="rounded-md p-2 text-gray-600 hover:bg-gray-100 lg:hidden"
                    @click="mobileOpen = !mobileOpen"
                >
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            :d="mobileOpen
                                ? 'M6 18L18 6M6 6l12 12'
                                : 'M4 6h16M4 12h16M4 18h16'"
                        />
                    </svg>
                </button>

            </div>
        </div>

        <!-- Mobile -->
        <div v-show="mobileOpen"
        class="border-t border-gray-200 bg-white lg:hidden">

            <div class="space-y-1 py-3">

                <div
                    v-for="item in navigation"
                    :key="item.name"
                >

                    <Link
                        v-if="item.page"
                        :href="item.href"
                        class="block rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                        @click="closeMenus"
                    >
                        {{ item.name }}
                    </Link>

                    <div v-else>

                        <p class="px-3 py-2 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            {{ item.name }}
                        </p>

                        <Link
                            v-for="child in item.children"
                            :key="child.href"
                            :href="child.href"
                            class="block rounded-md px-5 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-green-700"
                            @click="closeMenus"
                        >
                            {{ child.name }}
                        </Link>

                    </div>

                </div>

            </div>
        </div>

    </header>

    <main class="flex-1">
        <slot />
    </main>

    <footer class="bg-black text-gray-300 mt-auto pt-5">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <img
                            src="/front/images/logo.png"
                            alt="Logo Mairie de Banikoara"
                            class="w-12 h-12 object-contain"
                        />

                        <div>
                            <p class="text-white font-semibold text-lg">Mairie de Banikoara</p>
                            <p class="text-green-500 text-base">Commune du Bénin</p>
                        </div>
                    </div>

                    <p class="text-base text-gray-400 leading-relaxed">
                        Portail officiel de la commune de Banikoara, département de
                        l'Alibori, Bénin.
                    </p>
                </div>

                <div v-for="column in footerColumns" :key="column.title">
                    <h3 class="text-white font-medium text-lg mb-4">{{ column.title }}</h3>

                    <ul class="space-y-2 text-sm">
                        <li class="text-gray-400 hover:text-green-400 transition-colors" v-for="link in column.links"
                            :key="link.name">
                            <Link
                                :href="link.href"
                                class="transition hover:text-green-400"
                            >
                                {{ link.name }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-medium text-lg mb-4">Contact</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2">

                            <span class="text-gray-400 text-base">
                                Banikoara, département de l'Alibori, Bénin
                            </span>
                        </li>
                        <li class="flex items-center gap-2">

                            <a
                                href="tel:+22901438620"
                                class="text- base text-gray-400 hover:text-green-400 transition-colors"
                                >
                                +229 01 43 86 20 20
                            </a>
                        </li>
                        <li class="flex items-center gap-2">

                            <a
                                href="mailto:contact@mairiebanikoara.bj"
                                class="text-gray-400 hover:text-green-400 transition-colors"
                                >
                                contact@mairiebanikoara.bj
                            </a>
                        </li>
                        <li class="flex items-start gap-2">

                            <span class="text-base text-gray-400">Lun – Ven : 8h00 – 17h00</span>
                        </li>
                    </ul>
                </div>

            </div>

            <div className="border-t border-gray-800 mt-10 pt-6 flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-gray-500">
                <p>© Mairie de Banikoara. Tous droits réservés.</p>
                <p>Commune de Banikoara — République du Bénin</p>
            </div>

        </div>

        <section className="w-full h-2 flex shadow-md">
            <div className="flex-1 bg-green-600"></div>
            <div className="flex-1 bg-yellow-400"></div>
            <div className="flex-1 bg-red-600"></div>
        </section>


    </footer>

</template>
