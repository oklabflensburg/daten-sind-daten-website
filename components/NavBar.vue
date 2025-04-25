<template>
    <nav class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <h1 class="text-xl font-bold">
                        <NuxtLink to="/">DatenSindDaten</NuxtLink>
                    </h1>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-4">
                        <NuxtLink v-for="navItem in navigation" :key="navItem._path" :to="navItem._path"
                            class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                            {{ navItem.title }}
                        </NuxtLink>
                        <NuxtLink to="/blog" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                            Blog
                        </NuxtLink>
                        <NuxtLink to="/projekte" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                            Projekte
                        </NuxtLink>
                    </div>
                </div>

                <!-- Dark Mode Toggle -->
                <DarkModeToggle />

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="isOpen = !isOpen"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-black hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path v-if="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div v-if="isOpen" class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <NuxtLink v-for="navItem in navigation" :key="navItem._path" :to="navItem._path"
                    class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                    {{ navItem.title }}
                </NuxtLink>
                <NuxtLink to="/blog" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                    Blog
                </NuxtLink>
                <NuxtLink to="/projekte" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                    Projekte
                </NuxtLink>
            </div>
        </div>
    </nav>
</template>

<script setup>
const isOpen = ref(false)

// Use a key to ensure proper caching and prevent recursion
const { data: navigation } = await useAsyncData('primary-navigation', () => 
    queryContent()
        .only(['_path', 'title', 'navOrder'])
        .where({ _partial: false, navigation: { $ne: false } })
        .sort({ navOrder: 1 })
        .find()
)
</script>