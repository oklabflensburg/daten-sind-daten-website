<template>
  <NuxtLayout name="default">

    <div class="prose dark:prose-invert prose-slate max-w-none">
      <h1>Projekte</h1>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <ContentList path="/projekte" :query="{ sort: [{ date: -1 }] }">
          <template #default="{ list }">
            <div v-for="project in list" :key="project._path"
              class="col-span-1 border rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow">
              <div class="project-meta" v-if="project.date">
                <span>{{ formatDate(project.date) }}</span>
              </div>
              <h2 class="text-xl font-bold mt-2">{{ project.title || 'Untitled Project' }}</h2>
              <div class="mt-3">
                <div v-if="hasValidImage(project)" class="flex-none w-full">
                  <NuxtLink :to="project._path">
                    <img :src="project.image" alt="Project Image" class="rounded" />
                  </NuxtLink>
                </div>
                <div class="flex-1">
                  <p v-if="project.description" class="text-lg">{{ truncateDescription(project.description) }}</p>
                </div>
              </div>
              <NuxtLink :to="project._path" class="read-more mt-4">weiter lesen</NuxtLink>
            </div>
          </template>
          <template #not-found>
            <p>No projects found. Make sure you have markdown files in the /content/projekte directory.</p>
          </template>
        </ContentList>
      </div>
    </div>
  </NuxtLayout>
</template>

<script setup>
definePageMeta({
  layout: 'default'
})

const formatDate = (dateString) => {
  try {
    return new Date(dateString).toLocaleDateString()
  } catch (error) {
    console.error('Invalid date format:', dateString)
    return 'Unknown date'
  }
}

const hasValidImage = (project) => {
  return project.image && typeof project.image === 'string' && project.image.trim() !== ''
}

const truncateDescription = (text) => {
  if (!text || typeof text !== 'string') return ''
  if (text.length <= 160) return text

  // Find the last space before 160 characters to avoid breaking words
  const lastSpaceIndex = text.substring(0, 160).lastIndexOf(' ')

  // If no space is found, just cut at 160
  const cutIndex = lastSpaceIndex > 0 ? lastSpaceIndex : 160

  return text.substring(0, cutIndex) + '...'
}
</script>
<style>
.project-item {
  border-bottom: 1px solid #eaeaea;
  padding-bottom: 1.5rem;
}

.read-more {
  display: inline-block;
  margin-top: 0.5rem;
  font-weight: bold;
}

.project-meta {
  font-size: 0.9rem;
  color: #666;
  margin-bottom: 0.5rem;
}
</style>