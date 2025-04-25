<template>
  <NuxtLayout name="default">
    <div v-if="frontmatterImage" class="content-image">
      <img :src="frontmatterImage" :alt="data?.title || ''" class="w-48" />
    </div>
    <div class="prose dark:prose-invert prose-slate max-w-none">
      <ContentDoc />
    </div>
  </NuxtLayout>
</template>

<script setup>
definePageMeta({
  layout: 'default'
})

// Get the current route
const route = useRoute()

// Fetch content data for the current page
const { data } = await useAsyncData(`content-${route.path}`, () => {
  return queryContent(route.path).findOne()
})

// Extract image from frontmatter
const frontmatterImage = computed(() => {
  return data.value?.image || null
})
</script>

<style scoped>
img {
  width: 100px;
  float: left;
}

.project-content img {
  width: 150px;
  border-radius: 5px;
}

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

.content-image {
  margin-bottom: 1.5rem;
}

.content-image img {
  width: auto;
  max-width: 100%;
  float: none;
  border-radius: 5px;
}
</style>