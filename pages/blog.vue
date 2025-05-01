<template>
  <NuxtLayout name="default">
    <div class="prose dark:prose-invert prose-slate max-w-none">
      <h1>Blog</h1>

      <ContentList path="/blog" :query="{ sort: [{ date: -1 }] }">
        <template #default="{ list }">
          <div v-for="article in list" :key="article._path" class="xxx article-item mb-8">
            <div class="article-meta" v-if="article.date">
              <span>{{ new Date(article.date).toLocaleDateString() }}</span>
            </div>
            <h2>{{ article.title }}</h2>
            <p v-if="article.description">{{ article.description }}</p>
            <NuxtLink :to="article._path" class="read-more">Read more</NuxtLink>
          </div>
        </template>

        <template #not-found>
          <p>No blog posts found. Make sure you have markdown files in the /content/blog directory.</p>
        </template>
      </ContentList>
    </div>
  </NuxtLayout>
</template>

<script setup>
definePageMeta({
  layout: 'default'
})
</script>

<style scoped>
.read-more {
  display: inline-block;
  margin-top: 0.5rem;
  font-weight: bold;
}
</style>
