<template>
  <NuxtLayout name="default">
    <div class="prose dark:prose-invert prose-slate max-w-none">
      <div v-if="data">
        <template v-if="hasWebsiteLink">
          <NuxtLink :to="websiteUrl" class="">
            <img v-if="data.image" :src="data.image" alt="Prjekt Bild" class="project-image" />
          </NuxtLink>
        </template>
        <template v-else>
          <div class="">
            <img v-if="data.image" :src="data.image" alt="Prjekt Bild" class="project-image" />
          </div>
        </template>
        <h1 class="project-title">{{ data.title }}</h1>
        <div class="project-metadata">
          <div v-if="data.tags" class="project-tags">
            <span v-for="tag in data.tags" :key="tag" class="project-tag">{{ tag }}</span>
          </div>
        </div>
      </div>
      
      <!-- Wrap ContentDoc in client-only to prevent hydration mismatch -->
      <ClientOnly>
        <template #default>
          <div v-if="isContentReady">
            <p class="text-lg">
              <ContentDoc />
            </p>
          </div>
          <p v-else class="text-lg">Loading content...</p>
        </template>
        <template #fallback>
          <p class="text-lg">Loading content...</p>
        </template>
      </ClientOnly>
      
      <ul v-if="data.links" class="pl-0 text-lg">
        <li v-for="link in data.links" :key="link" class="">
          <NuxtLink :to="link.url" target="_blank" class="text-blue-500 hover:underline">
            {{ link.name }}
          </NuxtLink>
        </li>
      </ul>
      <div v-if="data.date" class="project-date">
        <span>{{ new Date(data.date).toLocaleDateString() }}</span>
      </div>
    </div>
  </NuxtLayout>
</template>

<script setup>
// Define the page metadata including layout
definePageMeta({
  layout: 'default'
})

// Get current route
const route = useRoute()

// Extract the slug from the route params
const { slug } = route.params
const slugString = Array.isArray(slug) ? slug.join('/') : slug

// Fetch the content document with its frontmatter
const { data, pending } = await useAsyncData(`content-${slugString}`, () => {
  return queryContent('/projekte').where({ _path: `/projekte/${slugString}` }).findOne()
})

// Check if content is ready
const isContentReady = computed(() => !pending.value && data.value != null)

// Filter links to only show "Website" links
const filteredLinks = computed(() => {
  if (!data.value?.links) return []
  return data.value.links.filter(link => link.name === "Website")
})

// Check if website link exists and get the URL
const hasWebsiteLink = computed(() => filteredLinks.value.length > 0)
const websiteUrl = computed(() => hasWebsiteLink.value ? filteredLinks.value[0].url : '#')

// Optional: Add meta tags based on frontmatter
useContentHead(data)
</script>

<style scoped>
.project-title {
  color: #3b82f6;
}

.project-metadata {
  margin-bottom: 2rem;
}

.project-description {
  font-style: italic;
  color: #6b7280;
}

.project-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-top: 1rem;
}

.project-tag {
  background-color: #e5e7eb;
  color: #374151;
  padding: 0.25rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.875rem;
}

.project-date {
  color: #6b7280;
  font-size: 0.875rem;
}

.project-content-body {
  margin-top: 2rem;
}
</style>